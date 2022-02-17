<?php

namespace App\Http\Requests;

interface BuilderQueryContract
{
    public function shareQuery(BuilderQuery $builderQuery): void;
}
