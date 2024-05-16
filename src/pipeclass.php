<?php

abstract class Pipe
{
    protected $_stack = null;
    public function __call(string $func, array $args)
    {
        if (method_exists($this, $func)) {
            $result = $this->$func($this->_stack, ... $args);
            $this->_stack = $result;
            return $this;
        } else {
            throw new RuntimeException("No such method: " . $func);
        }
    }
}

final class ReportPipe extends Pipe
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    protected function fetchData($payload, string $sql)
    {
        // TODO: Use $this->db to fetch data
        return [1, 2, 3];
    }

    protected function processData($payload)
    {
        $data = [];
        foreach ($payload as $item) {
            $data[] = (string) $item;
        }
        return $data;
    }

    protected function renderReport($payload)
    {
        echo "<table>\n";
        foreach ($payload as $item) {
            echo "<tr><td>$item</td></tr>\n";
        }
        echo "</table>\n";
    }
}

$db = new stdClass();

$sql = 'SELECT * FROM tbl_data';

$r = new ReportPipe($db);
$r
    ->fetchData($sql)
    ->processData()
    ->renderReport();
