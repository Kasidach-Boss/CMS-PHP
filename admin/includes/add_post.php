<?php
if(isset($_POST['create_post'])){
    $post_title = htmlspecialchars($_POST['title']);
    $post_author = htmlspecialchars($_POST['author']);
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags =htmlspecialchars( $_POST['post_tags']);
    // $post_content = $_POST['post_content'];
    $post_content = $_POST['post_content'];
    $post_content = addcslashes($post_content);
    $post_date = date('d-m-y');

    // $post_title = mysqli_real_escape_string($connection,$post_title);
    // $post_author = mysqli_real_escape_string($connection,$post_author);
    // $post_tags = mysqli_real_escape_string($connection,$post_tags);
    // $post_content = mysqli_real_escape_string($connection,$post_content);
    
    
    
    move_uploaded_file($post_image_temp,"../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image, post_content,post_tags,post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}',
    '{$post_tags}','{$post_status}') ";
    
    $create_post_query = mysqli_query($connection,$query);
    
    confirmQuery($create_post_query);

    $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='./posts.php'>Edit More Posts</a></p>";
}
?>
   

   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category </label>
<!--        <input type="text" class="form-control" name="post_category_id">-->
       <select name="post_category" id="post_category">
            <?php
                $query = "SELECT * FROM categories ";
                $select_categories = mysqli_query($connection,$query);
                confirmQuery($select_categories);
                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                    
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
            <option value="draft">Select Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div> -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea name="post_content" id="summernote" cols="30" rows="10"  class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>