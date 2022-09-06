<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => true,
            ],
            'email_user' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'nama_user' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'password_user' => [
                'type' => 'varchar',
                'constraint' => '255'
            ],
            'notelp_user' => [
                'type' => 'varchar',
                'constraint' => '255'
            ],
            'image_user' => [
                'type' => 'varchar',
                'constraint' => '255'
            ],
            'active_user' => [
                'type' => 'enum',
                'constraint' => ['register', 'active', 'block']
            ],
            'noted_user' => [
                'type' => 'text',
            ],
            'created_user' => [
                'type' => 'datetime',
            ],
            'updated_user' => [
                'type' => 'datetime',
            ],
            'deleted_user' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_user');

        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
