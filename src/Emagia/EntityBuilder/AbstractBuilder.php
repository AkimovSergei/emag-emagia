<?php

declare(strict_types=1);

namespace Emagia\EntityBuilder;

/**
 * Class AbstractBuilder
 * @package Emagia\EntityBuilder
 */
abstract class AbstractBuilder
{

    /** @var array Configs */
    protected $configs;

    /** @var string Entity type */
    protected $entityType;

    /**
     * AbstractBuilder constructor.
     * @param $configs
     * @param string $entityType
     */
    public function __construct($configs, string $entityType)
    {
        $this->configs = $configs;
        $this->entityType = $entityType;
    }

    /**
     * Get config stat
     *
     * @param string $statName
     * @param string $bound
     * @param null $default
     * @return int
     */
    public function getConfigStat(string $statName, string $bound, $default = null): int
    {
        return (int)($this->configs[$this->entityType][$statName][$bound] ?? $default);
    }

    /**
     * Generate random stat value
     *
     * @param $statName
     * @return int
     */
    public function generateStatValue($statName)
    {
        return mt_rand(
            $this->getConfigStat($statName, 'min', 0),
            $this->getConfigStat($statName, 'max', 100)
        );
    }

}
