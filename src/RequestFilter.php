<?php

namespace AbelAguiar\Filter;

use Illuminate\Database\Eloquent\Builder;

trait RequestFilter
{
    public function scopeFilter(Builder $builder, $request)
    {
        return (new static::$filterClass($request))->filter($builder);
    }
}
