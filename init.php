<?php

//get articles

$articles = json_decode(file_get_contents('data/articles.json'), true);


//get comments
$comments = json_decode(file_get_contents('data/comments.json'), true);


$pdo = new PDO('sqlite:./data/db.sqlite');


//$createArticlesTable = "CREATE TABLE IF NOT EXISTS articles (
//  id INTEGER PRIMARY KEY AUTOINCREMENT,
//  title TEXT NOT NULL,
//  html TEXT NOT NULL,
//  detailTable JSON NOT NULL,
//  image VARCHAR(255) NOT NULL
//)";
//
//$pdo->exec($createArticlesTable);
//
//$createCommentsTable = "CREATE TABLE IF NOT EXISTS comments (
//  id INTEGER PRIMARY KEY AUTOINCREMENT,
//  articleId INTEGER NOT NULL,
//  author varchar(255) NOT NULL,
//  content TEXT NOT NULL
//)";
//
//$pdo->exec($createCommentsTable);
//
//$articles = json_decode(file_get_contents('data/articles.json'), true);
//
//$comments = json_decode(file_get_contents('data/comments.json'), true);
//
//$pdo->beginTransaction();
//
//$statement = $pdo->prepare("INSERT INTO articles (id, title, html, detailTable, image) VALUES (:id, :title, :html, :detailTable, :image)");
//
//foreach ($articles as $article) {
//  $statement->execute([
//    'id' => $article['id'],
//    'title' => $article['title'],
//    'html' => $article['html'],
//    'detailTable' => json_encode($article['table']),
//    'image' => $article['image']
//  ]);
//}
//
//$pdo->commit();

//$pdo->beginTransaction();
//
//$statement = $pdo->prepare("INSERT INTO comments (articleId, author, content) VALUES (:articleId, :author, :content)");
//
//foreach ($comments as $article) {
//  $id = $article['articleId'];
//  $articleComments = $article['comments'];
//  foreach ($articleComments as $comment) {
//    $statement->execute([
//      'articleId' => $id,
//      'author' => $comment['author'],
//      'content' => $comment['content']
//    ]);
//  }
//}
//
//$pdo->commit();

