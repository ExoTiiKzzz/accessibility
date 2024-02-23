<?php

require_once 'Database.php';

class CommentDTO
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = Database::getPDO();
  }

  public function addComment(string $author, string $comment, int $articleId): bool
  {
    $stmt = $this->pdo->prepare('INSERT INTO comments (author, content, articleId) VALUES (:author, :comment, :article_id)');
    return $stmt->execute([
      'author' => $author,
      'comment' => $comment,
      'article_id' => $articleId
    ]);
  }

  public function getComments(int $articleId): array
  {
    $stmt = $this->pdo->prepare('SELECT * FROM comments WHERE articleId = :article_id ORDER BY id DESC');
    $stmt->execute(['article_id' => $articleId]);
    return $stmt->fetchAll();
  }

  public function getNumberOfCommentsPerArticle(): array
  {
    $stmt = $this->pdo->query('SELECT articleId, COUNT(*) as count FROM comments GROUP BY articleId');
    return $stmt->fetchAll();
  }


}
