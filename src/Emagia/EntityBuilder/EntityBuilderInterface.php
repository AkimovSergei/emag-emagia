<?php

declare(strict_types=1);

namespace Emagia\EntityBuilder;

use Emagia\Entities\AbstractEntity;

/**
 * Class EntityBuilderInterface
 * @package Emagia\EntityBuilder
 */
interface EntityBuilderInterface
{

    /**
     * Make entity
     *
     * @param string $name
     * @return $this
     */
    public function makeEntity(string $name);

    /**
     * Set random stats
     *
     * @return $this
     */
    public function setStats();

    /**
     * Add entity skills
     *
     * @return $this
     */
    public function addSkills();

    /**
     * Get entity
     *
     * @return AbstractEntity
     */
    public function getEntity(): AbstractEntity;

}
