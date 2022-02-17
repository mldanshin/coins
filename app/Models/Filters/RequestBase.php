<?php

namespace App\Models\Filters;

interface RequestBase
{
    /**
     * @return mixed[]
     */
    public function getPairs(): array;
}
