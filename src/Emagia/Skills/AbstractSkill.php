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

    /** @var array Skill use cases */
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
     * @return self
     */
    public function setOccurrenceProbability(int $occurrenceProbability): self
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
     * @return self
     */
    public function setUsage(string $usage): self
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
    public function getClassName(): string
    {
        return static::class;
    }

    /**
     * Calculate skill usage probability
     *
     * @return bool
     */
    public function shouldUseSkill(): bool
    {
        return mt_rand(0, 100) <= $this->getOccurrenceProbability();
    }

}
