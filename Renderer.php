<?php

require_once 'ArticleDTO.php';

class Renderer
{
  public function header($title = "Symfony's Blog"): void
  {
    $searchValue = (new ArticleDTO())->getSearchParam();
    echo <<<HTML
        <!doctype html>
        <html class="no-js" lang="en">

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>$title</title>
          <link rel="stylesheet" href="css/style.css">
          <link href="./css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="./css/toastify.css">
          <meta name="description" content="My blog about symfony">

          <meta property="og:title" content="$title">
          <meta property="og:type" content="website">
          <meta property="og:url" content="">
          <meta property="og:image" content="./img/symfony.svg">

          <link rel="icon" href="./symfony.ico" sizes="any">
          <link rel="icon" href="./img/symfony.svg" type="image/svg+xml">
          <link rel="apple-touch-icon" href="./img/symfony.svg">

          <meta name="theme-color" content="#fafafa">
          <script src="./js/toastify.js"></script>
          <script src="./js/app.js" defer></script>
        </head>

        <body>
        <header>
          <nav class="navbar navbar-light bg-light px-5">
            <div class="container-fluid flex justify-content-between">
              <div>
                <a class="navbar-brand" href="./">
                  <img src="img/symfony.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                  Symfony's Blog
                </a>
              </div>
              <div class="d-flex gap-5">
                <div class="nav-item">
                  <form action="./" class="d-flex">
                    <div class="col-md-8">
                      <input type="search" name="search" placeholder="Search" aria-label="Search" class="form-control" value="$searchValue">
                    </div>
                    <button class="btn btn-primary" type="submit">🔎</button>
                  </form>
                </div>
        HTML;
    //check if we are on login page
    if (!str_contains($_SERVER['REQUEST_URI'], 'login.php')) {
      echo <<<HTML
      <div class="nav-item">
          <a href="login.php" class="btn btn-success">
            Login
          </a>
        </div>
      HTML;
    }
    echo <<<HTML
      </div>

    </div>
  </nav>
</header>
HTML;

  }

  public function footer(): void
  {
    echo <<<HTML
<footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>About us</h2>
          <p>&copy; 2024 Arthur Lecompte</p>
          <p>This is a fake blog created for educational purposes about accessibility</p>
          <a href="legals.php">Legal notice</a>
        </div>
        <div class="col-md-6 text-md-end">
          <h2>Contact us</h2>
          <p><a href="mailto:example@example.com">Send a Mail</a></p>
          <p><a href="tel:+33123456789">Call us</a></p>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
HTML;
  }

  public function render($title, $content): void
  {
    //build the page
    $this->header($title);
    echo $content;
    $this->footer();
  }


}
