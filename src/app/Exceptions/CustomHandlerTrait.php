<?php

namespace App\Exceptions;

// use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

trait CustomHandlerTrait
{
    /**
     * 独自例外のレスポンスハンドラ
     *
     * @param  Throwable    $exceptionF public const HTTP_NON_AUTH
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function exceptionResponseHandler($exception): JsonResponse
    {
        switch ($exception) {
            // レスポンス用、例外の場合
            case $exception instanceof CustomResponseException:
                return $this->errorResponse(
                    $exception->getHttpStatus(),
                    $exception->getMessageCode(),
                    $exception->getMessage()
                );
                break;

            // ララベールバリエーションエラー
            case $exception instanceof ValidationException:
                $errors = $exception->errors();
                $key = array_key_first($errors);
                return $this->errorResponse(
                    Response::HTTP_BAD_REQUEST,
                    'I0001',
                    sprintf(config('message.I0001'), $errors[$key][0])
                );
                break;

            // 内部サーバーエラー
            default:
                return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'E0101', $exception->getMessage());
                break;
        }
    }

    /**
     * 例外レスポンス
     *
     * @param int    $statusCode HTTP STATUSコード
     * @param string $code       内部管理エラーコード
     * @param string $message    レスポンス用エラーメッセージ
     * @return JsonResponse
     */
    protected function errorResponse(int $statusCode, string $code, string $message = ''): JsonResponse
    {
        if (empty($message)) {
            $message = config('message.' . $code);
        }

        $data = [
            'header' => [
                'code'         => $code,
                'errorMessage' => $message,
                'traceId'      => app('Common')->getPid()
            ],
            'payload' => null
        ];

        $corsHostName = config('env.APP_URL');

        return response()->json($data, $statusCode)->header('Access-Control-Allow-Origin', $corsHostName);
    }
}
