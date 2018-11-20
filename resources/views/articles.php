<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $baseUrl = str_replace('/public', '', dirname($_SERVER['PHP_SELF'])); ?>
    <meta name="baseUrl" content="<?= $baseUrl ?>" id="baseUrl">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/main.css">
    <title>TheJournal - River Viewer</title>
  </head>
  <body>
    <noscript>
You need to enable JavaScript to run this app.
    </noscript>
    <div class="container">
        <table class="table" id="articles-table">
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
