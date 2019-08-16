<?php

declare(strict_types=1);

namespace Emagia\EntityBuilder;

use Emagia\Entities\AbstractEntity;
use Emagia\Entities\Beast;

/**
 * Class BeastBuilder
 * @package Emagia\EntityBuilder
 */
class BeastBuilder
    extends AbstractBuilder
    implements EntityBuilderInterface
{

    /** @var Beast */
    protected $beast;

    /**
     * Make entity
     *
     * @param string $name
     * @return mixed
     */
    public function makeEntity(string $name)
    {
        $this->beast = new Beast;
        $this->beast->setName($name);

        return $this;
    }

    public function setStats()
    {
        $this->beast
            ->setHealth($this->generateStatValue('health'))
            ->setStrength($this->generateStatValue('strength'))
            ->setDefence($this->generateStatValue('defence'))
            ->setSpeed($this->generateStatValue('speed'))
            ->setLuck($this->generateStatValue('luck'));

        return $this;
    }

    public function addSkills()
    {
        return $this;
    }

    /**
     * Get entity
     *
     * @return AbstractEntity
     */
    public function getEntity(): AbstractEntity
    {
        return $this->beast;
    }
}
