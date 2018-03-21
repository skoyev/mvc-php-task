<?php

/**
 * @authir Sertgiy Koyev
 * MySQL core class implemntation for accessing MySQL DB type.
 */
class Mysql {

    protected $conn = false;  //DB connection resources
    protected $sql;           //sql statement

    /**

     * Constructor, to connect to database, select database and set charset

     * @param $config string configuration array

     */

    public function __construct($config = array()){

        $host = isset($config['host'])? $config['host'] : 'localhost';

        $user = isset($config['user'])? $config['user'] : 'root';

        $password = isset($config['password'])? $config['password'] : '';

        $dbname = isset($config['dbname'])? $config['dbname'] : '';

        $port = isset($config['port'])? $config['port'] : '3306';

        $charset = isset($config['charset'])? $config['charset'] : '3306';

        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    }

    private function setChar($charest){
    }


    private function queryMany($sql, $params){

      try {
        $this->sql = $sql;

        $stmt = $this->conn->prepare( $this->sql );

        if(isset($params)) {

          foreach ($params as $key => $value) {
            $stmt->bindParam(":$key", $value["value"], $value["type"]);
          }
        }

  			$stmt->execute();

  			$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (! $records) {

            die('<br />Error SQL statement is '.$this->sql.'<br />');

        }

        return $records;

      } catch(PDOException $e) {
        echo "Error is - $e";
        return array();
      }
    }

    public function querySingle($sql){

        $this->sql = $sql;

        $stmt = $this->conn->prepare( $this->sql );

  			$stmt->execute();

  			$record = $stmt->fetch(PDO::FETCH_OBJ);

        if (! $record) {

            die('<br />Error SQL statement is '.$this->sql.'<br />');

        }

        return $record;
    }

    public function query($sql){

        $this->sql = $sql;

        $stmt = $this->conn->prepare( $this->sql );

  			$stmt->execute();
    }

    /**

     * Get all records

     * @access public

     * @param $sql SQL query statement

     * @return $list an 2D array containing all result records

     */

    public function getAll($sql, $params){

        $result = $this->queryMany($sql, $params);

        return $result;

    }


    public function getOne($sql){

        $result = $this->querySingle($sql);

        return $result;
    }
}
