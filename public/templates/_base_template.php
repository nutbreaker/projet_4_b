<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlentities($params["title"] ?? "") ?></title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/tt.svg" />
</head>

<body>
    <?php
    require_once('_header.php');
    ?>
    <main>
        <?php
        require_once($template);
        ?>
    </main>
    <?php
    require_once('_footer.php');
    ?>
</body>

</html>