<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'usigned' => true, 'unsigned' => true, 'auto_increment' => true],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 200],
            'password' => ['type' => 'VARCHAR', 'constraint' => 200],
            'status' => ['type' => 'BOOLEAN', 'default' => true],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
