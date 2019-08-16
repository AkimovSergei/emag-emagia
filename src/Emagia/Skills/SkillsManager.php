<?php

declare(strict_types=1);

namespace Emagia\Skills;

use Emagia\Entities\AbstractEntity;
use Emagia\Exceptions\InvalidSkillException;
use Emagia\Game\Game;
use Emagia\Output\OutputTrait;
use Emagia\Skills\Handlers\SkillHandlerInterface;

/**
 * Class SkillsManager
 *
 * @package Emagia\Skills
 */
class SkillsManager
{

    use OutputTrait;

    /** @var array Skills handlers */
    protected $skillsHandlers = [];

    /**
     * Skill handlers
     *
     * @param string $skillName
     * @param SkillHandlerInterface $skillHandler
     * @return $this
     */
    public function addSkillHandler(string $skillName, SkillHandlerInterface $skillHandler)
    {
        $this->skillsHandlers[$skillName] = $skillHandler;

        return $this;
    }

    /**
     * @return array
     */
    public function getSkillsHandlers(): array
    {
        return $this->skillsHandlers;
    }

    /**
     * Use skill while battle
     *
     * @param Game $game
     * @param AbstractEntity $entity
     * @param AbstractSkill $skill
     * @param int $damage
     * @return $this
     */
    public function useSkill(Game $game, AbstractEntity $entity, AbstractSkill $skill, int $damage)
    {
        if (!$this->isSkillHandlerExists($skill->getClassName())) {
            throw new InvalidSkillException('Invalid skill');
        }

        if (!$skill->shouldUseSkill()) {
            return $this;
        }
        
        $this
            ->getSkillHandler($skill->getClassName())
            ->setOutput($this->getOutput())
            ->handle($game, $entity, $skill, $damage);

        return $this;
    }

    /**
     * Check skill handler
     *
     * @param string $skillName
     * @return bool
     */
    public function isSkillHandlerExists(string $skillName): bool
    {
        return isset($this->skillsHandlers[$skillName]);
    }

    /**
     * Get skill handler
     *
     * @param $skillName
     * @return SkillHandlerInterface
     */
    public function getSkillHandler($skillName): SkillHandlerInterface
    {
        return $this->skillsHandlers[$skillName];
    }

}
