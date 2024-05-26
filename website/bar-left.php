<link href="css/inloggen.css" rel="stylesheet">
<div class="bar-left center-content">
    <link href="css/bar-left.css" rel="stylesheet">
    <div class="flex flex-column center-content">
        <div class="current-user"><img src="img/user.svg"  class="my-profile-preview">
            <div class="center-content">
                <h3><?php if (isset($_SESSION['displayname'])) {
                                            echo $_SESSION['displayname'];
                                        } else {
                                            echo "Guest";
                                        } // session is already started in the header
                                        ?></h3>
                <h4 class="rm-text-deco remove-padding-and-margin username"><?php if (isset($_SESSION['username'])) {
                                                                        echo "@" . $_SESSION['username'];
                                                                    } else {
                                                                        echo "Guest";
                                                                    } ?></h4>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="flex flex-row center-content newest-users-per">
        <button onclick="openModal('change-username')"  id="change-username" class="updateprofo">Change Username</button>
        <div id=change-username-modal class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('change-username')">&times;</span>
                <form class="container" action="change-username.php" method="post">
                    <h1>Change Username</h1>
                    <label for="nu"><b>New Username</b></label>
                    <input type="text" placeholder="New Username" name="nu" required>
                    <label for="psw"><b>Enter Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required pattern=".{6,120}"><br>
                    <button class="cunbtn" type="submit">Change Username</button>
                </form>
            </div>
        </div>

    </div>
    <div class="flex flex-row center-content newest-users-per">
        <button onclick="openModal ('change-displayname')"  id="change-displayname" class="updateprofo">Change DisplayName</button>
        <div id="change-displayname-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('change-displayname')">&times;</span>
                <form class="container" action="change-displayname.php" method="post" >
                    <h1>Change DisplayName</h1>
                    <label for="nd"><b>New Displayname</b></label>
                    <input type="text" placeholder="Enter Displayname" name="nd" required>
                    <label for="psw"><b>Enter Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required pattern=".{6,120}"><br>
                    <button class="cunbtn" type="submit">Change DisplayName</button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex flex-row center-content newest-users-per">
        <button onclick="openModal ('change-email')"  id="change-email" class="updateprofo">Change Email</button>
        <div id="change-email-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('change-email')">&times;</span>
                <form class="container" action="change-email.php" method="post"  >
                    <h1>Change Email</h1>
                    <label for="ne"><b>New Email</b></label>
                    <input type="text" placeholder="Enter Email" name="ne" required>
                    <label for="psw"><b>Enter Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required pattern=".{6,120}"><br>
                    <button class="cunbtn" type="submit">Change Email</button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex flex-row center-content newest-users-per">
        <button onclick="openModal ('change-password')"  id="change-password" class="updateprofo">Change Password</button>
        <div id="change-password-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('change-password')">&times;</span>
                <form class="container" action="change-password.php" method="post">
                    <h1>Change Password</h1>
                    <label for="op"><b>Old Password</b></label>
                    <input type="password" placeholder="Old password" name="op" required ><br>
                    
                    <label for="np"><b>New Password</b></label>
                    <input type="password" placeholder="New password" name="np" required pattern= ".{6,120}"><br>

                    <label for="cnp"><b>Confirm New Password</b></label>
                    <input type="password" placeholder="Confirm New Password" name="cnp" required pattern=".{6,120}"><br>
                    <button class="cunbtn" type="submit">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex flex-row center-content newest-users-per">
        <button onclick="openModal ('delete-account')"  id="delete-account" class="updateprofo">Delete Account </button>
        <div id="delete-account-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('delete-account')">&times;</span>
                <form class="container" action= "delete-account.php"method="post">
                    <h1>Delete Account</h1>
                    <label for="psw"><b>Enter Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required pattern=".{6,120}"><br>
                    <button class="cunbtn" type="submit">Delete Account</button>
                </form>
            </div>
        </div>        

    </div>
    <?php } else { ?>
        <div>
            <button  class="joinusnow" onclick="window.location.href = 'inloggen.php';"  >Join us now!</button>
        </div>
    <?php } ?>
</div>
</div>
<script src="Script.js"></script>