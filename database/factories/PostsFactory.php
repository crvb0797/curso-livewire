<?php

namespace Database\Factories;

use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->text(),
            //Creando imagenes
            'image' => 'posts/' . $this->faker->image('public/storage/posts', 640, 480, null, false),
            /* 1. carpeta donde se van almacenar, 2.El ancho de las imagenes, 3.El alto de las imagenes, 4.La catgoría, 5.Un booleano true->va a colocar la ruta y el nombre de la imagen, si es false->solo el nombre de imagen, concatenamos la carpeta posts/. */
        ];
    }
}
