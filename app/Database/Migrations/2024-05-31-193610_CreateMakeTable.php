<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMakeTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => ['type' => 'INT', 'usigned' => true, 'unsigned' => true, 'auto_increment' => true],
                'title' => ['type' => 'VARCHAR', 'constraint' => 100],
                'status' => ['type' => 'BOOLEAN', 'default' => TRUE]
            ]
        );
        $this->forge->addKey('id');
        $this->forge->createTable('cars_make');
    }

    public function down()
    {
        $this->forge->dropTable('cars_make');
    }
}
