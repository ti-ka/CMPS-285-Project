<?php 


session_start();

if(isset($_SESSION["access"]) && $_SESSION["access"] == true){
    // Redirect to index
    header("Location:index.php");
    exit();
}

require_once("../class/Connection.php");
$c = new Connection();
$link = $c->link;


if(isset($_POST["user"]) && isset($_POST["pass"])){
  $username = mysqli_real_escape_string($link, $_POST["user"]);
  $password = sha1(mysqli_real_escape_string($link, $_POST["pass"]));
  
  $query = "SELECT `username`,`namespace` FROM `users` WHERE `username` = '{$username}' AND `password` = '{$password}'";
  $result = mysqli_query($link, $query);  
  if(mysqli_num_rows($result) == 1){
      $fetch = mysqli_fetch_assoc($result);
      $_SESSION["access"] = true;
      $_SESSION["username"] = $fetch["username"];
      $_SESSION["namespace"] = $fetch["namespace"];
      if(isset($_SESSION["redirect"])){
          header("Location:".$_SESSION["redirect"]);
      } else {
          header("Location:index.php");
      }

  } else {
    $_SESSION["message"] = "Login Unauthorised!";
  }

}
?>
<html>
<head>
    <link rel="stylesheet" href="akiWC/css/login.css">
</head>

<body>

<header>
    <div class="left-side">
        <a href="http://akitech.org/p/cms">Biz Content Mgmt. Console</a>
    </div>
    <div class="right-side">
        <a href="http://akitech.org/p/cms">Find more ></a>
    </div>
</header>

<div id="login">
    <h3>Sign In to<br />Biz Mgmt.</h3>
    <h5 id="message">
        <?php
            if(isset($_SESSION["message"])){
                echo $_SESSION["message"];
                unset($_SESSION["message"]);
            }

        ?>
    </h5>
    <form autocomplete="off" method="POST">
        <input type="text" name="user" id="user" placeholder="Username" spellcheck="false"/>
        <input type="password" name="pass" id="pass" placeholder="Password" spellcheck="false"/>
        <input type="checkbox" id="remember"> Remember me </input>
        <input type="submit" name="login" id="login-btn" placeholder="" value="&#8674;" onclick="check(event)"/>

    </form>
</div>

<footer>
    <div class="left-side">
        <a href="#"><img src="akiWC/images/akitech-white.png" height="30" alt="ARD"/></a>
    </div>
    <div class="right-side">
        <a href="#">Forgot Password?</a> &nbsp; &nbsp;
        <a href="http://akitech.org">&copy; Akitech, 2015</a>
    </div>

</footer>

</body>

<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
<script src="akiWC/js/login.js"></script>


</html>