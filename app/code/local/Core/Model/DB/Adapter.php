<?php
class Core_Model_DB_Adapter
{
    protected $_config = [
        "hostname" => "localhost",
        "dbname" => "cybercomtest",
        "username" => "root",
        "password" => "",
    ];
    public $connect = Null;

    public function connect()
    {
        if ($this->connect == NULL) {
            $this->connect = mysqli_connect(
                $this->_config['hostname'],
                $this->_config['username'],
                $this->_config['password'],
                $this->_config['dbname']
            );
        }
        return $this->connect;
    }

    public function fetchAll($query)
    {
        $result = mysqli_query($this->connect(), $query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function fetchRow($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
        // return $result->fetch_assoc();
    }
    public function insert($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($result) {
            return mysqli_insert_id($this->connect());
        }
        return false;
    }
    public function query($query)
    {
        $result = mysqli_query($this->connect(), $query);
        return $result;
    }
}
