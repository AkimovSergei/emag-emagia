<?php

declare(strict_types=1);

namespace Emagia\Skills;

use Emagia\Exceptions\InvalidArgumentException;
use Emagia\Exceptions\InvalidSkillException;

/**
 * Class AbstractSkill
 */
abstract class AbstractSkill
{

    const USAGE_ATTACK = 'attacking';
    const USAGE_DEFEND = 'defending';

    /** @var int Probability of skill occurrence */
    protected $occurrenceProbability;

    /** @var string Skill usage */
    protected $usage;

    protected static $usageCases = [
        self::USAGE_ATTACK,
        self::USAGE_DEFEND,
    ];

    /**
     * AbstractSkill constructor.
     *
     * @param string $usage
     */
    public function __construct(string $usage)
    {
        $this->setUsage($usage);
    }

    /**
     * @return int
     */
    public function getOccurrenceProbability(): int
    {
        return $this->occurrenceProbability;
    }

    /**
     * @param int $occurrenceProbability
     * @return AbstractSkill
     */
    public function setOccurrenceProbability(int $occurrenceProbability): AbstractSkill
    {
        if ($occurrenceProbability < 0 || $occurrenceProbability > 100) {
            throw new InvalidArgumentException("Occurrence probability should be in range [0, 100]");
        }

        $this->occurrenceProbability = $occurrenceProbability;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsage(): string
    {
        return $this->usage ?? static::USAGE_DEFEND;
    }

    /**
     * @param string $usage
     * @return AbstractSkill
     */
    public function setUsage(string $usage): AbstractSkill
    {
        if (!in_array($usage, static::$usageCases)) {
            throw new InvalidSkillException("{$usage} is invalid usage case");
        }

        $this->usage = $usage;

        return $this;
    }

    /**
     * Get class name
     *
     * @return string
     */
    public function getClassName()
    {
        return static::class;
    }

    public function shouldUseSkill()
    {
        return mt_rand(0, 100) <= $this->getOccurrenceProbability();
    }

}
