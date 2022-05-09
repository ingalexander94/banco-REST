<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration{
    public function up(){
        $this->forge->addField([
        		'id'          		=> [
        				'type'           => 'INT',
        				'unsigned'       => TRUE,
        				'auto_increment' => TRUE
        		],
        		'name'       		=> [
        				'type'           => 'VARCHAR',
        				'constraint'     => '100',
                        'null'           =>  FALSE,
                        'unique'         => TRUE             
        		],
				'created_at' => [
					'type' => 'timestamp'
				]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('roles');
    }

    public function down(){
        $this->forge->dropTable('roles');
    }
}