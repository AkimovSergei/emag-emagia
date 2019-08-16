<?php

return [

    'max_rounds' => env('MAX_ROUNDS', 20),

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

    'beast' => [

        'health' => [
            'min' => env('BEAST_MIN_HEALTH', 60),
            'max' => env('BEAST_MAX_HEALTH', 90),
        ],

        'strength' => [
            'min' => env('BEAST_MIN_STRENGTH', 60),
            'max' => env('BEAST_MAX_STRENGTH', 90),
        ],

        'defence' => [
            'min' => env('BEAST_MIN_DEFENCE', 40),
            'max' => env('BEAST_MAX_DEFENCE', 60),
        ],

        'speed' => [
            'min' => env('BEAST_MIN_SPEED', 40),
            'max' => env('BEAST_MAX_SPEED', 60),
        ],

        'luck' => [
            'min' => env('BEAST_MIN_LUCK', 25),
            'max' => env('BEAST_MAX_LUCK', 40),
        ],

    ],

];
