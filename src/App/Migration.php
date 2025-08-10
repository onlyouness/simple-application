<?php

namespace Hp\Phpexe\App;

use Hp\Phpexe\App\Database\Db;

class Migration
{
    public Db $db;

    public array $columns = [];
    public array $constraints = [];

    public function __construct()
    {
        $this->db = new Db();
    }
    private function name(string $name)
    {
        $this->columns[$name] = ['name' => $name];
        $this->setActiveColumn($name);
    }
    public function id()
    {
        $this->name('id');
        $this->set_prop('type', 'INT');
        $this->set_prop('auto_increment', 'AUTO_INCREMENT');
        $this->set_prop('primary_key', 'PRIMARY KEY');
        $this->notnull();
        return $this;
    }
    public function string($column): self
    {
        $this->name($column);
        $this->set_prop('type', 'VARCHAR(255)');
        return $this;
    }

    public function nullable(): self
    {
        $this->set_prop('nullable', 'NULL');
        return $this;
    }

    public function notnull(): self
    {
        $this->set_prop('nullable', 'NOT NULL');
        return $this;
    }
    public function unique(array | string $columns): self
    {
        if (is_string($columns)) {
            $this->constraints['unique'][] = [$columns];
        }
        if (is_array($columns)) {
            $this->constraints['unique'][] = $columns;
        }
        return $this;
    }

    private function setActiveColumn($name): void
    {
        foreach ($this->columns as &$col) {
            $col['active'] = 0;
        }
        $this->columns[$name]['active'] = 1;
    }

    private function set_prop(string $key, string | int $value): void
    {
        foreach ($this->columns as $col) {
            if (!$col['active']) continue;
            $this->columns[$col['name']][$key] = $value;
            break;
        }
    }

    public function tablequery(): string
    {
        // get table name from class name ex: TestMigration -> test
        $table_name = strtolower(substr(get_called_class(), 0, strlen(get_called_class()) - strlen('Migration')));
        $query_string = 'CREATE TABLE IF NOT EXISTS ' . $table_name . '(';

        // loop on table coumns
        foreach ($this->columns as $i => $col) {
            $query_string .= $col['name'] . ' ' . $col['type'];
            if (isset($col['nullalbe'])) {
                $query_string .=  ' ' . $col['nullable'];
            }
            if (isset($col['unique'])) {
                $query_string .=  ' ' . $col['unique'];
            }
            if (!(array_key_last($this->columns) == $i)) {
                $query_string .= ', ';
            }
        }
        // $query_string .= implode(',',$this->constraints).'';
        foreach ($this->constraints as $key => $val) {
            if ($key == 'unique') {
                if (!is_array($val)) continue;
                // dd([$key, $val]);
                $unique_string = [];
                foreach ($val as $item) {
                    $unique_string[] = 'UNIQUE (' . implode(',', $item) . ')';
                }
                $query_string .= ',' . implode(', ', $unique_string);
            }
        }
        $query_string .= ')';
        return $query_string;
    }
    public function execute()
    {
        $query =  $this->tablequery();
        // dd($query);
        $db = $this->db->getConnection();
        $result =  $db->query($query)->execute();
        if ($result) {
            echo "Migration run successfully";
        } else {
            echo "Something went wrong...";
        }
        exit(1);
    }
}
