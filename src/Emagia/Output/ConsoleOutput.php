<?php

namespace Emagia\Output;


/**
 * Class ConsoleOutput
 * @package Emagia\Output
 */
class ConsoleOutput
    implements OutputInterface
{

    /**
     * Output message to file
     *
     * @param string $message
     */
    public function output(string $message)
    {
        print_r($message . PHP_EOL);
    }

}
