<?php

use Hp\Phpexe\App\Database\Db;
use Hp\Phpexe\App\Migration;

class ProjectsMigration extends Migration
{


    public function up()
    {
        // Add your columns here
        // Example: $this->add('column_name', 'type');
        $this->id();
        $this->string('first_name');
        $this->string('last_name')->notnull();
        $this->string('birthday')->notnull();
        
        $this->unique('birthday');
        $this->unique('last_name');
        $this->unique(['last_name', 'birthday']);
    }
}
