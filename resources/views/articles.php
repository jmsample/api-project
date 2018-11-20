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
        <?php if (filter_var(getenv('DEMO_MODE'), FILTER_VALIDATE_BOOLEAN)) { ?>
            <span class="app-mode">Demo Mode</span>
        <?php } ?>
        <h1 class="page-title">
            River <span id="page-title-info"></span>
        </h1>
        <div>
            <label>
                Publication
            </label>
            <select>
                <option value="thejournal">TheJournal</option>
                <option>TheJournal</option>
                <option>TheJournal</option>
                <option>TheJournal</option>
            </select>
        </div>
        <table class="table" id="articles-table">
            <tr>
                <th>Headline</th>
                <th>Excerpt</th>
                <th>Image</th>
                <th>Tags</th>
            </tr>
        </table>
    </div>
  <script src="<?= $baseUrl ?>/js/main.js"></script>
  </body>
</html>
