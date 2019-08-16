<?php

declare(strict_types=1);

namespace Emagia\Entities;

use Emagia\Exceptions\InvalidSkillException;
use Emagia\Skills\AbstractSkill;

/**
 * Class Entity
 */
abstract class AbstractEntity
{

    /** @var string Entity name */
    protected $name;

    /** @var int Entity health */
    protected $health;

    /** @var int Entity strength */
    protected $strength;

    /** @var int Entity defence */
    protected $defence;

    /** @var int Entity speed */
    protected $speed;

    /** @var int Entity luck */
    protected $luck;

    /** @var array Entity skills */
    protected $skills;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AbstractEntity
     */
    public function setName(string $name): AbstractEntity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return AbstractEntity
     */
    public function setHealth(int $health): AbstractEntity
    {
        $this->health = $health;

        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return AbstractEntity
     */
    public function setStrength(int $strength): AbstractEntity
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     * @return AbstractEntity
     */
    public function setDefence(int $defence): AbstractEntity
    {
        $this->defence = $defence;

        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return AbstractEntity
     */
    public function setSpeed(int $speed): AbstractEntity
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param int $luck
     * @return AbstractEntity
     */
    public function setLuck(int $luck): AbstractEntity
    {
        $this->luck = $luck;

        return $this;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills ?? [];
    }

    /**
     * @param array $skills
     * @return AbstractEntity
     */
    public function setSkills(array $skills): AbstractEntity
    {
        foreach ($skills as $skill) {
            $this->addSkill($skill);
        }

        return $this;
    }

    /**
     * Add skill
     *
     * @param AbstractSkill $skill
     * @return $this
     */
    public function addSkill(AbstractSkill $skill)
    {
        if (!$skill instanceof AbstractSkill) {
            throw new InvalidSkillException('Invalid skill');
        }

        $this->skills[$skill->getClassName()] = $skill;

        return $this;
    }

    /**
     * Apply damage
     *
     * @param $damage
     * @return AbstractEntity
     */
    public function applyDamage($damage)
    {
        $this->setHealth(
            max($this->getHealth() - $damage, 0)
        );

        return $this;
    }

    /**
     * Apply damage
     *
     * @param $damage
     * @return AbstractEntity
     */
    public function treat($health)
    {
        $this->setHealth(
            min($this->getHealth() + $health, 100)
        );

        return $this;
    }

    /**
     * Check is entity alive
     *
     * @return bool
     */
    public function isAlive()
    {
        return $this->getHealth() > 0;
    }

}
