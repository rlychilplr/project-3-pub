<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/inloggen.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- <a href="index.php">Home</a> -->
    <div class="flex-container">
        <div><img src="img/new-logo.png" id="logo"></div>
        <div id="frame">
            <h1 id="chans">CHANS </h1>
            <h1 id="join">JOIN NOW.</h1>
            <h1 id="already">Already have an account?</h1>
            <button onclick="openModal('sign-up')" style="width:auto;" id="sign-up-btn">Sign Up</button>
            <button onclick="openModal('log-in')" style="width:auto;" id="log-in-btn">Log In</button>
            <button onclick="window.location.href = 'index.php'" style="width:auto;" id="back-home">Back to Home</button>

            <div id="sign-up-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('sign-up')">&times;</span>
                    <form class="container" method="POST" action="register.php">
                        <h1>Sign Up</h1>
                        <p>Please fill in this form to create an account.</p>
                        <hr>
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required><br>

                        <label for="displayname"><b>Display name</b></label>
                        <input type="text" placeholder="Enter Display name" name="displayname" required><br>

                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required><br>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required pattern=".{6,120}"><br><!-- this gets filterd by php so no need to filter here -->

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" required pattern=".{6,120}">


                        <div class="clearfix">
                            <button type="button" onclick="closeModal('sign-up')" class="cancelbtn">Cancel</button>
                            <button type="submit" class="signupbtn">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="log-in-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('log-in')">&times;</span>
                    <form class="container" action="login.php" method="post">
                        <form class="container">
                            <h1>Log In</h1>
                            <label for="uname"><b>Username</b></label>
                            <input type="text" placeholder="Enter Username" name="uname" required><br>

                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required><br>

                            <div class="clearfix">
                                <button type="button" onclick="closeModal('log-in')" class="cancelbtn">Cancel</button>
                            </div>
                            <button class="loginbtn" type="submit">Login</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- back to home button -->
    <script src="Script.js"></script>

</body>

</html>