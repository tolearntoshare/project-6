<?php

include './config/initializing.core.php';
//---------- db objects ----------------------------------------
$dbobj = new db();
$dbconn = $dbobj->getConnection();
$user = new user($dbconn);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    if (isset($_GET['x']) && isset($_GET['y'])) {
        // sanitize must be in class 
        $username = htmlentities(strip_tags($_GET['x']));
        $token = htmlentities(strip_tags(trim($_GET['y'])));


        echo "TOKEN FROM VERYIFYACTIVATION token::::::::  {{$token}}  {{$_GET['y']}} <br>";




        if (!($user->isUserNameExists($username))) {
            // user name is not exixts
            echo "<div class='alert alert-info'> You are Not Registerd !"
            . "<a href='registration.page.php'> Registration page </a></div>";
        } else {

            if ($user->isUserNameExists($username) && $user->isUserActiveByUserName($username)) {
                // user already active r
                echo "<div class='alert alert-info'> You are already activated !"
                . "<a href='login.page.php'> LogIn page </a></div>";
            } else {
                //Activation process
                if ($user->activationByUserName($username, $token)) {
                    //  username match token

                    echo "THANK you now you are activated!";

                    // set active in DB
                    if ($user->setUserToBeActiveByUserName($username)) {
                        echo "user is acitivated thank you now";
                    } else {
                        echo "Cant set user to be acitivated";
                    }
                } else {

                    echo "Sorry we cant activate you!";
                }
            }
        }
    } else {
        // NO $_GET['username']) ||  isset($_GET['token']
        header('location:login.page.php');
    }
} else {
    // post method
    var_dump($_SERVER['REQUEST_METHOD']);
    header('location:login.page.php');
}