<?php
if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];
    
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
            
            
    }
    
}
if(isset($_POST['edit_user'])){
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

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";
   
    $edit_user_query = mysqli_query($connection,$query);
    confirmQuery($edit_user_query );
    if(!$edit_user_query ){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    
}
?>
   

   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
<!--
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image">
    </div>
-->
    <div class="form-group">
        <label for="user_role">Role </label>
        <select name="user_role" id="" >
            <option value="subscriber"><?php echo $user_role; ?></option>
            <?php
            if($user_role == 'admin'){
                echo "<option value = 'subscriber'>Subcriber</option>";
            }else{
                echo "<option value = 'admin'>Admin</option>";
            }
            ?>
            
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
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>