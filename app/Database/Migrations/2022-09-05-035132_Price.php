<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Price extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_price' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'kd_client_region_3' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'id_atm_kategori' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'value_price' => [
                'type' => 'enum',
                'constraint' => ['masuk', 'alfa', 'izin', 'sakit', 'telat', 'libur'],
            ],
            'noted_price' => [
                'type' => 'text',
            ],
            'created_price' => [
                'type' => 'datetime',
            ],
            'updated_price' => [
                'type' => 'datetime',
            ],
            'deleted_price' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_price');
        $this->forge->addForeignKey('kd_client_region_3', 'client_region_3', 'kd_client_region_3');
        $this->forge->addForeignKey('id_atm_kategori', 'atm_kategori', 'id_atm_kategori');

        $this->forge->createTable('price');
    }

    public function down()
    {
        $this->forge->dropTable('price');
    }
}
