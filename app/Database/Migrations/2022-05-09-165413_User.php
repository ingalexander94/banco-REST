<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          		=> [
                    'type'           => 'INT',
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
            ],
            'username'       		=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                    'null'           => FALSE,
                    'unique'         => TRUE
            ],
            'password'       		=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '255',
                    'null'           => FALSE
            ],
            'role_id'       		=> [
                    'type'           => 'INT',
                    'unsigned'       => TRUE,
                    'null'           => FALSE
            ],
            'created_at' => [
                'type' => 'timestamp'
            ]
    ]);
    $this->forge->addKey('id', TRUE);
    $this->forge->addForeignKey('role_id', 'roles', 'id');
    $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
