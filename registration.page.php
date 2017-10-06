<?php

// Session start
// Required files
// classe objects
// registration form include
// check username
// check password coplexity 
// check password match
session_start();

//---------- db include section ------------------------------

require './config/initializing.core.php';

//---------- db objects ----------------------------------------
$dbobj = new db();
$dbconn = $dbobj->getConnection();
$user = new user($dbconn);
$validation = new validationAndSanitize();




$page_title = 'Register a New User';
include './templates/navigation.template.php';

require_once './templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    list($inputs, $errors, $notes) = $validation->registrationFormValidationAndSanitization();
    //var_dump($errors);
    if (!empty($errors)) {
        //print_r($errors);
        foreach ($errors as $key => $value) {
            // echo errors
            if ($key === 'passwordRequirments') {

                echo "<div class='alert alert-warning alert-dismissible  col-md-6 col-md-offset-3 '>"
                 . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
                
                . "Password Errors :<ul>";

                foreach ($notes as $notekey => $notevalue) {
                    // echo errors
                    echo "<li>{$notevalue}</li>";
                }

                echo "</ul></div>";
            } else {
                echo ""
                . "<div class='alert alert-danger alert-dismissible  col-md-6 col-md-offset-3' role='alert'>"
                . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
                . " $value"
                . " </div>";

            }
        }
    } else {
        // register user procedure
        $isUserNameExists = $user->isUserNameExists($inputs['username']);

        if ($isUserNameExists) {
            // var_dump($isUserNameExists);
            // done user registerd redirect him to dashboard
            echo "<div class='alert alert-danger'>UserName(email) is Not avilable,Choose another one! </div>";
        } else {
            // not ok to register new user
            if ($user->creatNewUser($inputs)) {
                // redirect to dashbaord  page

                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->username;
                // send activation email after succful registration
                if ($user->sendActivationEmail($user->username)) {
                    echo "Email is ok";
                    // now redirect
                    header('location:dashboard.page.php');
                } else {
                    header('location:dashboard.page.php');
                }
            } else {
                echo "Cant register you now";
            }
        }
    }
}









require_once './templates/registration.template.php';




require_once './templates/footer.php';
