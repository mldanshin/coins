<?php
namespace Tests\DataProvider;

use App\Models\Ordering\Request;

trait Ordering
{
    private function getQueryOrderingEmpty(): Request
    {
        return new Request(null);
    }
}
