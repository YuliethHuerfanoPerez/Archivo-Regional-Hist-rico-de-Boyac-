<?php
  class database{
    private $host;
    private $dbName;
    private $user;
    private $pass;
    public function __contruct(){
      $this->host = 'bnnrakaprj68etyfgeup-mysql.services.clever-cloud.com:3308';
      $this->dbName = 'bnnrakaprj68etyfgeup';
      $this->user = 'uzbgrzyqtao9owkh';
      $this->pass = 'SDaJjPgYPuoS5GLqSeL6';
    }
    function connection(){
      try {
        $datadb = "mysql:host= $this->host ;dbname = $this->dbName";
        $conn = new PDO($datadb, $user, $pass);
        return $conn;
      }catch (PDOException $e) {
        die('Conexion Fallida: ' . $e->getMessage());
      }
    }
  }
  
?>