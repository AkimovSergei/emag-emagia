<?php

declare(strict_types=1);

namespace Emagia\EntityBuilder;

use Emagia\Entities\AbstractEntity;

/**
 * Class Director
 * @package Emagia\EntityBuilder
 */
class Director
{

    /**
     * Build entity
     *
     * @param EntityBuilderInterface $entityBuilder
     * @param string $name
     * @return AbstractEntity
     */
    public function build(EntityBuilderInterface $entityBuilder, string $name): AbstractEntity
    {
        return $entityBuilder
            ->makeEntity($name)
            ->setStats()
            ->addSkills()
            ->getEntity();
    }

}
