<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCarsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'usigned' => true, 'unsigned' => true, 'auto_increment' => true],
            'make_id' => ['type' => 'INT', 'constraint' => 11],
            'model' => ['type' => 'VARCHAR', 'constraint' => 20],
            'year' => ['type' => 'INT', 'constraint' => 5],
            'vin' => ['type' => 'VARCHAR', 'constraint' => 17],
            'detail' => ['type' => 'TEXT'],
            'image' => ['type' => 'VARCHAR', 'constraint' => 200],
            'shipping_status' => ['type' => 'INT', 'constraint' => 1], // 1=available, 2=shipped, 3=delivered
            'status' => ['type' => 'BOOLEAN', 'default' => TRUE],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp',
        ]);
        //$this->forge->addForeignKey('make_id','cars_make','id','','', 'cars_make_fk');
        $this->forge->addKey('id');
        $this->forge->createTable('cars');
    }
    

    public function down()
    {
        $this->forge->dropForeignKey('cars_make_fk', 'make_id');
        $this->forge->dropTable('cars');
    }
}
