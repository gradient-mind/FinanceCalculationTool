<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class TemplateFilter
{
    public function filterName(Builder $query, $value)
    {
        return $query->where('name', 'like', "%{$value}%");
    }

    public function filterCategoryId(Builder $query, $value)
    {
        return $query->where('category_id', $value);
    }

    public function filterOperationId(Builder $query, $value)
    {
        return $query->whereHas('operation', function ($query) use ($value){
           $query->where('operation_id', $value);
        });
    }
}
