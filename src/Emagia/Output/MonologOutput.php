<?php

declare(strict_types=1);

namespace Emagia\Output;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class LogOutput
 * @package Emagia\Output
 */
class MonologOutput
    implements OutputInterface
{

    /** @var Logger */
    protected $log;

    /**
     * MonologOutput constructor.
     *
     * @param string $path
     * @throws \Exception
     */
    public function __construct(string $path = '')
    {
        if (empty($path)) {
            $path = __DIR__ . '/../../../logs/game.log';
        }

        $this->log = new Logger('default');
        $this->log->pushHandler(new StreamHandler($path));
    }

    /**
     * Output message to file
     *
     * @param string $message
     */
    public function output(string $message)
    {
        $this->log->info($message);
    }
}
