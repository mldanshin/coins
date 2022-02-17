<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

final class LogRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "message" => ["required", "string"]
        ];
    }
}
