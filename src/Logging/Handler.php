<?php

namespace SaC\LoggerLineNotify\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class Handler extends AbstractProcessingHandler
{

    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        $curl = curl_init();
        $msg = json_encode($record);
        $token = config('line.line_notify_token');

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://notify-api.line.me/api/notify',
            // CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "message=$msg",
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '. $token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        curl_exec($curl);
        curl_close($curl);
    }

    protected function getDefaultFormatter(): FormatterInterface
    {
        return new Formatter();
    }


}