<?php

require_once __DIR__ . '/Environment.php';

class Connection
{
  private Environment $env;
  private PDO $pdo;
  function __construct()
  {
    $this->env = new Environment();
    try {
      $dsn = "mysql:host={$this->env->getHost()};dbname={$this->env->getDb()}";

      $this->pdo = new PDO($dsn, $this->env->getUser(), $this->env->getPassword());
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Conectado com o banco de dados.";
    } catch (PDOException $e) {
      die("Erro de conexão com o banco: " . $e);
    }
  }

  public function getPdo(): PDO
  {
    return $this->pdo;
  }
}
