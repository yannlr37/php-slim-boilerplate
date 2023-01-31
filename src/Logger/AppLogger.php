<?php

namespace Sheepdev\Logger;

use Psr\Log\LoggerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class AppLogger implements LoggerInterface
{
    /** @var Logger */
    private $monolog;

    public function __construct()
    {
        $handler = new RotatingFileHandler(config('log_filename'), (int) config('log_max_days'));
        $this->monolog = new Logger(config('log_channel'));
        $this->monolog->pushHandler($handler);
    }

    public function emergency($message, array $context = array())
    {
        $this->monolog->emergency($message, $context);
    }

    public function alert($message, array $context = array())
    {
        $this->monolog->alert($message, $context);
    }

    public function critical($message, array $context = array())
    {
        $this->monolog->critical($message, $context);
    }

    public function error($message, array $context = array())
    {
        $this->monolog->error($message, $context);
    }

    public function warning($message, array $context = array())
    {
        $this->monolog->warning($message, $context);
    }

    public function notice($message, array $context = array())
    {
        $this->monolog->notice($message, $context);
    }

    public function info($message, array $context = array())
    {
        $this->monolog->info($message, $context);
    }

    public function debug($message, array $context = array())
    {
        $this->monolog->debug($message, $context);
    }

    public function log($level, $message, array $context = array())
    {
        $this->monolog->log($level, $message, $context);
    }
}