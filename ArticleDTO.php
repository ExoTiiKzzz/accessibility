<?php

require_once 'Database.php';

class ArticleDTO
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = Database::getPDO();
  }

  public function getSearchParam(): string
  {
    return htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES);
  }

  public function getAllArticles(): array
  {
    $search = $this->getSearchParam();
    $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE title LIKE :search OR html LIKE :search');
    $stmt->execute(['search' => "%$search%"]);
    return $stmt->fetchAll();
  }

  public function getArticle(int $articleId): array
  {
    $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE id = :id');
    $stmt->execute(['id' => $articleId]);
    return $stmt->fetch();
  }


}
