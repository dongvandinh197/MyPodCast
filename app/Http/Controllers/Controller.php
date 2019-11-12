<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function setErrorValidation($validator, $field, $message)
    {
        $validator->after(function ($validator) use ($field, $message) {
            $validator->errors()->add($field, $message);
        });
    }

    public function response($status, $data = null, $http_status = HTTP_STATUS_SUCCESS)
    {
        $response_data = [
            'status' => $status
        ];
        if ($data !== null) {
            $response_data['data'] = $data;
        }
        return response()->json($response_data, $http_status);
    }
}
