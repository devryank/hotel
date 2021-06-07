<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 201;
        $bed = $this->faker->numberBetween(1, 2);
        return [
            'no' => $order++,
            'bed' => $bed,
            'price' => $bed == 1 ? 450000 : 600000,
        ];
    }
}
