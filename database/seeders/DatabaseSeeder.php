<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Corte;
use App\Models\Horario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        $this->seedCortes();
        $this->seedTramosHorarios();
    }

    public function seedTramosHorarios(): void{
        $turnos = [
            ['mañana', '09:00'], ['mañana', '09:30'], ['mañana', '10:00'],
            ['mañana', '10:30'], ['mañana', '11:00'], ['mañana', '11:30'],
            ['mañana', '12:00'], ['mañana', '12:30'], ['mañana', '13:00'],
            ['mañana', '13:30'], ['tarde',  '17:00'], ['tarde',  '17:30'],
            ['tarde',  '18:00'], ['tarde',  '18:30'], ['tarde',  '19:00'],
            ['tarde',  '19:30'], ['tarde',  '20:00'], ['tarde',  '20:30'],
        ];

        foreach ($turnos as [$turno, $hora]) {
            Horario::create([
                'turno'        => $turno,
                'horaComienzo' => $hora,
            ]);
        }

        /*
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "09:00"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "09:30"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "10:00"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "10:30"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "11:00"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "11:30"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "12:00"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "12:30"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "13:00"));
        Horario::create(array("turno"=> "mañana", "horaComienzo" => "13:30"));

        Horario::create(array("turno"=> "tarde", "horaComienzo" => "17:00"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "17:30"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "18:00"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "18:30"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "19:00"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "19:30"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "20:00"));
        Horario::create(array("turno"=> "tarde", "horaComienzo" => "20:30"));
        */
    }


    public function seedCortes(): void{
        $cortes = [
            ['tipoPelado' => 'Corte',         'precio' => 6.50],
            ['tipoPelado' => 'Barba',         'precio' => 2.00],
            ['tipoPelado' => 'Corte + Barba', 'precio' => 8.00],
        ];

        foreach ($cortes as $datos) {
            Corte::create($datos);
        }
        
        /*
        Corte::create(array("tipoPelado" => "Corte", "precio" => 6.50));
        Corte::create(array("tipoPelado" => "Barba", "precio" => 2.00));
        Corte::create(array("tipoPelado" => "Corte + Barba", "precio" => 8.00));
        */
    }
}
