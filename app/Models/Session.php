<?php
class Session
{
  private $db;

  public function __construct(PDO $pdo)
  {
    $this->db = $pdo;
  }

  public function create($userId, $categoryId, $startTime, $endTime, $notes = null)
  {
    $sql = "INSERT INTO sessions (user_id, category_id, start_time, end_time notes) VALUES (:user_id, :category_id, :start_time, :end_time, :notes)";
    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':start_time', $startTime);
    $stmt->bindValue(':end_time', $endTime);
    $stmt->bindValue(':notes', $notes, PDO::PARAM_STR);

    return $stmt->execute();
  }

  public function getByUserId($userId)
  {
    $sql = "SELECT * FROM sessions WHERE user_id = :user_id ORDER BY start_time DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $sql = "SELECT * FROM sessions WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function deleteById($id)
  {
    $sql = "DELETE FROM sessions WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
  }

  public function update($id, $categoryId, $startTime, $endTime, $notes = null)
  {

    $sql = "UPDATE  sessions SET category_id = :category_id,
    start_time = :start_time, end_time = :end_time, notes = :notes WHERE id = :id";

    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':start_time', $startTime);
    $stmt->bindValue(':end_time', $endTime);
    $stmt->bindValue(':notes', $notes, PDO::PARAM_STR);

    return $stmt->execute();
  }
}
