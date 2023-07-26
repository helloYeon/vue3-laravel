<?php

namespace App\Exceptions;

use Exception;

/**
 * BaseException
 */
class BaseException extends Exception
{
    /**
     * ログレベル
     *
     * @var string
     */
    protected string $logLevel;

    /**
     * ログメッセージコード
     *
     * @var string
     */
    protected string $messageCode;

    /**
     * ログ記録用データ
     *
     * @var mixed
     */
    protected $customData;

    /**
     * コンストラクタ
     *
     * @param string $messageCode
     * @param array  $bindData
     */
    public function __construct(string $messageCode, array $bindData = [])
    {
        $messages = config('message');

        // メッセージが定義されていたら定義されたメッセージをセット
        $message = $messages[$messageCode] ?: 'メッセージが設定されていません。「message.php」を確認してください。';

        if (!empty($bindData)) {
            $message = vsprintf($message, $bindData);
        }
        parent::__construct($message);
    }

    /**
     * デフォルトメッセージコードを取得
     *
     * @return string
     */
    public function getMessageCode(): string
    {
        return $this->messageCode;
    }

    /**
     * ログ記録用のデータを取得する
     *
     * @return mixed
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * ログ記録用のログレベル
     *
     * @return string
     */
    public function getLogLevel(): string
    {
        return $this->logLevel;
    }

    /**
     * get http status code
     *
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * エラーコードからログレベルを取得
     *
     * @param string $errorCode
     * @return void
     */
    public function getLogLevelFromErrorCode(string $errorCode)
    {
        return app('Common')->getLogLevelFromErrorCode($errorCode);
    }
}
