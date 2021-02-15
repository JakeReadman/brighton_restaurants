<?php

    if(isset($_POST['create_post'])) {
        $post_title = escape($_POST['title']);
        $post_user = escape($_POST['post_user']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../img/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
             
      $create_post_query = mysqli_query($connection, $query);  
          
      confirmQuery($create_post_query);

      $current_post_id = mysqli_insert_id($connection);


      echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$current_post_id}'>View Post </a> or <a href='posts.php'>View Post Dashboard</a></p>";
    }

?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" name="post_category" id="">
            <option value="">Select Category</option>

            <?php 
        
            $select_categories = selectQuery('categories');
            
            while($row = mysqli_fetch_assoc($select_categories )) {
            $cat_id = escape($row['cat_id']);
            $cat_title = escape($row['cat_title']);
                    
                echo "<option value='$cat_id'>{$cat_title}</option>";
                   
            }
        
        ?>



        </select>

    </div>


    <div class="form-group">
        <label for="users">Users</label>
        <select class="form-control" name="post_user" id="">
            <option value="">Select User</option>
            <?php 
        
                $select_users = selectQuery('users');
                
                while($row = mysqli_fetch_assoc($select_users )) {
                $user_id = escape($row['user_id']);
                $username = escape($row['username']);
                $user_firstname = escape($row['user_firstname']);
                $user_lastname = escape($row['user_lastname']);
                    
                    echo "<option value='$username'>{$username}</option>";
                    
                }
            
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body">
         </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>


</form>