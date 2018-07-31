<?php

namespace AbelAguiar\Filter\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class FieldFilterMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'filter:field';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filter:field {ClassField}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new field filter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Field';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNameField($stub, $name)
                    ->replaceNamespace($stub, $name)
                    ->replaceClass($stub, $name);
    }

    /**
     * Replace the name field by filter for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNameField(&$stub, $name)
    {
        $name = str_replace($this->getNamespace($name).'\\', '', $name);

        $stub = str_replace(['Field'], [strtolower($name)], $stub);

        return $this;
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

        return str_replace('DummyClass', ($class.'Field'), $stub);
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

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name.'Field').'.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/field-filter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Filters\Fields';
    }
}
