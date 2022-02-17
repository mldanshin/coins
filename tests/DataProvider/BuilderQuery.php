<?php
namespace Tests\DataProvider;

trait BuilderQuery
{
    /**
     * @param array[]|int[]|string[] $data
     */
    private function buildQuery(array $data): string
    {
        $request = "?";
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $request .= "{$key}[]=$item&";
                }
            } else {
                $request .= "$key=$value&";
            }
        }
        return $request;
    }
}
