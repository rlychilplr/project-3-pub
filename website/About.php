<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/about.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>About us</title>
</head>

<body class="remove-padding-and-margin">
    <?php require "header.php"; ?>
    <main class="about-main scrollbar-styling">
        <div class="head-img-wrapper-about">
            <img src=img/aboutus1.jpg class="head-img-about"> <!-- suboptimal to render a >4k img but whatever, this is the easy way to make it work on big screens (4k) -->
        </div>
        <h1 class="title-about remove-padding-and-margin">About us</h1>
        <div class="flex flex-row">
            <div class="about-padding"></div>
            <div class="main-content-about-wrapper">
                <h2 class="align-center header2 remove-padding-and-margin">CHANS</h2>
                <p class="align-center paragraph-font-size remove-padding-and-margin">Chans is a cozy social media platform where people can chat, like, and post messages. We provide a space where users can communicate, share content, and build communities. For us, it's all about creating a positive and interactive online experience for everyone.</p>
            </div>
        </div>
    </main>

    <?php require 'footer.php'; ?>
</body>

</html>