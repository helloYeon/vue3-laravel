<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\CustomResponseException;
use Illuminate\Http\Response;
use App\Services\UserService;

class SampleController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * サンプルユーザ取得 API
     *
     * @param Request $request
     * @return object
     */
    public function get(Request $request): object
    {

        // 処理開始ログ
        log_info(
            sprintf(config('message.I0002'), config('api_list.S0001')),
            []
        );

        // バリエーション
        $this->validator(
            $request,
            [
                'userId'       => 'nullable|numeric',
                'isException'  => 'required|digits_between:0,1',
            ]
        );

        // 例外発生サンプル（https 400）
        if ($request->input('isException') == 1) {
            throw new CustomResponseException(
                'I9999',
                Response::HTTP_BAD_REQUEST,
                [
                    'param_1' => 'banana',
                    'param_2' => 'apple',
                ]
            );
        }

        // パラメータからユーザID取得
        $userId = $request->input('userId');

        // ユーザIDが指定された場合ユーザID情報のみ取得、それ以外は全部取得
        $info = is_null($userId)
            ? UserService::getSampleUserAll()
            : UserService::getSampleUserById(userId:$userId);

        // レスポンス
        return $this->response($info->toArray());
    }
}
