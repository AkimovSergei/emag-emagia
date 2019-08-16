<?php

namespace Emagia\Skills\Handlers;

use Emagia\Entities\AbstractEntity;
use Emagia\Game\Game;
use Emagia\Output\OutputInterface;
use Emagia\Skills\AbstractSkill;

/**
 * Class SkillHandlerInterface
 * @package Emagia\Skills\Handlers
 */
interface SkillHandlerInterface
{

    /**
     * Handle skill
     *
     * @param Game $game
     * @param AbstractEntity $entity
     * @param AbstractSkill $skill
     * @param int $damage
     * @return mixed
     */
    public function handle(Game $game, AbstractEntity $entity, AbstractSkill $skill, int $damage);

    /**
     * Set output
     *
     * @param OutputInterface $output
     * @return mixed
     */
    public function setOutput(OutputInterface $output);

}
