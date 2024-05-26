<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Search | CHANS</title>
</head>

<body class="remove-padding-and-margin">
    <?php require "header.php" ?>
    <main class="flex flex-row">
        <?php require "bar-left.php" ?>
        <div class="block  main-content">
            <input type="text" id="searchTerm" placeholder="Search...">
            <button id="search" onclick="search()">Search</button>
            <div id="searchResults">
            <script>
                    function search() {
                        var searchTerm = document.getElementById("searchTerm").value;
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "searchbar.php?searchTerm=" + searchTerm, true);
                        xhr.onload = function() {
                            if (xhr.status == 200) {
                                document.getElementById("searchResults").innerHTML = xhr.responseText;
                            }
                        };
                        xhr.send();
                    }

                    // Set the search term from the URL as the value of the input field and perform a search when the page loads
                    window.onload = function() {
                        var searchTerm = new URLSearchParams(window.location.search).get('searchTerm');
                        document.getElementById("searchTerm").value = searchTerm;
                        search();
                    }
                </script>
            </div>
    </main>
    <?php require "footer.php" ?>

    </div>
</body>

</html>