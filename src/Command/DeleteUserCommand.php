<?php

namespace Sheepdev\Command;

use Sheepdev\Actions\Users\DeleteUser\DeleteUserAction;
use Sheepdev\Actions\Users\DeleteUser\DeleteUserRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteUserCommand extends Command
{
    protected static $defaultName = 'sheepdev:user:delete';

    protected static $defaultDescription = 'Delete user from database';

    protected DeleteUserAction $action;

    public function __construct(DeleteUserAction $action)
    {
        parent::__construct();
        $this->action = $action;
    }

    protected function configure(): void
    {
        $this
            ->addOption('userId', 'u', InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('userId') == '') {
            $output->writeln('<error>User id must be given</error>');
            return self::FAILURE;
        }

        $request = new DeleteUserRequest();
        $request->userId = (int) $input->getOption('userId');
        $response = $this->action->execute($request);

        if (!empty($response->errors)) {
            foreach ($response->errors as $error) {
                $output->writeln('<error>' . $error . '</error>');
            }
            return self::FAILURE;
        }

        $output->writeln('<info>User deleted successfully</info>');
        return self::SUCCESS;
    }
}