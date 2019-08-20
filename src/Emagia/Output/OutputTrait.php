<?php

declare(strict_types=1);

namespace Emagia\Output;

/**
 * Trait OutputTrait
 *
 * @package Emagia\Output
 */
trait OutputTrait
{

    /** @var OutputInterface */
    protected $output;

    /**
     * @return OutputInterface
     */
    public function getOutput(): OutputInterface
    {
        return $this->output;
    }

    /**
     * @param OutputInterface $output
     * @return self
     */
    public function setOutput(OutputInterface $output): self
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @param $message
     * @return mixed
     */
    public function output($message)
    {
        return $this->getOutput()->output($message);
    }

}
