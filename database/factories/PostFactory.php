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
           
            return [
            'created_at2' =>$date->format('Y年n月j日'),
            'name' =>  fake()->name(),
            'body' => fake()->text($maxNbChars = 6),
        ];
    }
}