<?php
echo "<div class='alert alert-info'>{$_SESSION['username']} You need to activate your acount ! </div> ";
echo "<form method='post' action='activation.page.php' class='col-md-6 well'>";
echo "<div class='input-group'>";
echo "<input type='email' name='email' value='{$_SESSION['email']}' class='form-control' />";
echo "<span class='input-group-btn'>";
echo "<button class='btn btn-default update-quantity' type='submit'>Send Activation Email</button>";
echo "</span>";
echo "</div>";
echo "</form>";