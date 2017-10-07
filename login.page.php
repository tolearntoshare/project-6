<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    // header('location:index.page.php');
}


//---------- db include section ------------------------------

require './config/initializing.core.php';


//---------- db objects ----------------------------------------
$dbobj = new db();
$dbconn = $dbobj->getConnection();
$user = new user($dbconn);
$validation = new validationAndSanitize();


//---------- html template include section --------------------

$page_title = 'LogIn';
include './templates/navigation.template.php';

include_once './templates/header.php';


//---------- Logic  section -------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check user inputs
    // list($erros,$inputs)= validation->checkPost($_POST);
    // strat login process
    // 1- sanitize inputs NMUST BE IN CLASS
    // 2- check to allow user to login 
    // 3- redirect to correct place

    list($inputs, $errors) = $validation->loginFormValidationAndSanitized();

    if ($errors) {
        // for each errors display it

        foreach ($errors as $key => $value) {

            echo 
                 "<div class='alert alert-danger alert-dismissible  col-md-6 col-md-offset-3' role='alert'>"
                 . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
                 . " {$value} "
                 . " </div>";
        }
    } else {

        // No errors 
        $isok = $user->isUserValideTologin($inputs);


        if ($isok) {
            // SET SESSION and redirect to dashboard 

            $_SESSION['username'] = $user->username;
                        
            
            // if user active forward else redirect to activate
            if ($user->isUserActiveByUserName($_SESSION['username'])) {
                 $_SESSION['active'] = $user->active;
                header('location:dashboard.page.php');
            } else {
                 $_SESSION['email'] = $user->username;
                 header('location:activation.page.php');
            }



           
        } else {

            //  we have error  user name or passwrod
            //   not correct ! check 
            echo "<div class='alert alert-danger'> user name or password is Not correct ! </div>";
        }
    }
}

//echo "<div class='alert alert-warning'> you have visite us {$_SESSION['counter']} </div>";

include_once './templates/loginForm.template.php';





//---------- html Footer template include section --------------------
include_once './templates/footer.php';

