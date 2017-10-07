<!DOCTYPE html>
<?php

if (!function_exists("gettext")) {
    //echo "gettext is not installed \n";
} else {
    ///echo ("gettext is supported ");
    //echo "<br>";
}

if (isset($_GET['lang']) ) {
    if( $_GET['lang']=='ar_JO'){
        echo "arabic";
        $language = 'ar_JO'; 
        include 'bodystart.arabic.template.php';
    }
    else{
        $language = $_GET['lang']; 
    }
   
} else {
    $language = 'en_US';
}
echo ""
        . "<a href='?lang=en_US'>EN</a> |"
        . "<a href='?lang=ar_JO'>AR</a> |"
        . "<a href='?lang=nl_NL'>NL</a> |";


$locale = $language;
$domain = 'msg';
$codeset = 'UTF-8';
$directory = __DIR__ . '/locale';

putenv('LC_ALL=' . $locale);
setlocale(LC_ALL, $locale);
putenv('LANGUAGE=en_US');

// Debugging output 
echo "<br>";echo "<br>";
$file = sprintf('%s/%s/LC_MESSAGES/%s_%s.mo', $directory, $locale, $domain, $locale);
echo $file . "\n";
echo "<br>";echo "<br>";

$textDomain = sprintf('%s_%s', $domain, $locale);
bindtextdomain($textDomain, $directory);
bind_textdomain_codeset($textDomain, $codeset);
textdomain($textDomain);

// test translations
echo "<div>";
echo _("ayman");
echo "<br>";
echo _("xayman");
echo "<br>";
echo _("Xalqudah");
echo "<br>";
echo _("ALLAH AKBAR");
echo "<br>";
echo _("This is me to be translater again and again");
echo "<br>";
echo _("this item in your cart already !");
echo "</div>";

include 'bodyend.arabic.template.php';