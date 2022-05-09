<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration{
    public function up(){
        $this->forge->addField([
        		'id'          		=> [
        				'type'           => 'INT',
        				'unsigned'       => TRUE,
        				'auto_increment' => TRUE
        		],
        		'name'       		=> [
        				'type'           => 'VARCHAR',
        				'constraint'     => '75',
                        'null'           =>  FALSE
        		],
        		'surname'       		=> [
        				'type'           => 'VARCHAR',
        				'constraint'     => '75',
                        'null'           =>  FALSE
        		],
        		'phone'       		=> [
        				'type'           => 'VARCHAR',
        				'constraint'     => '20',
                        'null'           => TRUE
        		],
        		'email'       		=> [
        				'type'           => 'VARCHAR',
        				'constraint'     => '85',
                        'null'           =>  FALSE,
                        'unique'         => TRUE               
				],
				'created_at' => [
					'type' => 'timestamp'
				]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('clients');
    }

    public function down(){
        $this->forge->dropTable('clients');
    }
}