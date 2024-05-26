<div class="scrollbar-styling feed">
    <div>
        <link rel="stylesheet" href="css/feed.css">
        <span class="messages remove-padding-and-margin">
            <?php
            include 'database-connect.php';

            $currentUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NULL';
            // use chatgpt or some other ai chatbot to edit this, its awesome because its just 1 query (less computation for server) but that also makes it difficult to work with
            $sql = "SELECT DISTINCT user.`user-id`, messages.`message-id`, user.displayname, user.username, messages.content, 
            (SELECT COUNT(*) FROM likes WHERE likes.`message-id` = messages.`message-id`) as totalLikes,
            (SELECT COUNT(*) FROM likes WHERE likes.`message-id` = messages.`message-id` AND likes.`user-id` = $currentUserId) as userLiked,
            medewerker.moderator, medewerker.admin
            FROM messages
            JOIN user ON user.`user-id` = messages.`user-id`
            LEFT JOIN medewerker ON user.`user-id` = medewerker.`user-id`";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo '<td><strong class="displayname">' . htmlspecialchars($row["displayname"]) . "</strong> <span class='username'>@" . htmlspecialchars($row["username"]) . "</span>";

                    // Check if the user is a moderator or admin
                    if ($row["moderator"] == 1) {
                        // we like to write 1liners (more space&bandwith efficient)
                        echo ' <svg class="moderator" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c1.8 0 3.5-.2 5.3-.5c-76.3-55.1-99.8-141-103.1-200.2c-16.1-4.8-33.1-7.3-50.7-7.3H178.3zm308.8-78.3l-120 48C358 277.4 352 286.2 352 296c0 63.3 25.9 168.8 134.8 214.2c5.9 2.5 12.6 2.5 18.5 0C614.1 464.8 640 359.3 640 296c0-9.8-6-18.6-15.1-22.3l-120-48c-5.7-2.3-12.1-2.3-17.8 0zM591.4 312c-3.9 50.7-27.2 116.7-95.4 149.7V273.8L591.4 312z"/><title>moderator</title></svg>';
                    } elseif ($row["admin"] == 1) {
                        echo ' <svg class="admin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0zm0 66.8V444.8C394 378 431.1 230.1 432 141.4L256 66.8l0 0z"/><title>admin</title></svg>';
                    }

                    echo "</td></tr><tr><td> " . nl2br(htmlspecialchars($row["content"])) . '</td></tr> <tr><td><button class="like-button" data-message-id="' . $row["message-id"] . '" data-user-id="' . $currentUserId . '" data-user-liked="' . $row["userLiked"] . '">';

                    // Check if the user has liked this message, this is only for initial load
                    if ($row["userLiked"] > 0) {
                        // SVG for liked message
                        echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill=#ffa500 d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/><title>Unlike</title></svg>';
                    } else {
                        // SVG for not liked message
                        echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill=#ffa500 d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/><title>Like</title></svg>';
                    }
                    echo '</button><span id="likes-' . $row["message-id"] . '">' . htmlspecialchars($row["totalLikes"]) . '</span></td>';
                    // If the current user is the poster of this message, output a delete button
                    if ($row["user-id"] == $currentUserId) {
                        echo '<td><button class="delete-button" data-message-id="' . $row["message-id"] . '">Delete</button></td>';
                    }
                    // If the current user is an admin, output a delete user button for every message
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                        echo '<td><button class="delete-user" data-user-id="' . $row['user-id'] . '">Delete User</button></td>';
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </span>
        <script>
            window.onload = function() {
                let buttons = document.getElementsByClassName('like-button');
                for (let i = 0; i < buttons.length; i++) {
                    buttons[i].addEventListener('click', function() {
                        let button = this; // Store the reference to the button

                        // Check if the user is logged in
                        let userId = this.getAttribute('data-user-id');
                        if (userId === 'NULL') {
                            alert('Please login to like a post.');
                            return;
                        }

                        let messageId = this.getAttribute('data-message-id');
                        let userLiked = this.getAttribute('data-user-liked') === '1';

                        // Create a FormData object
                        let formData = new FormData();
                        formData.append('message-id', messageId);
                        formData.append('user-liked', userLiked ? '1' : '0');

                        // Send an AJAX request to like.php
                        let xhr = new XMLHttpRequest();
                        xhr.open('POST', 'like.php', true);
                        xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                // Update the SVG
                                let svg = button.querySelector('svg');
                                if (userLiked) {
                                    //svg for unliked
                                    svg.innerHTML = '<path fill=#ffa500 d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/><title>Like</title>';
                                } else {
                                    // svg for liked
                                    svg.innerHTML = '<path fill=#ffa500 d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/><title>Unlike</title>';
                                }
                                // Update the likes count
                                let likesElement = document.getElementById('likes-' + messageId);
                                let likesCount = parseInt(likesElement.textContent);
                                likesElement.textContent = userLiked ? likesCount - 1 : likesCount + 1;

                                // Update the userLiked attribute
                                button.setAttribute('data-user-liked', userLiked ? '0' : '1');
                            }
                        };
                        xhr.send(formData);
                    });
                }

                let deleteButtons = document.getElementsByClassName('delete-button');
                for (let i = 0; i < deleteButtons.length; i++) {
                    deleteButtons[i].addEventListener('click', function() {
                        let button = this; // Store the reference to the button

                        // Check if the user is logged in
                        let userId = this.getAttribute('data-user-id');
                        if (userId === 'NULL') { // this should just never trigger but you never know
                            alert('Please login to delete a post.');
                            return;
                        }

                        let messageId = this.getAttribute('data-message-id');

                        // Create a FormData object
                        let formData = new FormData();
                        formData.append('message-id', messageId);

                        // Send an AJAX request to delete.php
                        let xhr = new XMLHttpRequest();
                        xhr.open('POST', 'delete.php', true);
                        xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                // Remove the message from the DOM
                                button.parentElement.parentElement.remove();
                            }
                        };
                        xhr.send(formData);
                    });
                }
            };
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', (e) => {
                    const userId = e.target.dataset.userId;

                    fetch('delete-user.php', {
                            method: 'POST',
                            body: new URLSearchParams({
                                'user_id': userId
                            }),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        })
                        .then(response => response.text())
                        .then(data => alert(data))
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                });
            });
        </script>
    </div>
</div>