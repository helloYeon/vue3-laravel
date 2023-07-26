<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator as FacadesValidator;

abstract class ApiController extends Controller
{
    /**
     * constant
     *
     * @var array
     */
    protected array $const;

    /**
     * construct
     */
    public function __construct()
    {
        // コンスタント取得
        $this->const = config('constant');
    }

    /**
     * validator
     *
     * @param Request $request
     * @param array $rules
     * @param array $attribute
     * @param array $message
     * @return void
     */
    protected function validator(Request $request, array $rules, array $attribute = [], array $message = []): void
    {
        $validator = FacadesValidator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * api common response
     *
     * @param array $response
     */
    protected function response(array $response)
    {
        $responseData = [];

        // set response header
        $responseData['header'] =  [
            'code'         => null,
            'errorMessage' => null,
            'traceId'      => app('Common')->getPid()
        ];

        $responseData['payload'] = $response;

        if (empty($responseData['payload'])) {
            $responseData['payload'] = null;
        }
        return response()->json($responseData);
    }
}
