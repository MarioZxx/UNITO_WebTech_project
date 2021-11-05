<?php include "top.html"; ?>

<div>
	<form action="./signup-submit.php" method="post">
    <fieldset>
      <legend>New User Signup:</legend>

      <label class="row">
        <strong>Name:</strong>
        <input type="text" name="name" size="15">
      </label>

      <label class="row">
        <strong>Gender:</strong>
        <label><input type="radio" name="gender" value="M">Male</label>
        <label><input type="radio" name="gender" checked="checked" value="F">Female</label>
      </label>

      <label class="row">
        <strong>Age:</strong>
        <input type="text" name="age" size="6" maxlength="2">
      </label>

      <label class="row">
        <strong>Personality type:</strong>
        <input type="text" name="persType" size="6" maxlength="4">
        (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know you type?</a>)
      </label>

      <label class="row">
        <strong>Favorite OS:</strong>
        <select name="system">
          <option value="Windows">Windows</option>
          <option value="Mac OS X">Mac OS X</option>
          <option value="linux" selected="selected">Linux</option>
        </select>
      </label>

      <label class="row">
        <strong>Seeking age:</strong>
        <input type="text" name="seekMinAge" size="6" maxlength="2" placeholder="min"> to 
        <input type="text" name="seekMaxAge" size="6" maxlength="2" placeholder="max">
      </label>

      <label class="row">
        <strong>Seeking gender:</strong>
        <select name="seekGender">
          <option value="M">male</option>
          <option value="F">female</option>
          <option value="both" selected="selected">both</option>
        </select>
      </label>
      
      <input type="submit" value="Sign up">
    </fieldset>
  </form>
</div>

<?php include "bottom.html"; ?>