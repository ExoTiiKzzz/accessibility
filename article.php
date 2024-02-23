<?php

require_once 'Renderer.php';
require_once 'ArticleDTO.php';
require_once 'CommentDTO.php';

$articleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$articleId) {
  header('Location: ./');
  die;
}

$article = (new ArticleDTO())->getArticle($articleId);

if (!$article) {
  header('Location: ./');
  die;
}

$comments = (new CommentDTO())->getComments($articleId);


$content = <<<HTML

                <main class="container mt-5">
                   <h1 id="title" class="text-center my-5">{$article['title']}</h1>
                   <small class="text-muted"><a href="./">Home</a> > {$article['title']}</small>
                  <article>

                    <div class="d-flex w-100 justify-content-center">
                      <img class="article__image" src="img/{$article['image']}" alt="{$article['title']}" width="400" id="image">
                    </div>

                     {$article['html']}
                    <table id="table" class="table table-striped table-bordered">
                      <caption>Features and description</caption>
                      <thead>
                      <tr>
HTML;
$article['detailTable'] = json_decode($article['detailTable'], true);
foreach ($article['detailTable']['headers'] as $header) {
  $content .= "<th>$header</th>";
}

$content .= <<<HTML
                </tr>
                </thead>
                <tbody>
                HTML;
foreach ($article['detailTable']['rows'] as $row) {
  $content .= '<tr>';
  foreach ($row as $cell) {
    $content .= "<td>$cell</td>";
  }
  $content .= '</tr>';
}

$content .= <<<HTML
                </tbody>
                </table>
                </article>

                  <div id="comments">
                    <h1 class="text-center my-5">Comments</h1>

                    <div id="comment-form-container" class="row justify-content-center">
                      <form id="comment-form" class="mb-4">
                        <div class="mb-3 col-lg-6 col-md-8 col-sm-12">
                          <label for="author">Author</label>
                          <input type="text" class="form-control" id="author" name="author" required maxlength="255">
                        </div>
                        <div class="mb-3">
                          <label for="comment" class="form-label">Comment</label>
                          <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post a comment</button>
                      </form>
                    </div>

                    <div id="comment-list" class="row justify-content-center">
                HTML;

foreach ($comments as $comment) {
  $content .= <<<HTML
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="card-title">{$comment['author']}</div>
                      <p class="card-text">{$comment['content']}</p>
                    </div>
                  </div>
                  HTML;
}

$content .= <<<HTML
              </div>
            </div>
          </main>

          <script>
            const commentForm = document.getElementById('comment-form');
            const commentList = document.getElementById('comment-list');

            commentForm.addEventListener('submit', function (event) {
              event.preventDefault();
              const author = event.target.author.value;
              const comment = event.target.comment.value;

              if (author.trim() === '' || comment.trim() === '') {
                alert('Author and comment are required');
                return;
              }

              //add it to the comments.json file
              fetch('./trait.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  'author': author,
                  'comment': comment,
                  'articleId': $articleId,
                  'action': 'addComment'
                })
              })
                .then(response => response.json())
                .then(data => {
                  let div = document.createElement('div');
                  div.classList.add('card', 'mb-3');
                  div.innerHTML = `
                      <div class="card-body">
                        <div class="card-title">` + author + `</div>
                        <p class="card-text">` + comment + `</p>
                    </div>
                  `;
                  let oldComments = commentList.innerHTML;
                  commentList.innerHTML = '';
                  commentList.appendChild(div);
                  commentList.innerHTML += oldComments;
                });


              //add the new comment to the list


              //clear the form
              event.target.author.value = '';
              event.target.comment.value = '';
            });

          </script>

          HTML;

$renderer = new Renderer();

$renderer->render($article['title'], $content);
