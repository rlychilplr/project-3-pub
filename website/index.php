<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CHANS</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="remove-padding-and-margin">
    <?php
    require 'header.php';
    ?>

    <main class="flex flex-row">
        <?php
        require "bar-left.php";
        ?>

        <div class="block main-content">
            <?php
            require "make-post.php"
            ?>

            <?php
            require "feed.php"
            ?>
        </div>
    </main>
    <?php
    require 'footer.php';
    ?>
</body>

</html>
