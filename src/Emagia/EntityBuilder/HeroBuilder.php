<?php

declare(strict_types=1);

namespace Emagia\EntityBuilder;

use Emagia\Entities\AbstractEntity;
use Emagia\Entities\Hero;
use Emagia\Skills\AbstractSkill;
use Emagia\Skills\MagicShieldSkill;
use Emagia\Skills\RapidStrikeSkill;

/**
 * Class HeroBuilder
 * @package Emagia\EntityBuilder
 */
class HeroBuilder
    extends AbstractBuilder
    implements EntityBuilderInterface
{

    /** @var Hero */
    protected $hero;

    /**
     * Make entity
     *
     * @param string $name
     * @return mixed
     */
    public function makeEntity(string $name)
    {
        $this->hero = new Hero;
        $this->hero->setName($name);

        return $this;
    }

    public function setStats()
    {
        $this->hero
            ->setHealth($this->generateStatValue('health'))
            ->setStrength($this->generateStatValue('strength'))
            ->setDefence($this->generateStatValue('defence'))
            ->setSpeed($this->generateStatValue('speed'))
            ->setLuck($this->generateStatValue('luck'));

        return $this;
    }

    public function addSkills()
    {
        $this->hero->addSkill(new MagicShieldSkill(AbstractSkill::USAGE_DEFEND));
        $this->hero->addSkill(new RapidStrikeSkill(AbstractSkill::USAGE_ATTACK));

        return $this;
    }

    /**
     * Get entity
     *
     * @return AbstractEntity
     */
    public function getEntity(): AbstractEntity
    {
        return $this->hero;
    }
}
