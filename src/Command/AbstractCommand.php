<?php

namespace Sheepdev\Command;

use Sheepdev\Actions\Users\AddUser\AddUserAction;
use Sheepdev\Actions\Users\AddUser\AddUserRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    protected static $defaultName = '';

    protected static $defaultDescription = '';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return self::SUCCESS;
    }

    protected function secureInputs(InputInterface $input): array
    {
        $args = $input->getOptions();
        array_walk($input, function($item) {

        });
        return $input;
    }
}