<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $faker = factory::create();
        $this->db->table('roles')->where("id >", 0)->delete();
        $adminRole = ['name' => 'Admin', 'created_at' => $faker->datetime()->format('Y-m-d H:i:s')];
        $clientRole = ['name' => 'Client', 'created_at' => $faker->datetime()->format('Y-m-d H:i:s')];
        $this->db->table('roles')->insert($adminRole);
        $this->db->table('roles')->insert($clientRole);
    }
}
