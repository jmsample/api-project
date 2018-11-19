<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $baseUrl = dirname($_SERVER['PHP_SELF']); ?>
    <meta name="baseUrl" content="<?= $baseUrl ?>" id="baseUrl">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?= $baseUrl ?>/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/main.css">
    <title>Thought River - Contract Viewer</title>
  </head>
  <body>
    <noscript>
You need to enable JavaScript to run this app.
    </noscript>
    <div id="root">
        <table class="responsive-table">
            <tr>
                <th>Headline</th>
                <th>Excerpt</th>
                <th>Image</th>
            </tr>
        </table>
    </div>
  <script src="<?= $baseUrl ?>/js/main.js"></script>
  </body>
</html>
