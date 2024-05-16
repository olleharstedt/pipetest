<?php

abstract class Pipe
{
    protected $_payload = null;
    public function __call(string $func, array $args)
    {
        if (method_exists($this, $func)) {
            $result = $this->$func($this->_payload, ... $args);
            $this->_payload = $result;
            return $this;
        } else {
            throw new RuntimeException("No such method: " . $func);
        }
    }
    public function pipe()
    {
        return $this->_payload;
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
        $s = "<table>\n";
        foreach ($payload as $item) {
            $s .= "<tr><td>$item</td></tr>\n";
        }
        $s .= "</table>\n";
        return $s;
    }
}

$db = new stdClass();

$sql = 'SELECT * FROM tbl_data';

$r = new ReportPipe($db);
echo $r
    ->fetchData($sql)
    ->processData()
    ->renderReport()
    ->pipe();
