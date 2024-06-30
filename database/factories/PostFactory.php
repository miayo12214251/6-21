<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;

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
        $date = $this->faker->dateTimeBetween('-1 year', 'now');

        // People テーブルから全ての ID を取得
        $peopleIds = Person::pluck('id')->toArray();

        return [
            'created_at2' => $date,
            'body' => $this->faker->text($maxNbChars = 100),
            'appointment' => $this->faker->numberBetween(0, 10),
            'meeting' => $this->faker->numberBetween(0, 5),
            'contract' => $this->faker->numberBetween(0, 3),
            'person_id' => $this->faker->randomElement($peopleIds) // 存在する people テーブルの id をランダムに選択
        ];
    }
}