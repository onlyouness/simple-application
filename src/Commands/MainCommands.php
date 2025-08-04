<?php
namespace Hp\Phpexe\Commands;

use Hp\Phpexe\App\Database\Db;

class MainCommands
{
    private function get_arg_value(array $args, string $target_arg): bool | string
    {
        $to_skip = [0];

        foreach ($args as $i => $arg) {
            if (in_array($i, $to_skip)) {
                continue;
            }

            // Check for exact match
            if ($arg === $target_arg) {

                return true;
                break;
            }

            // Check for arg:value format
            if (
                substr($arg, 0, strlen($target_arg)) === $target_arg &&
                isset(explode(':', $arg)[1])
            ) {
                return explode(':', $arg)[1];
            }
        }

        return false;
    }

    public function handler(array $args)
    {
        switch ($args[1]) {
            case $this->get_arg_value($args, 'server'):

                $port = $this->get_arg_value($args, '--port') ? $this->get_arg_value($args, '--port') : env('ENV_PORT', '3333');
                exec('php -S localhost:' . $port . ' -t .');
                exit(1);

            case $this->get_arg_value($args, 'make') == 'migration':
                $tablename = $this->get_arg_value($args, '--table');

                if (! $tablename) {
                    echo "Error: --table argument is required.\n";
                    exit(1);
                }

                $filename = _MIGRATION_DIR_ . '/' . $tablename . '.php';

                if (file_exists($filename)) {
                    echo "Migration file already exists: $filename\n";
                    exit(1);
                }

                $className = ucfirst($tablename) . 'Migration';

                $template = <<<PHP
                    <?php
                    use Hp\Phpexe\App\Migration;

                    class $className extends Migration {
                        public function up() {
                            // Add your columns here
                            // Example: \$this->add('column_name', 'type');
                        }
                    }
                    PHP;

                file_put_contents($filename, $template);

                echo "Migration file created: $filename\n";
                exit(1);
            case $this->get_arg_value($args, 'migrate'):
                $tablename = $this->get_arg_value($args, '--table');
                if (! $tablename) {
                    echo "Error: --table argument is required.\n";
                    exit(1);
                }
                if (! preg_match('/^[a-zA-Z0-9_]+$/', $tablename)) {
                    echo "Error: Invalid table name.\n";
                    exit(1);
                }

                $filename = _MIGRATION_DIR_ . '/' . $tablename . '.php';
                if (! file_exists($filename)) {
                    echo "Migration file doesn't exist: $filename\n";
                    exit(1);
                }
                require_once $filename;
                $className = ucfirst($tablename) . 'Migration';
                $migration = new $className;
                $migration->up();
                $columns   = [];
                $columns[] = "`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
                foreach ($migration->columns as $name => $type) {
                    $columns[] = "`$name` $type";
                }
                $columns[] = "`created_at` datetime";
                $columns[] = "`updated_at` datetime";

                $query = "CREATE TABLE IF NOT EXISTS `" . $tablename . "` (\n";
                $query .= implode(",\n", $columns);
                $query .= "\n)";
                $db     = Db::getConnection();
                $result = $db->query($query)->execute();
                if ($result) {
                    echo "Migration run successfully";
                } else {
                    echo "Something went wrong...";
                }
                exit(1);
        }
    }
}


