<?php

namespace Sheepdev\Command;

use Sheepdev\Actions\Users\AddUser\AddUserAction;
use Sheepdev\Actions\Users\AddUser\AddUserRequest;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class AddUserCommand extends Command
{
    protected static $defaultName = 'sheepdev:user:add';

    protected static $defaultDescription = 'Add new user';

    /** @var AddUserAction */
    protected $action;

    public function __construct(AddUserAction $action)
    {
        parent::__construct();
        $this->action = $action;
    }

    protected function configure(): void
    {
        $this
            ->addOption('firstname', 'f', InputOption::VALUE_REQUIRED)
            ->addOption('lastname', 'l', InputOption::VALUE_REQUIRED)
            ->addOption('email', 'e', InputOption::VALUE_REQUIRED)
            ->addOption('password', 'p', InputOption::VALUE_REQUIRED)
            ->addOption('roles', 'r', InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('firstname') == '') {
            $output->writeln('<error>Firstname must not be empty</error>');
            return self::FAILURE;
        }
        if ($input->getOption('lastname') == '') {
            $output->writeln('<error>Lastname must not be empty</error>');
            return self::FAILURE;
        }
        if ($input->getOption('email') == '') {
            $output->writeln('<error>Email must not be empty</error>');
            return self::FAILURE;
        }
        if ($input->getOption('password') == '') {
            $output->writeln('<error>Password must not be empty</error>');
            return self::FAILURE;
        }

        $roles = [];
        if ($input->hasArgument('roles')) {
            $roles = $input->getOption('roles');
            $roles = explode(',', $roles);
            $roles = array_map(function($item) {
                return trim($item);
            }, $roles);
        }

        $data = new AddUserRequest();
        $data->firstname = $input->getOption('firstname');
        $data->lastname = $input->getOption('lastname');
        $data->email = $input->getOption('email');
        $data->password = $input->getOption('password');
        $data->roles = $roles;
        $response = $this->action->execute($data);

        if (!empty($response->errors)) {
            foreach ($response->errors as $error) {
                $output->writeln('<error>' . $error . '</error>');
            }
            return self::FAILURE;
        }

        $output->writeln('<info>User added successfully</info>');
        return self::SUCCESS;
    }
}