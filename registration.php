<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php 
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)){
        $username = mysqli_real_escape_string($connection, $username);
        $firstname  = mysqli_real_escape_string($connection, $firstname );
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        // $query = "SELECT randSalt From users ";
        $query = "SELECT randSalt From users ";
        $select_randsalt_query = mysqli_query($connection, $query);

        if(!$select_randsalt_query){
            die("Query Failed" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_randsalt_query)) {
              $salt = $row['randSalt'];
         
        }
        
        $password= crypt($password, $salt);
        // $password = md5($password);
        
        $query = "INSERT INTO users (username, user_email, user_password, user_firstname, user_lastname, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', '{$firstname}', '{$lastname}', 'subscriber')";
        
        $registration_user_query = mysqli_query($connection, $query);

        if(!$registration_user_query){
            die("QUERY FAILED" . mysqli_error($connection) );
       
        }
        $message = "Your Registration has been submitted";
    }else{
        $message = "Field can't be empty.";
    }





} else {
    $message = "";
}
?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6><?php echo $message;?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Desired Fisrtname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Desired Lastname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
