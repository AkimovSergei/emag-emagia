<?php

declare(strict_types=1);

namespace Emagia\Skills\Handlers;

use Emagia\Entities\AbstractEntity;
use Emagia\Game\Game;
use Emagia\Skills\AbstractSkill;

/**
 * Class RapidStrikeSkillHandler
 *
 * @package Emagia\Skills\Handlers
 */
class RapidStrikeSkillHandler
    extends AbstractSkillHandler
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
    public function handle(Game $game, AbstractEntity $entity, AbstractSkill $skill, int $damage)
    {
        $game->swapAttacking();

        $this->output("{$entity->getName()} use rapid strike and attack one more time");

        return $this;
    }

}
