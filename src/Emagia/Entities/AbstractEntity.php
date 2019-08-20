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
     * @return self
     */
    public function setName(string $name): self
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
     * @return self
     */
    public function setHealth(int $health): self
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
     * @return self
     */
    public function setStrength(int $strength): self
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
     * @return self
     */
    public function setDefence(int $defence): self
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
     * @return self
     */
    public function setSpeed(int $speed): self
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
     * @return self
     */
    public function setLuck(int $luck): self
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
     * @return self
     */
    public function setSkills(array $skills): self
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
     * @return self
     */
    public function addSkill(AbstractSkill $skill): self
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
     * @return self
     */
    public function applyDamage($damage): self
    {
        $this->health = max($this->health - $damage, 0);

        return $this;
    }

    /**
     * Apply damage
     *
     * @param $health
     * @return self
     */
    public function treat($health): self
    {
        $this->health = min($this->health + $health, 100);

        return $this;
    }

    /**
     * Check is entity alive
     *
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->getHealth() > 0;
    }

}
