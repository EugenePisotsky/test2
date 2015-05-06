<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title><?=$title ?></title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="/css/styles.css?v=1.0">
</head>

<body>
    <div id="wrapper">
        <div class="lang-change__block">
            <a href="/?page=lang&l=ru">рус</a> <span>|</span> <a href="/?page=lang&l=en">eng</a>
        </div>

        <?php require Config::$values['templatesDir'] . $template . '.tpl.php' ?>

        <div class="clear">&nbsp;</div>
    </div>

    <script src="/js/core.js"></script>
    <script src="/js/ajax.js"></script>
    <script src="/js/callbacks.js"></script>
</body>
</html>