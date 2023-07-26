<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallbackController extends ApiController
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
    public function line(Request $request): object
    {

        // 処理開始ログ
        log_info(
            sprintf(config('message.I0002'), config('api_list.SC001')),
            []
        );
        ;
        // レスポンス
        return $this->response(['parameters' => $request->input()]);
    }
}
