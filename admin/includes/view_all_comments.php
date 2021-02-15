<table class="table table-bordered tabe-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Reject</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
                        
            $select_comments = selectQuery('comments');
        
            while($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = escape($row['comment_id']);
                $comment_post_id = escape($row['comment_post_id']);
                $comment_author = escape($row['comment_post_author']);
                $comment_content = escape($row['comment_post_content']);
                $comment_email = escape($row['comment_post_email']);
                $comment_status = escape($row['comment_post_status']);
                $comment_date = escape($row['comment_post_date']);
                
                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";

                // $query = "SELECT * FROM comments WHERE cat_id = {$post_category_id}";
                // $select_categories_id = mysqli_query($connection, $query);

                // while($row = mysqli_fetch_assoc($select_categories_id)) {
                //     $cat_id = escape($row['cat_id']);
                //     $cat_title = escape($row['cat_title']);
                    
                //     echo "<td>{$cat_title}</td>";
                // }

                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";

                $select_post_id_query = selectStatusQuery('posts', 'post_id', $comment_post_id);
                while($row = mysqli_fetch_assoc($select_post_id_query)) {
                    $post_id = escape($row['post_id']);
                    $post_title = escape($row['post_title']);

                    echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                }           
            
                echo "<td>{$comment_date}</td>";
                echo "<td><a class='btn btn-success' href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a class='btn btn-danger' href='comments.php?reject=$comment_id'>Reject</a></td>";
                echo "<td><a class='btn btn-danger' href='comments.php?delete=$comment_id'>Delete</a></td>";
                echo "</tr>";
        
            }
            
        ?>

    </tbody>
</table>

<?php 

   approveComment();
   rejectComment();
   deleteComment();

?>