<?php
require_once 'Renderer.php';
$previousPage = $_SERVER['HTTP_REFERER'] ?? './';

$content = <<<HTML

<main>
  <div class="container pt-5">
    <h1 class="text-center">Login</h1>

    <div class="row justify-content-center mt-5">
      <div class="col-md-10 col-lg-8">
        <form action="index.php" method="post" id="loginForm">
          <div class="mb-3">
            <label for="email" class="form-label
            ">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required autofocus autocomplete="username" />
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" />


            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" id="showPassword">
              <label class="form-check-label" for="showPassword">
                Show password
              </label>
             </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</main>
<script>
  const showPassword = document.getElementById('showPassword');
  const passwordInput = document.getElementById('password');
  showPassword.addEventListener('change', () => {
    if (showPassword.checked) {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });

  const form = document.getElementById('loginForm');
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    if (form.checkValidity()) {
        sessionStorage.setItem('message', 'You are now logged in');

        const redirect = '$previousPage';

        if (redirect) {
          window.location.href = redirect
        } else {
          window.location.href = './';
        }
    }
  });
</script>
HTML;

$renderer = new Renderer();
$renderer->render('Login', $content);
