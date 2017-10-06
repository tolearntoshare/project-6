<?php
/*
 * This page will contain all the files
 * i wnat to be in ANY PAGE in my app
 * so i put all of them here and include this
 * once in any page and the rest will follow
 */

/* OLD SCHOOL TO INCLUDE EACH ONE OF THESE CLASSES
 * THE new one will be user SPL_AUTO_LOAD()
 */


/*
require_once './classes/db.class.php';
require_once './classes/db.class.php';
require_once './classes/db.class.php';
require_once './classes/db.class.php';

*/

// new include school this will be cllaed
// each time $obj= new db();

spl_autoload_register(function($class){
     require_once './classes/'.$class.'.class.php';
});

$GLOBAL['config'] = array(
    
    'mysql' => array(
              'host' => '127.0.0.1',
               'dbname' => 'loginsystem',
               'username' => 'root',
               'password' => ''),
    
    
    'remember' => array(
                'cookieName'=>'hash',
                'cookieExpire' =>60800),
    
    'session' => array(
                'SessionName'=>'user' ),
       
    
);
