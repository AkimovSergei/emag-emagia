<?php

declare(strict_types=1);

namespace Emagia\Game;

use Emagia\Entities\AbstractEntity;
use Emagia\Output\OutputTrait;
use Emagia\Skills\AbstractSkill;
use Emagia\Skills\SkillsManager;

/**
 * Class Battle
 * @package Emagia\Game
 */
class Battle
{

    use OutputTrait;

    /** @var AbstractEntity */
    protected $attacking;

    /** @var AbstractEntity */
    protected $defending;

    /** @var SkillsManager */
    protected $skillsManager;

    public function __construct(SkillsManager $skillsManager)
    {
        $this->skillsManager = $skillsManager;
    }

    public function fight(Game $game)
    {
        $this
            ->getDefending()
            ->applyDamage($damage = $this->calculateDamage());

        $this->output("{$this->getAttacking()->getName()} damage {$this->getDefending()->getName()} on {$damage}. Health: {$this->getDefending()->getHealth()}");

        foreach ($this->getDefending()->getSkills() as $skill) {
            if (AbstractSkill::USAGE_DEFEND === $skill->getUsage()) {
                $this->skillsManager
                    ->useSkill($game, $this->getDefending(), $skill, $damage);
            }
        }

        if (!$this->getDefending()->isAlive()) {
            return $this;
        }

        foreach ($this->getAttacking()->getSkills() as $skill) {
            if (AbstractSkill::USAGE_ATTACK === $skill->getUsage()) {
                $this->skillsManager
                    ->useSkill($game, $this->getAttacking(), $skill, $damage);
            }
        }

        return $this;
    }

    /**
     * @return AbstractEntity
     */
    public function getAttacking(): AbstractEntity
    {
        return $this->attacking;
    }

    /**
     * @param AbstractEntity $attacking
     * @return Battle
     */
    public function setAttacking(AbstractEntity $attacking): Battle
    {
        $this->attacking = $attacking;
        return $this;
    }

    /**
     * @return AbstractEntity
     */
    public function getDefending(): AbstractEntity
    {
        return $this->defending;
    }

    /**
     * @param AbstractEntity $defending
     * @return Battle
     */
    public function setDefending(AbstractEntity $defending): Battle
    {
        $this->defending = $defending;

        return $this;
    }

    /**
     * @return SkillsManager
     */
    public function getSkillsManager(): SkillsManager
    {
        return $this->skillsManager;
    }

    /**
     * @param SkillsManager $skillsManager
     * @return Battle
     */
    public function setSkillsManager(SkillsManager $skillsManager): Battle
    {
        $this->skillsManager = $skillsManager;

        return $this;
    }

    /**
     * Damage
     *
     * @return int
     */
    public function calculateDamage()
    {
        return $this->getAttacking()->getStrength() - $this->getDefending()->getDefence();
    }

}
