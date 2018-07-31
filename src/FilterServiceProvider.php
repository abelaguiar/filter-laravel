<?php

namespace AbelAguiar\Filter;

use Illuminate\Support\ServiceProvider;
use AbelAguiar\Filter\Commands\ModelFieldMakeCommand;
use AbelAguiar\Filter\Commands\FieldFilterMakeCommand;

class FilterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FieldFilterMakeCommand::class,
                ModelFieldMakeCommand::class,
            ]);
        }
    }
}
