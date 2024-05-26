<heading class="heading flex flex-row">
    <!-- <script src="../updatejs.js"></script> -->
    <link href="css/header.css" rel="stylesheet">
    <div class="logo-top-container"><a href="">
            <img src="img/new-logo.png" class="logo-top">
    </div>
    <div class="whitespace-header"></div>
    <div class="nav-container center-content flex">
        <nav class="center-content flex">
            <ul class="flex remove-padding-and-margin   center-content rm-text-deco">
                <li><a href="index.php">Home</a></li>
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="logout.php">Log&nbsp;out</a></li>'; //do not add a space, a space makes the next word go to the next rule
                } else {
                    echo '<li><a href="inloggen.php">Log&nbsp;in</a></li>'; //do not add a space, a space makes the next word go to the next rule
                }
                ?>
                <li><a href="About.php">About&nbsp;us</a></li>
                <?php
                // Check if the current page is not search.php
                if (basename($_SERVER['PHP_SELF']) != 'search.php') {
                    echo '<li>
                            <div class="search-container flex">
                                <form action="search.php" class="flex flex-row" method="GET">
                                    <input class="searchbar" type="text" placeholder="Search..." name="searchTerm" required>
                                    <button class="submit" type="submit">
                                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path fill="#1f2833"  d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</heading>