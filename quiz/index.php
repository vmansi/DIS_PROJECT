<?php
session_start();
?>
<!DOCTYPE >
<html>
<head>
<title>Welcome to Online Exam</title>
<link href="quiz.css" rel="stylesheet"  type="text/css">
</head>

<body>
<script>


  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '348307672203976',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
      document.getElementById('status').innerHTML = '<a href="showtest.php">'+'You are now logged in to the quiz. Click here to start quiz '+'</a>';
    });
  }

</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>




<?php
include("header.php");
include("database.php");
extract($_POST);
extract($_SESSION);
if (isset($_SESSION[qn])){
	unset($_SESSION[qn]);
}
if (isset($_SESSION[cnt])){
	unset($_SESSION[cnt]);
}
if(isset($submit))
{
	$rs=mysql_query("select * from mst_user where login='$loginid' and pass='$pass'");
	if(mysql_num_rows($rs)<1)
	{
		$found="N";
	}
	else
	{
		$_SESSION[login]=$loginid;
	}
}
if (isset($_SESSION[login]))
{
echo "<h1 class='style8' align=center>Welcome to Online Exam</h1>";
		echo '<table width="28%"  border="0" align="center">
<br><br>
  <tr>
    <td width="7%" height="65" valign="bottom"><img src="image/HLPBUTT2.JPG" width="100" height="100" align="middle"></td>
    <td width="93%" valign="bottom" bordercolor="#0000FF"> <a href=showtest.php?subid=1 class="style4"><h1>Take Quiz </a></td>
  </tr>
  <tr>
    <td height="58" valign="bottom"><img src="image/DEGREE.JPG" width="100" height="100" align="absmiddle"></td>
    <td valign="bottom"> <a href=showtest2.php?subid=2 class="style4"><h1>Result </a></td>
  </tr>
  <tr>
    <td height="58" valign="bottom"><img src="image/facts.jpg" width="100" height="100" align="absmiddle"></td>
    <td valign="bottom"> <a href="facts.php" class="style4"><h1>Olympics Facts </a></td>
  </tr>
</table>';
   
		exit;
		

}


?>

<table width="100%" border="0">
  <tr>
    <td width="70%" height="25">&nbsp;</td>
    <td width="1%" rowspan="2" bgcolor="#CC3300"><span class="style6"></span></td>
    <td width="29%" bgcolor="#CC3333"><div align="center" class="style1"><p class="style5">     </p><H1>   User Login </div></td>
  </tr>
  <tr>
    <td height="296" valign="top"><div align="center">
        <h1 class="style8">Welcome to Online Quiz</h1>
      <span class="style5"><img src="image/paathshala.png" width="239" height="150"><span class="style7"><img src="image/HLPBUTT2.JPG" width="100" height="100"><img src="image/BOOKPG.PNG" width="100" height="100"></span>        </span>
        <param name="movie" value="english theams two brothers.dat">
        <param name="quality" value="high">
        <param name="movie" value="Drag to a file to choose it.">
        <param name="quality" value="high">
        <param name="BGCOLOR" value="#FFFFFF">
<p align="left" class="style5">&nbsp;</p>
      <blockquote>
         <h2> <p align="left" class="style5"><span class="style7">Welcome to Online 
            exam. This Site will provide the exam for various subject of interest. 
            You need to login for taking any online exam.</span></p>
      </h2></blockquote>
    
</div></td>
    <td valign="top"><form name="form1" method="post" action="">
      <table width="200" border="0">
        <tr>
          <td><span class="style2"><h3>Login ID </span></td>
          <td><input name="loginid" type="text" id="loginid2"></td>
        </tr>
        <tr>
          <td><span class="style2">Password</span></td>
          <td><input name="pass" type="password" id="pass2"></td>
        </tr>
        <tr>
          <td colspan="2"><span class="errors">
            <?php
		  if(isset($found))
		  {
		  	echo "Invalid Username or Password";
		  }
		  ?>
          </span></td>
          </tr>
        <tr>
          <td colspan=2 align=center class="errors">
		  <input name="submit" type="submit" id="submit" value="Login">		  </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#CC3300"><div align="center"><span class="style4">New   ? <a href="signup.php">Signup Free</a></span></div></td>
          </tr>
      </table>
      <div align="center">
<p class="style5"><img src="images/download.png" width="134" height="128">          </p>        
<p class="style5"><img src="images/topleft.jpg" width="134" height="128">          </p>

        </div>
    </form></td>
  </tr>
</table>

</body>
</html>
