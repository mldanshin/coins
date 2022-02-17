<?php

namespace App\Models\Filters;

use App\Models\Filters\RequestBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait SearchBase
{
    public function apply(RequestBase $request): Builder
    {
        $query = $this->applyObjectFromRequest($request, $this->getObject()->newQuery());
        return $this->getResult($query);
    }

    protected function getObject(): object
    {
        $className = self::MODEL;
        return new $className();
    }

    protected function getNameSpace(): string
    {
        return (new \ReflectionObject($this))->getNamespaceName();
    }

    private function applyObjectFromRequest(RequestBase $request, Builder $query): Builder
    {
        $properties = $request->getPairs();
        foreach ($properties as $name => $value) {
            $object = $this->createFilterObject($name);
            $query = $object->apply($query, $value);
        }

        return $query;
    }

    private function createFilterObject(string $className): object
    {
        $objectName = $this->getNameSpace() . "\\" . Str::studly($className);
        return new $objectName();
    }

    private function getResult(Builder $query): Builder
    {
        return $query;
    }
}
