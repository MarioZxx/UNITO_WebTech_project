<?php include "top.html"; ?>

<div>
	<form action="./signup-submit.php" method="post">
    <fieldset>
      <legend>New User Signup:</legend>
      <label class="left"><strong>Name:</strong></label>
      <input type="text" name="name" size="15">
      <br><br>

      <label class="left"><strong>Gender:</strong></label>
      <label><input type="radio" name="gender" value="M">Male</label>
      <label><input type="radio" name="gender" checked="checked" value="F">Female</label>
      <br><br>

      <label class="left"><strong>Age:</strong></label>
      <input type="text" name="age" size="6" maxlength="2">
      <br><br>

      <label class="left"><strong>Personality type:</strong></label>
      <input type="text" name="persType" size="6" maxlength="4">
      (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know you type?</a>)
      <br><br>

      <label class="left"><strong>Favorite OS:</strong></label>
      <select name="system">
        <option value="Windows">Windows</option>
        <option value="Mac OS X">Mac OS X</option>
        <option value="linux" selected="selected">Linux</option>
      </select>
      <br><br>

      <label class="left"><strong>Seeking age:</strong></label>
      <input type="text" name="seekMinAge" size="6" maxlength="2" placeholder="min"> to 
      <input type="text" name="seekMaxAge" size="6" maxlength="2" placeholder="max">
      <br><br>

      <label class="left"><strong>Seeking gender:</strong></label>
      <select name="seekGender">
        <option value="M">male</option>
        <option value="F">female</option>
        <option value="both" selected="selected">both</option>
      </select>
      <br><br>
      
      <input type="submit" value="Sign up">
    </fieldset>
  </form>
</div>

<?php include "bottom.html"; ?>