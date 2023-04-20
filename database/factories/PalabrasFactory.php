<?php

namespace Database\Factories;
 
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Palabras>
 */
class PalabrasFactory extends Factory
{ 

    public function definition()
    {
        return [
            'palabra' => $this->faker->word(),
            'pronunciar' => $this->faker->word(),
            'fk_user' => 7,//admin local
            'fk_idioma' => 1,
            'estado' => 'aprobado'
        ];
    }
 
}
