<?php

namespace SaC\LoggerLineNotify\Logging;

use Monolog\Logger;

class Main
{
    public function send(string $msg = ''): void
    {

    }

    /**
     * @param array $conf
     * @return Logger
     */
    public function __invoke(array $conf): Logger
    {
        $logger = new Logger('custom');
        $logger->pushHandler(new Handler());
        $logger->pushProcessor(new Processor());

        return $logger;
    }


}