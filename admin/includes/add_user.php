<?php
if(isset($_POST['create_user'])){
//    $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    
//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//    $post_date = date('d-m-y');

    
    
//    move_uploaded_file($post_image_temp,"../images/$post_image");
$query = "SELECT randSalt From users ";
$select_randsalt_query = mysqli_query($connection, $query);
if(!$select_randsalt_query){
    die("Query Failed" . mysqli_error($connection));
}
$row = mysqli_fetch_array($select_randsalt_query);
$salt = $row['randSalt'];
$hashed_password = crypt($user_password, $salt); 

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}',
    '{$user_email}','{$hashed_password}') ";
    
    $create_user_query = mysqli_query($connection,$query);
    
    confirmQuery($create_user_query);
    
    echo "User Created: " . "<a href ='users.php'>View Users</a>";
}
?>
   

   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
<!--
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image">
    </div>
-->
    <div class="form-group">
        <label for="post_category">Role </label>
        <select name="user_role" id="">
            <option value="subscriber">Select-Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
        
<!--        <input type="text" class="form-control" name="post_category_id">-->
<!--
       <select name="user_role" id="">
            <?php
                $query = "SELECT * FROM users ";
                $select_users = mysqli_query($connection,$query);
                confirmQuery($select_users);
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['user_id'];
                    $user_role = $row['user_role'];
                    echo "<option value='$user_id'>{$user_role}</option>";
                    
                }
            ?>
        </select>
-->
    </div>
    
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>