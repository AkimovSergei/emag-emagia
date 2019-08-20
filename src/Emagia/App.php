<?php

declare(strict_types=1);

namespace Emagia;

use Emagia\EntityBuilder\BeastBuilder;
use Emagia\EntityBuilder\Director;
use Emagia\EntityBuilder\HeroBuilder;
use Emagia\Exceptions\GameNotConfiguredException;
use Emagia\Game\Game;
use Emagia\Output\ConsoleOutput;
use Emagia\Skills\Handlers\MagicShieldSkillHandler;
use Emagia\Skills\Handlers\RapidStrikeSkillHandler;
use Emagia\Skills\MagicShieldSkill;
use Emagia\Skills\RapidStrikeSkill;
use Emagia\Skills\SkillsManager;

/**
 * Class App
 */
class App
{

    /** @var bool */
    protected $isInitialized = false;

    /** @var array Configs */
    protected $configs;

    /** @var Game */
    protected $game;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->loadConfigs();
    }

    /**
     * Load app configs
     */
    public function loadConfigs()
    {
        $this->configs = include __DIR__ . '/Configs/config.php';
    }

    /**
     * Start game
     *
     * @return bool
     * @throws GameNotConfiguredException
     */
    public function start()
    {
        if (!$this->isInitialized()) {
            throw new GameNotConfiguredException('Game not initialized yet');
        }

        return $this->game->start();
    }

    /**
     * Initialize
     *
     * @return Game
     */
    public function initialize()
    {
        $this
            ->initGame()
            ->initSkillManager()
            ->initEntities()
            ->initOutput();

        $this->setIsInitialized(true);

        return $this->game;
    }

    /**
     * Init game
     *
     * @return $this
     */
    protected function initGame()
    {
        $this->game = new Game;

        return $this;
    }

    /**
     * Init game
     *
     * @return $this
     */
    protected function initSkillManager()
    {
        $skillsManager = new SkillsManager;

        $skillsManager->addSkillHandler(
            RapidStrikeSkill::class,
            new RapidStrikeSkillHandler()
        );

        $skillsManager->addSkillHandler(
            MagicShieldSkill::class,
            new MagicShieldSkillHandler()
        );

        $this->game->setSkillsManager($skillsManager);

        return $this;
    }

    /**
     * Initialize entities
     *
     * @return $this
     */
    protected function initEntities()
    {
        $director = new Director;

        $this->game->setHero(
            $director->build(
                $this->initHeroBuilder(),
                'Orderus'
            )
        );

        $this->game->setBeast(
            $director->build(
                $this->initBeastBuilder(),
                'Wild beast'
            )
        );

        return $this;
    }

    public function initOutput()
    {
        $this->getGame()->setOutput(
//            new MonologOutput
            new ConsoleOutput
        );
    }

    /**
     * Initialize hero builder
     *
     * @return HeroBuilder
     */
    protected function initHeroBuilder()
    {
        return new HeroBuilder(
            $this->getConfigs(),
            'hero'
        );
    }

    /**
     * Initialize beast builder
     *
     * @return BeastBuilder
     */
    protected function initBeastBuilder()
    {
        return new BeastBuilder(
            $this->getConfigs(),
            'beast'
        );
    }

    /**
     * Get configs
     *
     * @return array
     */
    public function getConfigs(): array
    {
        return $this->configs;
    }

    /**
     * Set configs
     *
     * @param array $configs
     * @return App
     */
    protected function setConfigs(array $configs): App
    {
        $this->configs = $configs;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInitialized(): bool
    {
        return $this->isInitialized;
    }

    /**
     * @param bool $isInitialized
     * @return App
     */
    public function setIsInitialized(bool $isInitialized): App
    {
        $this->isInitialized = $isInitialized;

        return $this;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

}
