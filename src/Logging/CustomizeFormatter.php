<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use App\Logging\CustomizeJsonFormatter;

/**
 * monolog カスタム
 */
class CustomizeFormatter
{
    /**
     * monolog
     *
     * @param instance $monolog
     * @return void
     */
    public function __invoke($monolog)
    {
        foreach ($monolog->getHandlers() as $handler) {
            $handler->pushProcessor(new IntrospectionProcessor(Logger::DEBUG, [
                'Monolog\\',
                'Illuminate\\',
                'Exceptions\\'
            ], 1));

            $handler->pushProcessor(function ($record) {
                $record['extra']['pid'] = app('Common')->getPid(); // PID FIXME
                return $record;
            });

            // custom format
            $handler->setFormatter(new CustomizeJsonFormatter());
        }
    }
}
