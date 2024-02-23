<?php

require_once 'CommentDTO.php';

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

if (isset($data['action'])) {
  switch ($data['action']) {
    case 'addComment':

      $comment = filter_var($data['comment'], FILTER_SANITIZE_STRING);
      $author = filter_var($data['author'], FILTER_SANITIZE_STRING);
      $articleId = filter_var($data['articleId'], FILTER_VALIDATE_INT);

      if ($comment && $author && $articleId) {

        if ((new CommentDTO())->addComment($author, $comment, $articleId)) {
          $newComment = [
            'author' => $author,
            'content' => $comment
          ];
        } else {
          header('HTTP/1.1 500 Internal Server Error');
          echo 'Error adding comment';
          die;
        }


        //return 201 status code and json data
        header('HTTP/1.1 201 Created');
        header('Content-Type: application/json');
        echo json_encode($newComment);
        die;
      }
      break;
    default:
      header('HTTP/1.1 400 Bad Request');
      echo 'Invalid requeste';
      die;
  }
} else {
  header('HTTP/1.1 400 Bad Request');
  echo 'Invalid request';
  die;
}
