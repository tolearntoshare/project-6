<?php
?>
<div class="navbar navbar-default navbar-fixed-top " role="navigation">
    <div class="container">
 
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand " href="index.page.php">login system</a>
        </div>
        
         <!--.nav-collapse -->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
 
                <!-- highlight if $page_title has 'Products' word. -->
     <?php           
     if(isset($_SESSION['username'])){
         
        echo "<li><a href='index.page.php'>Home</a></li>";
        echo "<li class=''> <a href='activation.page.php'>activation</a></li>";
            
        echo "<li><a href='logout.page.php'>Logout</a></li> ";   
            
            
     }
     else{
    // <?php echo strpos($page_title, "LogIn")!==false ? "class='active'" : "";
     //  <?php echo $page_title=="Home Page" ? "class='active'" : ""; 
              
          // echo $page_title=="Home Page" ? "class='active'" : ""; 
     echo " <li><a href='index.page.php'>Home</a></li>";
     echo " <li><a href='login.page.php'>login</a></li>";
     echo " <li><a href='registration.page.php'>registration</a></li>";

     
     }
       ?>
           
                   
         
                
                
            </ul>
       
            
            
        </div>
        <!--.nav-collapse -->
        
        
    </div>
</div>