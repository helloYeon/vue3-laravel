<?php

namespace App\Logging;

use Carbon\Carbon;
use Monolog\Formatter\JsonFormatter;

/**
 * json
 */
class CustomizeJsonFormatter extends JsonFormatter
{
    /**
     * log format
     *
     * @param \Monolog\LogRecord $record
     * @return string
     */
    public function format(\Monolog\LogRecord $record): string
    {
        list($levelName, $summary, $message, $trace, $fileName, $fileLine, $pid) = $this->defineLogData($record);

        $output = json_encode([
            'DateTime'          => Carbon::now()->toDateTimeString('millisecond'),
            'LogLevel'          => $levelName,
            'HttpMethod'        => isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '-',
            'URL'               => isset($_SERVER['REQUEST_URI'])    ? $_SERVER['REQUEST_URI'] : '-',
            'PID'               => $pid      ?? '-',
            'FIleName'          => $fileName ?? '-',
            'FileLine'          => $fileLine ?? '-',
            'Summary'           => $summary  ?? '-',
            'Message'           => $message  ?? '-',
            'Trace'             => $trace    ?? '-',
        ], JSON_UNESCAPED_UNICODE) . "\n";

        $output = str_replace(base_path(), '', $output);

        return $output;
    }

    /**
     * define log data
     *
     * @param \Monolog\LogRecord $record
     * @return array
     */
    protected function defineLogData(\Monolog\LogRecord $record): array
    {
        if (array_key_exists('exception', $record['context'])) {
            $exception  = $record['context']['exception'];
            $levelName  = method_exists($exception, 'getLogLevel') ? $exception->getLogLevel() : 'ERROR';
            $summary    = $exception->getMessage();
            $message    = method_exists($exception, 'getCustomData') ? $exception->getCustomData() : '';
            $trace      = $this->pickOutTrace($exception->getTrace());
            $fileName   = $exception->getFile();
            $fileLine   = $exception->getLine();
        } else {
            $levelName  = ($record['level_name'] === 'EMERGENCY') ? 'FATAL' : $record['level_name'];
            $summary    = $record['message'];
            $message    = $record['context']['message'] ?? 'NO-SET-MSG';
            $trace      = $record['context']['trace'] ?? 'NO-SET-TRACE';
            $fileName   = $record['extra']['file'];
            $fileLine   = $record['extra']['line'];
        }

        $pid  = $record['extra']['pid'];

        return [$levelName, $summary, $message, $trace, $fileName, $fileLine, $pid];
    }

    /**
     * out trace
     *
     * @param array $trace
     * @return array
     */
    protected function pickOutTrace(array $trace): array
    {
        if (count($trace) >= 3) {
            $trace = array_slice($trace, 0, 3);
        }

        $errorTrace = [];
        foreach ($trace as $data) {
            $errorTrace[] = [
                'file'      => $data['file'] ?? null,
                'line'      => $data['line'] ?? null,
                'class'     => $data['class'] ?? null,
                'function'  => $data['function'] ?? null,
            ];
        }
        return $errorTrace;
    }
}
