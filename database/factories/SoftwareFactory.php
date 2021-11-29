<?php

namespace Database\Factories;

use App\Models\Software;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoftwareFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Software::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'software_name' => $this->faker->name(),
            'software_code' => $this->faker->text(7)
        ];
    }
}
