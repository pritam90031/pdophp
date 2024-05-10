<?php
include('connection.php');

class DAL {
    private $_connection;

    function __construct() {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function insert($argument) {
        $columns = '';
        $values = '';

        foreach($argument['values'] as $column_name => $column_value) {
            $columns .= "`". $column_name . "`,";
            $values .= "'". $column_value . "',";
        }

        $sql = "INSERT INTO " . $argument['table'] . " (";
        $sql .= rtrim($columns, ',') . ") ";
        $sql .= "VALUES (" . rtrim($values, ',') . ")";

        $this->_connection->exec($sql);

    }

    public function update($argument) {
        $cl1 = '';
        $vl1 = '';

        $cl2 = '';
        $vl2 = '';

        foreach($argument['values'] as $column_name => $column_value) {
            $cl1 = "`". $column_name . "`";
            $vl1 = "'". $column_value . "'";
            break;
        }

        foreach($argument['values'] as $column_name => $column_value) {
            $cl2 = "`". $column_name . "`";
            $vl2 = "'". $column_value . "'";

            $sql= "UPDATE {$argument['table']}  SET {$cl2}={$vl2} WHERE {$cl1}={$vl1}";
            $this->_connection->exec($sql);
        }

        

        // $sql= "UPDATE " . $argument['table'] . "SET" . $cl2."= $vl2 WHERE". $cl1."=$vl1";
        
    }
    
    public function get($argument) {
        $cl1='';
        $vl1='';
        foreach($argument['values'] as $column_name => $column_value) {
            $cl1 .= "`". $column_name . "`";
            $vl1 =  $column_value ;
        }

       $sql=$this->_connection->prepare("SELECT * FROM {$argument['table']} WHERE {$cl1} = {$vl1} ");

        $sql->execute();

        $result = $sql->fetchALL(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    public function delete($argument) {
        $cl1='';
        $vl1='';
        foreach($argument['values'] as $column_name => $column_value) {
            $cl1 .= "`". $column_name . "`";
            $vl1 =  $column_value ;
        }

        $sql= "DELETE FROM {$argument['table']} WHERE {$cl1} = {$vl1} ";

        $this->_connection->exec($sql);

        
    }
}

$dal = new DAL();

// $dal->insert([
//     'table' => 'task_type',
//     'values' => [
//         'projects_id' => 104,
//         'name' => 'lzw',
//         'age' =>27,
//         'dept'=>"B.Tech EE"
        
//     ]
// ]);

$dal->update([
    'table'=>'task_type',
    'values'=>[
        'projects_id' => 101,
        'name' => 'Pritam Bera',
        'age'=>500
    ]
]);

// $dal->delete([
//         'table' => 'task_type',
//         'values' =>[
//             'projects_id' => 101
//         ]
// ]);


// $dal->get([
//     'table' => 'task_type',
//     'values' =>[
//         'projects_id' => 101
//     ]
// ]);









// 'created_at' => date('Y-m-d H:i:s'),
// 'updated_at' => date('Y-m-d H:i:s'),

?>
