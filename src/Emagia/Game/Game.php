<?php

declare(strict_types=1);

namespace Emagia\Game;

use Emagia\Entities\AbstractEntity;
use Emagia\Output\OutputTrait;
use Emagia\Skills\SkillsManager;

/**
 * Class Game
 *
 * @package Emagia\Game
 */
class Game
{

    use OutputTrait;

    const NEXT_ATTACK_BY_HERO = 'hero';
    const NEXT_ATTACK_BY_BEAST = 'beast';

    /** @var AbstractEntity */
    protected $hero;

    /** @var AbstractEntity */
    protected $beast;

    /** @var SkillsManager */
    protected $skillsManager;

    /** @var int Round number */
    protected $round = 0;

    /** @var int */
    protected $maxRoundsNumber = 20;

    /** @var string Next attack entity type */
    protected $nextAttackBy = null;

    /**
     * @return AbstractEntity
     */
    public function getHero(): AbstractEntity
    {
        return $this->hero;
    }

    /**
     * @param AbstractEntity $hero
     * @return Game
     */
    public function setHero(AbstractEntity $hero): Game
    {
        $this->hero = $hero;

        return $this;
    }

    /**
     * @return AbstractEntity
     */
    public function getBeast(): AbstractEntity
    {
        return $this->beast;
    }

    /**
     * @param AbstractEntity $beast
     * @return Game
     */
    public function setBeast(AbstractEntity $beast): Game
    {
        $this->beast = $beast;

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
     * @return Game
     */
    public function setSkillsManager(SkillsManager $skillsManager): Game
    {
        $this->skillsManager = $skillsManager;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxRoundsNumber(): int
    {
        return $this->maxRoundsNumber;
    }

    /**
     * @param int $maxRoundsNumber
     * @return Game
     */
    public function setMaxRoundsNumber(int $maxRoundsNumber): Game
    {
        $this->maxRoundsNumber = $maxRoundsNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    public function incrementRound()
    {
        $this->round++;

        return $this;
    }

    /**
     * @return string
     */
    public function getNextAttackBy(): string
    {
        return $this->nextAttackBy;
    }

    /**
     * @param string $nextAttackBy
     * @return Game
     */
    public function setNextAttackBy(string $nextAttackBy): Game
    {
        $this->nextAttackBy = $nextAttackBy;

        return $this;
    }

    public function start()
    {

        $this->output("Start new battle.");

        $this->outputEntity($this->getHero());
        $this->outputEntity($this->getBeast());

        $this->checkFirstAttachEntity();

        $this->output("First attacker: " . $this->getAttacking()->getName());

        $battle = new Battle($this->getSkillsManager());
        $battle->setOutput($this->getOutput());

        $this->getSkillsManager()->setOutput($this->getOutput());

        while (!$this->isEndOfGame()) {
            $this->incrementRound();

            $this->output("");
            $this->output("Round #{$this->getRound()}.");
            $this->output("{$this->getAttacking()->getName()} attacks {$this->getDefending()->getName()}.");

            $battle->setAttacking($this->getAttacking());
            $battle->setDefending($this->getDefending());

            $this->swapAttacking();

            $battle->fight($this);
        }

        $this->outputEntity($this->getHero());
        $this->outputEntity($this->getBeast());

        $winner = $this->getHero()->getHealth() > $this->getBeast()->getHealth() ? $this->getHero() : $this->getBeast();

        $this->output("End of game. Winner: {$winner->getName()}");

        return true;
    }


    /**
     * Check end of game
     *
     * @return bool
     */
    public function isEndOfGame()
    {
        if ($this->getRound() > $this->getMaxRoundsNumber()) {
            return true;
        }

        if (!$this->getHero()->isAlive()) {
            return true;
        }

        if (!$this->getBeast()->isAlive()) {
            return true;
        }

        return false;
    }

    public function checkFirstAttachEntity()
    {
        $this->nextAttackBy = static::NEXT_ATTACK_BY_HERO;

        // Let hero attach first on equals speed
        if ($this->getHero()->getSpeed() > $this->getBeast()->getSpeed()) {
            $this->nextAttackBy = static::NEXT_ATTACK_BY_HERO;
        } elseif ($this->getHero()->getSpeed() < $this->getBeast()->getSpeed()) {
            $this->nextAttackBy = static::NEXT_ATTACK_BY_BEAST;
        } elseif ($this->getHero()->getLuck() > $this->getBeast()->getLuck()) {
            $this->nextAttackBy = static::NEXT_ATTACK_BY_HERO;
        } elseif ($this->getHero()->getLuck() < $this->getBeast()->getLuck()) {
            $this->nextAttackBy = static::NEXT_ATTACK_BY_BEAST;
        }

        return $this;
    }

    /**
     * Get attacking entity
     *
     * @return AbstractEntity
     */
    public function getAttacking()
    {
        return static::NEXT_ATTACK_BY_HERO === $this->nextAttackBy
            ? $this->getHero()
            : $this->getBeast();
    }

    /**
     * Get defending entity
     *
     * @return AbstractEntity
     */
    public function getDefending()
    {
        return static::NEXT_ATTACK_BY_HERO === $this->nextAttackBy
            ? $this->getBeast()
            : $this->getHero();
    }

    /**
     * Swap attacking
     *
     * @return $this
     */
    public function swapAttacking()
    {
        $this->nextAttackBy = static::NEXT_ATTACK_BY_HERO === $this->nextAttackBy
            ? static::NEXT_ATTACK_BY_BEAST
            : static::NEXT_ATTACK_BY_HERO;

        return $this;
    }

    public function outputEntity(AbstractEntity $entity)
    {
        return $this->output("
    {$entity->getName()}:
        Health: {$entity->getHealth()},
        Strength: {$entity->getStrength()},
        Defence: {$entity->getDefence()}
        Speed: {$entity->getSpeed()}
        Luck: {$entity->getLuck()}
        ");
    }

}
