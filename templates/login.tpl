<!--<!DOCTYPE html>
<html>
<head></head>
<body>
<link href="/css/w3.css" rel="stylesheet"> -->
<div class="w3-panel w3-container w3-card-4 w3-white" style="max-width: 50%">
<div class="w3-center"><br>
     <!--<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top"> -->
      </div>

      <form class="w3-container" action="/login.php" method="POST">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input type="hidden" name="redirect" value="{{redirect}}" />
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="psw" required>
          <button class="w3-xlarge w3-button w3-block w3-blue-grey w3-section w3-padding" type="submit">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div> 
   </div>
      <!-- </body></html> -->