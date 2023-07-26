<?php

namespace App\Libraries;

use Illuminate\Support\Str;

/**
 * 共通UTILクラス
 */
class UtilCommon
{
    /**
     * uuid
     *
     * @var string
     */
    private string $pid = '';

    /**
     * get pid
     *
     * @return string
     */
    public function getPid(): string
    {
        return $this->pid;
    }

    /**
     * set pid
     *
     * @return string|null
     */
    public function setPid(?string $pid): void
    {
        if (is_null($pid)) {
            $pid = Str::uuid();
        }

        $this->pid = $pid;
    }

    /**
     * メッセージコードからエラーレベルを取得
     *
     * @param string $errorCode
     * @return void
     */
    public function getLogLevelFromErrorCode(string $errorCode)
    {
        $logLevel = null;

        $matched = [];
        preg_match('/(^E|I|F|W)L?[0-9]{4}/', $errorCode, $matched);

        if (!empty($matched)) {
            switch ($matched[1]) {
                case 'E':
                    $logLevel = config('constant.LOG_LV_ERROR');
                    break;

                case 'I':
                    $logLevel = config('constant.LOG_LV_INFO');
                    break;

                case 'W':
                    $logLevel = config('constant.LOG_LV_WARN');
                    break;

                case 'F':
                    $logLevel = config('constant.LOG_LV_FATAL');
                    break;

                default:
                    $logLevel = config('constant.LOG_LV_ERROR');
                    break;
            }
        }
        return $logLevel;
    }
}
