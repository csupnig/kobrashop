<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="<?= $site->description()->html() ?>">
    <meta name="keywords" content="<?= $site->keywords()->html() ?>">
    <title><?= $site->name()->html() ?> | <?= $page->name()->html() ?></title>

    <!--Favicon-->
    <link rel="icon" href="/assets/images/favicon.png" type="image/png"/>

    <!-- Font Styles-->
    <!--Main Styles-->
    <?= css(['assets/css/snippets.css', '@auto']) ?>
    <?= css(['assets/css/index.css', '@auto']) ?>
    <!--Libaries-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <!--Main Scripts-->
    <script type="text/javascript" src="/assets/scripts/utils.js"></script>
    <script type="text/javascript" src="/assets/scripts/snippets.js"></script>
    <script type="text/javascript" src="/assets/scripts/scripts.js"></script>
    <script type="text/javascript" src="/assets/scripts/shop.js"></script>
  </head>
