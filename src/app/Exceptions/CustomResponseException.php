<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * レスポンス用、例外クラス
 */
class CustomResponseException extends BaseException
{
    /**
     * http status code
     *
     * @var int
     */
    protected int $httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * コンストラクタ
     *
     * @param string       $errorCode
     * @param integer|null $httpStatus
     * @param mixed        $customData
     * @param array        $bindData
     */
    public function __construct(string $errorCode, int $httpStatus = null, $customData, array $bindData = [])
    {

        parent::__construct($errorCode, $bindData);

        $this->logLevel = $this->getLogLevelFromErrorCode($errorCode);

        $this->messageCode = $errorCode;

        $this->customData = $customData;

        $this->httpStatus = $httpStatus ?? $this->httpStatus;
    }
}
