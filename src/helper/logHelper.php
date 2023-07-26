<?php

if (!function_exists('log_fatal')) {
    function log_fatal(string $summary, $message): void
    {
        \Illuminate\Support\Facades\Log::emergency($summary, [
            'message'   => $message,
            'trace'     => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5)
        ]);
    }
}

if (!function_exists('log_error')) {
    function log_error(string $summary, $message): void
    {
        \Illuminate\Support\Facades\Log::error($summary, [
            'message'   => $message,
            'trace'     => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5)
        ]);
    }
}

if (!function_exists('log_warning')) {
    function log_warning(string $summary, $message): void
    {
        \Illuminate\Support\Facades\Log::warning($summary, [
            'message'   => $message,
            'trace'     => null
        ]);
    }
}

if (!function_exists('log_info')) {
    function log_info(string $summary, $message): void
    {
        \Illuminate\Support\Facades\Log::info($summary, [
            'message'   => $message,
            'trace'     => null
        ]);
    }
}

if (!function_exists('log_debug')) {
    function log_debug(string $summary, $message = null): void
    {
        \Illuminate\Support\Facades\Log::debug($summary, [
            'message'   => $message,
            'trace'     => null
        ]);
    }
}

if (!function_exists('log_write')) {
    function log_write(string $errorCode, $message = null, array $bindData = []): void
    {
        $summary = config("message.$errorCode");

        if (!empty($bindData)) {
            $summary = vsprintf($summary, $bindData);
        }

        $logLevel = app('Common')->getLogLevelFromErrorCode($errorCode);

        if ($logLevel === config('constant.LOG_LV_ERROR')) {
            log_error($summary, $message);
        };

        if ($logLevel === config('constant.LOG_LV_INFO')) {
            log_info($summary, $message);
        };

        if ($logLevel === config('constant.LOG_LV_WARN')) {
            log_warning($summary, $message);
        };

        if ($logLevel === config('constant.LOG_LV_FATAL')) {
            log_fatal($summary, $message);
        };
    }
}
