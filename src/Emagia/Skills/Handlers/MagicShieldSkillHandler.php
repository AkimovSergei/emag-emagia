<?php

namespace Emagia\Skills\Handlers;


use Emagia\Entities\AbstractEntity;
use Emagia\Game\Game;
use Emagia\Skills\AbstractSkill;

/**
 * Class MagicShieldSkillHandler
 * @package Emagia\Skills\Handlers
 */
class MagicShieldSkillHandler
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
        $damage = (int)($damage / 2);

        $entity->treat($damage);

        $this->output("Magic shield reduce damage to {$damage}. {$entity->getName()} health is {$entity->getHealth()}");

        return $this;
    }
}
