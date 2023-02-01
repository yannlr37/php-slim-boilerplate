<?php

namespace Sheepdev\Command;

use Sheepdev\Actions\Users\AddUser\AddUserAction;
use Sheepdev\Actions\Users\AddUser\AddUserRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddUserCommand extends Command
{
    protected static $defaultName = 'sheepdev:user:add';

    protected static $defaultDescription = 'Add new user';

    protected AddUserAction $action;

    public function __construct(AddUserAction $action)
    {
        parent::__construct();
        $this->action = $action;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = new AddUserRequest();
        $data->firstname = 'Jenna';
        $data->lastname = 'BISHOP';
        $data->email = 'jenna.bishop@example.com';
        $data->password = 'sheepdev';
        $data->roles = ['author','reviewer'];
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