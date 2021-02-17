<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <i
                            class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="dropdown-menu">

                        <?php 
                    
                        $select_all_categories_query = selectQuery('categories');

                        while($row = mysqli_fetch_assoc($select_all_categories_query)) {
                            $cat_title = escape($row['cat_title']);
                            $cat_id = escape($row['cat_id']);

                            $cat_class = '';
                            $registration_class = '';
                            $contact_class = '';
                            $home_class = '';

                            $pageName = basename($_SERVER['PHP_SELF']);
                            $registration = 'registration.php';
                            
                            if(isset($_GET['category']) && $_GET['category'] == $cat_id) {
                                $cat_class = 'active';
                            } else if($pageName == $registration) {
                                $registration_class = 'active';
                            } else if($pageName == 'contact.php') {
                                $contact_class = 'active';
                            }

                            echo "<li class='$cat_class'> <a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        }
                    
                    ?>
                    </ul>
                </li>
                <li class='<?php echo $contact_class ?>'>
                    <a href="contact.php">Contact</a>
                </li>
                <?php              
                    if(isLoggedIn()) {
                        if(isset($_GET['p_id'])) {
                            $post_id = escape($_GET['p_id']);
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                        }
                    }                
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right top-nav">
                <?php if(!isLoggedIn()) {
                            echo "<li class='$registration_class'></i>
                                <a href='registration.php'>Sign Up</a>
                            </li>";
                        } else {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i>
                        <?php echo $_SESSION['username'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        if(isAdmin()) {
                            echo "<li><a href='admin'>Admin</a></li>";
                            echo "<li class='divider'></li>";
                        }
                        echo "<li><a href='includes/logout.php' name='logout'>Logout</a></li>";
                    }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>