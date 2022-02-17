<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

final class PaginationRequest extends BaseRequest implements BuilderQueryContract
{
    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "page" => "nullable|numeric"
        ];
    }

    public function shareQuery(BuilderQuery $builderQuery): void
    {
        $builderQuery->addString("page", $this->input("page"));
    }
}
