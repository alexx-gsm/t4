<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1463241598_createPosts
    extends Migration
{

    public function up()
    {
        $this->createTable('posts', [
            'title' => ['type' => 'string'],
            'intro' => ['type' => 'text'],
            'text'  => ['type' => 'text'],
            'image' => ['type' => 'string'],
            'date'  => ['type' => 'date'],
        ]);
    }

    public function down()
    {
        $this->dropTable('posts');
    }
    
}