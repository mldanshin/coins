<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;
use App\Models\Ordering\Request as Model;

final class OrderingRequest extends BaseRequest implements BuilderQueryContract
{
    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "ordering" => "nullable|numeric|exists:ordering,id",
        ];
    }

    public function getOrdering(): Model
    {
        return new Model(
            $this->input("ordering")
        );
    }

    public function shareQuery(BuilderQuery $builderQuery): void
    {
        $builderQuery->addString("ordering", $this->input("ordering"));
    }
}
