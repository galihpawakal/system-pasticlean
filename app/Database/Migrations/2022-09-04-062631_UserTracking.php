<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTracking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_tracking' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'link_user_tracking' => [
                'type' => 'text',
            ],
            'noted_user_tracking' => [
                'type' => 'text',
            ],
            'created_user_tracking' => [
                'type' => 'datetime',
            ],
            'updated_user_tracking' => [
                'type' => 'datetime',
            ],
            'deleted_user_tracking' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_user_tracking');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('user_tracking');
    }

    public function down()
    {
        $this->forge->dropTable('user_tracking');
    }
}
