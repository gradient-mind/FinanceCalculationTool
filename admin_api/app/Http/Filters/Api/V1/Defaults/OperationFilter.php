<?php


namespace App\Http\Filters\Api\V1\Defaults;


use Illuminate\Database\Eloquent\Builder;

class OperationFilter
{
    public function filterName(Builder $query, $value): Builder
    {
        return $query->where('name', 'like', "%{$value}%");
    }
}
