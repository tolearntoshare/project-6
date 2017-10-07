<?php
?>



    <div class="row">
        
        <div class=" col-md-6 col-md-offset-3 well">
           
            <form method="post" action="<?php echo htmlentities(strip_tags($_SERVER['PHP_SELF'])) ?>" role="form">

                <div class="input-group m-b-10px">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>

                    <input class="form-control" value="<?php if(isset($_POST['username'])){echo $_POST['username']; }?>" type="text" name="username" placeholder="User Name"> 

                </div>

       
                
                
                   <div class="input-group m-b-10px">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                    <input class="form-control" value="<?php if(isset($_POST['fname'])){echo $_POST['fname']; }?>" type="text" name="fname" placeholder="First Name"> 

                </div>
                   
                
                
                         
                   <div class="input-group m-b-10px">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                    <input class="form-control" value="<?php if(isset($_POST['lname'])){echo $_POST['lname']; }?>" type="text" name="lname" placeholder="Last Name"> 

                </div>
                

                <div class="input-group m-b-10px">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                    <input class="form-control"  type="password" name="password" placeholder="Password"> 

                </div>

                    <div class="input-group m-b-10px">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                    <input class="form-control"  type="password" name="repassword" placeholder="re-password"> 

                </div>
                
                
                <br>

                
                
                <div class="form-group m-b-10px">

                    <button type="submit" class="btn btn-success btn-sm btn-block">Register</button>

                </div>

                

                <div class="form-group">

                    <button type="reset" class="btn btn-default">Reset</button>

                    <a href="login.page.php" class="btn btn-link" > LogIn </a>

                </div>



            </form>



        </div>


    </div>



