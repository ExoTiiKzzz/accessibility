<?php
require_once 'Renderer.php';
require_once 'CommentDTO.php';
require_once 'ArticleDTO.php';

$articles = (new ArticleDTO())->getAllArticles();

$comments = (new CommentDTO())->getNumberOfCommentsPerArticle();

$search = (new ArticleDTO())->getSearchParam();

$content = <<<HTML

  <main class="container mt-5">
  <h1 class="text-center my-4">News about Symfony</h1>
  HTML;
if ($search) {
  $content .= <<<HTML
    <div class="alert alert-primary" role="alert">
      Search results for: <strong>{$search}</strong>
    </div>
  HTML;
}

if (empty($articles)) {
  $content .= <<<HTML
    <div class="alert alert-warning" role="alert">
      No articles found
    </div>
  HTML;
} else {
  foreach ($articles as $article) {
    $commentNumber = 0;
    foreach ($comments as $comment) {
      if ($comment['articleId'] === $article['id']) {
        $commentNumber = $comment['count'];
      }
    }
    $content .= <<<HTML
    <article class="row" data-id="{$article['id']}">
    <div class="col-md-8">
      <h2 class="mb-3">{$article['title']}</h2>
      <div class="article__preview">
        {$article['html']}
      </div>
      <div class="article__comments_number">
        <a href="article.php?id={$article['id']}#comments">
          <span class="comment-number">{$commentNumber}</span> comments
        </a>
      </div>
      <a class="article-link btn btn-primary" href="article.php?id={$article['id']}">{$article['buttonText']}</a>
    </div>
    <div class="col-md-4">
      <img src="img/{$article['image']}" alt="{$article['title']}" class="img-fluid">
    </div>
  </article>
  HTML;
  }
}


$content .= <<<HTML
  </main>

HTML;

$renderer = new Renderer();

$renderer->render('Symfony\'s Blog', $content);
