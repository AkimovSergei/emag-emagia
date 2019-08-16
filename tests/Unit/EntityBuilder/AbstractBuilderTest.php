<?php

namespace Emagia\Tests\Unit\EntityBuilder;


use Emagia\EntityBuilder\AbstractBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractBuilderTest
 * @package Emagia\Tests\EntityBuilder
 */
class AbstractBuilderTest
    extends TestCase
{

    public $configs = [];

    /** @var AbstractBuilder */
    public $abstractBuilder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configs = [
            'hero' => [
                'health' => [
                    'min' => env('HERO_MIN_HEALTH', 70),
                    'max' => env('HERO_MAX_HEALTH', 100),
                ],
            ],
        ];

        $this->abstractBuilder = $this
            ->getMockBuilder(AbstractBuilder::class)
            ->setConstructorArgs(['configs' => $this->configs, 'entityType' => 'hero'])
            ->getMockForAbstractClass();
    }

    public function testGetConfigStat()
    {
        static::assertEquals(
            $this->configs['hero']['health']['min'],
            $this->abstractBuilder->getConfigStat('health', 'min')
        );

        static::assertEquals(
            $this->configs['hero']['health']['max'],
            $this->abstractBuilder->getConfigStat('health', 'max')
        );
    }

    public function testGenerateStatValue()
    {

        $health = $this->abstractBuilder->generateStatValue('health');

        static::assertGreaterThanOrEqual(
            $this->configs['hero']['health']['min'],
            $health
        );

        static::assertLessThanOrEqual(
            $this->configs['hero']['health']['max'],
            $health
        );
    }

    public function testSetConfigs()
    {
        $min = 5;
        $max = 10;

        $this->abstractBuilder->setConfigs([
            'hero' => [
                'health' => [
                    'min' => $min,
                    'max' => $max,
                ],
            ],
        ]);

        static::assertEquals(
            $min,
            $this->abstractBuilder->getConfigStat('health', 'min')
        );

        static::assertEquals(
            $max,
            $this->abstractBuilder->getConfigStat('health', 'max')
        );

        $health = $this->abstractBuilder->generateStatValue('health');

        static::assertGreaterThanOrEqual(
            $min,
            $health
        );

        static::assertLessThanOrEqual(
            $max,
            $health
        );
    }

}
