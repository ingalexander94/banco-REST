<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('clients')->where("id >", 0)->delete();
        for ($i = 0; $i < 20; $i++) { 
			//to add 10 products. Change limit as desired
            $this->db->table('clients')->insert($this->generateClients());
        }
    }

    private function generateClients(): array
    {
        $faker = Factory::create();
        return [
            'name' => $faker->firstName(),
			'surname' => $faker->lastName(),
			'phone' => $faker->phoneNumber(),
			'email' => $faker->email(),
            'created_at' => $faker->datetime()->format('Y-m-d H:i:s')
        ];
    }
}
