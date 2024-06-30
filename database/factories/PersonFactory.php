<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;
    private $namesUsed = []; // 使用済みの名前を管理するプロパティ

    public function definition()
    {
        $names = [
            '高橋洋介', '長谷川正久', '米田久美子', '三田彩',
            '橋本恵理奈', '田中太郎', '山田花子', '秋田涼介'
        ]; // 初期データとして使用する名前

        // まだ使用されていない名前を選択する
        do {
            $name = $this->faker->randomElement($names);
        } while (in_array($name, $this->namesUsed));

        // 使用済みの名前として記録
        $this->namesUsed[] = $name;

        $team = $this->faker->randomElement(['Aチーム', 'Bチーム', 'Cチーム']);
        $department = ($team == 'Cチーム') ? '大阪部署' : '東京部署';

        return [
            'name' => $name,
            'team' => $team,
            'department' => $department,
        ];
    }
}
