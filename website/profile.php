<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>
<body>
<?php require "header.php"; ?>  

<div class ="page-layout">


<img src=img/new-logo.png class="centerleft-logo-profile">
<h3 class="username">
  <?php if(isset($_SESSION['displayname'])) {echo $_SESSION['displayname'];} else{ echo "Guest";} // session is already started in the header?></h3>
     <h4 class="rm-text-deco remove-padding-and-margin">
        <?php if(isset($_SESSION['username'])) {echo "@" . $_SESSION['username'];} else{ echo "Guest";} ?></h4>



        <ul class ="middleButton">
  <li class ="follow"><a href= "#button">button</a></li>
  <li class ="follow"><a href= "#button">button</a></li>
  <li class ="follow"><a href= "#button">button</a></li>
  <li class ="follow"><a href= "#button">button</a></li>
</ul>
        
<ul class = "button">
  <li class ="recently rm-text-deco"><a href="#button">button</a></li>
  <li class ="recently rm-text-deco"><a href="#button">button</a></li>
  <li class ="recently rm-text-deco"><a href="#button">button</a></li>
</ul>

<ul class = "rightButton">
<img src=img/new-logo.png class="foto-top-right">
  <li class ="right"><a href="#button">button</a></li>
  <li class ="right"><a href="#button">button</a></li>
  <li class ="right"><a href="#button">button</a></li>
  <li class ="right"><a href="#button">button</a></li>
</ul>

<div class= "profile">
<img src=img/new-logo.png class="middelleft">
<img src=img/new-logo.png class="middelleft">
<img src=img/new-logo.png class="middelleft">
<h2 class= "profileleft"></h2>
</div>

<div class= "profilemiddelleft">
<img src=img/new-logo.png class="middelleft">
<img src=img/new-logo.png class="middelleft">
<img src=img/new-logo.png class="middelleft">
<h2 class= "profileleft"></h2>
</div>

<div class= "profilebottomright">
<img src=img/new-logo.png class="fotoright">
  <ul class = "buttonbottomright">
  <li class ="buttonbottom rm-text-deco"><a href="#button">button</a></li>
  <li class ="buttonbottom rm-text-deco"><a href="#button">button</a></li>
  <li class ="buttonbottom rm-text-deco"><a href="#button">button</a></li>
  <li class ="buttonbottom rm-text-deco"><a href="#button">button</a></li>
</ul>

</div>  
<?php require 'footer.php'; ?>
</div>

</body>
</html>

