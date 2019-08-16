<?php

namespace Emagia\Tests\Unit\EntityBuilder;


use Emagia\Entities\Hero;
use Emagia\EntityBuilder\HeroBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class HeroBuilderTest
 * @package Emagia\Tests\Unit\EntityBuilder
 */
class HeroBuilderTest
    extends TestCase
{

    /** @var HeroBuilder */
    protected $builder;

    /** @var */
    protected $configs;

    public function setUp(): void
    {
        parent::setUp();

        $this->configs = [
            'hero' => [
                'health' => [
                    'min' => env('HERO_MIN_HEALTH', 70),
                    'max' => env('HERO_MAX_HEALTH', 100),
                ],
                'strength' => [
                    'min' => env('HERO_MIN_STRENGTH', 70),
                    'max' => env('HERO_MAX_STRENGTH', 80),
                ],
                'defence' => [
                    'min' => env('HERO_MIN_DEFENCE', 45),
                    'max' => env('HERO_MAX_DEFENCE', 55),
                ],
                'speed' => [
                    'min' => env('HERO_MIN_SPEED', 40),
                    'max' => env('HERO_MAX_SPEED', 50),
                ],
                'luck' => [
                    'min' => env('HERO_MIN_LUCK', 10),
                    'max' => env('HERO_MAX_LUCK', 30),
                ],
            ],
        ];

        $this->builder = new HeroBuilder($this->configs, 'hero');

    }

    public function testMakeEntity()
    {
        $entity = $this->builder->makeEntity('Hero');

        static::assertInstanceOf(
            Hero::class,
            $entity->getEntity()
        );
    }

    public function testAddSkills () {
        $this->builder->makeEntity('Hero');
        $this->builder->addSkills();

        static::assertCount(
            2,
            $this->builder->getEntity()->getSkills()
        );
    }

}
