<?php
// this file contains all the files i need to have
// in my Each page 
session_start();
if(!isset($_SESSION['counter'])){
   
    $_SESSION['counter']=1;
   
}
else{
    $counter=0;
    $_SESSION['counter'] +=1;

}



//---------- db include section ------------------------------

require './config/initializing.core.php';


//---------- db objects ----------------------------------------


//---------- html template include section --------------------

$page_title = 'Home Page ';
include './templates/navigation.template.php';

include_once './templates/header.php';


//---------- Logic  section -------------------------------


echo "<div class='alert alert-warning'> you have visite us {$_SESSION['counter']} </div>";







//---------- html Footer template include section --------------------
include_once './templates/footer.php';

