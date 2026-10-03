<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerAccounts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'account_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'meter_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'connection_type' => [
                'type'       => 'ENUM',
                'constraint' => ['residential', 'commercial', 'industrial'],
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'suspended'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('customer_accounts');
    }

    public function down()
    {
        $this->forge->dropTable('customer_accounts');
    }
}
