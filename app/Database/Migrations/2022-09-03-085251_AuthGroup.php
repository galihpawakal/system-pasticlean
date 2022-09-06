<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthGroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_auth_group' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => true,
            ],
            'nama_auth_group' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'noted_auth_group' => [
                'type' => 'text',
            ],
            'created_auth_group' => [
                'type' => 'datetime',
            ],
            'updated_auth_group' => [
                'type' => 'datetime',
            ],
            'deleted_auth_group' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_auth_group');
        //  $this->forge->addForeignKey('id_var', 'variety', 'id_variety');

        $this->forge->createTable('auth_group');
    }

    public function down()
    {
        $this->forge->dropTable('auth_group');
    }
}
