<?php
require_once 'Renderer.php';

$content = <<<HTML

  <main class="container mt-5">
  <h1 class="text-center my-4">Legal information</h1>
  <p>
    This website is a demo project for educational purposes. All content is fictional and designed to showcase the Symfony framework.
  </p>
  <p>
    Symfony is a trademark of Symfony SAS. The Symfony logo, the hexagonal logo, and the Symfony-related icons are trademarks of Symfony SAS.
  </p>
  <p>
    This website is not affiliated with Symfony SAS.
  </p>
  <p>
    The source code of this website is available on <a href="https://github.com/ExoTiiKzzz/accessibility" target="_blank">GitHub</a>.
  </p>
  <p>
    This website is accessible to everyone, including people with disabilities. If you notice any accessibility issues, please send a message to <a href="mailto:exotiikzthereal@gmail.com">exotiikzthereal@gmail.com</a>.

  </p>
  <p>
    I do not collect any personal data. This website does not use cookies.
  </p>
  <p>
    This website is hosted on Ionos.
  </p>

  <p>
  Test
</p>

  </main>
HTML;

$renderer = new Renderer();
$renderer->render('Legal notice', $content);
