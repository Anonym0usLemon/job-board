<?php

namespace Framework;

use PDO;

class Database {
  public $conn;

  /**
   * Constructor for Database class
   * 
   * @param array $config - Host, port, database name, etc
   */
  public function __construct($config) 
  {
    $dsn = "mysql:host={$config['host']};post={$config['port']};dbname={$config['dbname']}";

    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
      $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
    } catch (PDOException $e) {
      throw new Exception('Database connection failed: ' . $e->getMessage());
    }
  }

  /**
   * Query the database 
   * 
   * @param string $query
   * @throws Exception
   * @return PDOStatement
   */
  public function query($query, $params) 
  { 
    try {
      $statement = $this->conn->prepare($query); 

      // Bind named params
      foreach($params as $param => $value) {
        $statement->bindValue(':' . $param, $value);
      }

      $statement->execute();
      return $statement;

    } catch (PDOException $e) {
      throw new Exception("Query failed to execute: " . $e->getMessage());
    }
  }

}