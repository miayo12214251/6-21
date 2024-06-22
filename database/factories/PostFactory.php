<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition()
    {
           $date =fake()->dateTimeBetween('-1 year', 'now');
           
            $names = [
            '高橋洋介', '長谷川正久', '米田久美子', '三田彩',
            '橋本恵理奈', '田中太郎', '山田花子', '秋田涼介'
            ];
           
            return [
            'created_at2' =>$date->format('Y年n月j日'),
            'name' =>  fake()->randomElement($names),
            'body' => fake()->text($maxNbChars = 100),
            'appointment' => fake()->numberBetween(0,10),
            'meeting' => fake()->numberBetween(0,5),
            'contract' => fake()->numberBetween(0,3),
        ];
    }
}