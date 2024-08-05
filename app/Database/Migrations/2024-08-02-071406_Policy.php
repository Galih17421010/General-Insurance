<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Policy extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_nasabah' => [
                'type' => 'VARCHAR',
                'constraint' => 55,
                'null' => FALSE,
            ],
            'periode_pertanggungan' => [
                'type' => 'date',
                'null' => FALSE,
            ],
            'kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => 55,
                'null' => FALSE,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'null' => FALSE,
            ],
            'jenis' => [
                'type' => 'INT',
                'constraint' => 2,
                'null' => FALSE,
            ],
            'resiko' => [
                'type' => 'BIT',
                'null' => FALSE,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('policys');
    }

    public function down()
    {
        $this->forge->dropTable('policys');
    }
}
