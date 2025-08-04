<?php
use Hp\Phpexe\App\Migration;

class ProjectsMigration extends Migration {
    public function up() {
        // Add your columns here
        // Example: $this->add('column_name', 'type');
        $this->add('name','varchar(255)')
        ->add('type','varchar(255)');
    }
}