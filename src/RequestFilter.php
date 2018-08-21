<?php

namespace AbelAguiar\Filter;

use Illuminate\Database\Eloquent\Builder;

trait RequestFilter
{
    protected $filterClass;

    public function __construct()
    {
        if (isset(self::$filter) && !empty(self::$filter)) {
            $this->filterClass = self::$filter;
        } else {
            $this->filterClass = $this->getClassNameFilter();
        }
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new $this->filterClass($request))->filter($builder);
    }

    private function getClassNameFilter()
    {
        $class = explode('\\', get_class($this));

        $namespace = $class[0];
        $className = end($class);

        return $namespace.'\\Filters\\'.$className.'Filter';
    }
}
