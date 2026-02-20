<?php
class Environment
{
  protected string $host;
  protected string $db;
  protected string $user;
  private string $password;

  function __construct()
  {
    $env = parse_ini_file(__DIR__ . "/../../.env");

    if ($env === false) {
      throw new Exception("Erro ao ler o arquivo .env");
    }

    $this->host = $env['HOST'];
    $this->db   = $env['DB'];
    $this->user = $env['USER'];
    $this->password = $env['PASSWORD'];
  }

  public function getHost(): string
  {
    return $this->host;
  }
  public function getDb(): string
  {
    return $this->db;
  }
  public function getUser(): string
  {
    return $this->user;
  }
  public function getPassword(): string
  {
    return $this->password;
  }
}

$env = new Environment();
