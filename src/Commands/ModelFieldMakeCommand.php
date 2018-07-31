<?php

namespace AbelAguiar\Filter\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class ModelFieldMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'filter:model';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filter:model {ClassFilter}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new filter model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Filter';

     /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
                    ->replaceClass($stub, $name);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyClass', ($class.'Filter'), $stub);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name.'Filter').'.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/model-filter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Filters';
    }
}
