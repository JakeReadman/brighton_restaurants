<!-- Database Connection -->
<?php include "includes/db.php"; ?>
<!-- Header -->
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            
                $per_page = 5;
                if(isset($_GET['page'])) {
                    
                    $page = escape($_GET['page']);
                } else {
                    $page = '';
                }

                if($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }

                $post_query_count = "SELECT * FROM posts";
                $find_count_query = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count_query);

                $count = ceil($count / $per_page);

                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
                $result = mysqli_query($connection, $query);

                
                while($row = mysqli_fetch_assoc($result)) {
                    $post_id = escape($row['post_id']);
                    $post_title = escape($row['post_title']);
                    $post_author = escape($row['post_user']);
                    $post_date = escape($row['post_date']);
                    $post_image = escape($row['post_image']);
                    $post_content = substr($row['post_content'], 0, 100);
                    $post_status = escape($row['post_status']);
                    
                    if($post_status == 'published') {
                     
                    
            ?>

            <h1 class="page-header">
                <?php  ?>
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a
                    href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="img/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php 
                 } }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
        <!-- /.row -->

        <hr>

        <ul class="pager">
            <?php 
        
        for($i = 1; $i <= $count; $i++) {
                if($i == $page) {
                    echo "<li><a class='active-link page-num' href='index.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li><a class='page-num' href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
            
        ?>

        </ul>

        <?php include "includes/footer.php"; ?>