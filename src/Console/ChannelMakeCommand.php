<?php

namespace Bfg\Route\Console;

class ChannelMakeCommand extends \Illuminate\Foundation\Console\ChannelMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/channel.stub';
    }
}
