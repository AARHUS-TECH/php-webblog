
<?php

// GET post data from redirection
  if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    //$post_category_id = '';


    $sql = "SELECT post_date, post_date_created, post_date_updated, post_category_id, post_content FROM posts WHERE post_id = {$post_id} ";
    $get_post_data_q = $conn->query($sql);

    if(confirmQuery($get_post_data_q)){
      $row = $get_post_data_q->fetch_assoc();
      $post_date = $row['post_date'];
      $post_date_created = $row['post_date_created'];
      $post_date_updated = $row['post_date_updated'];
      $post_category_id = $row['post_category_id'];
      $post_content = $row['post_content'];
    }

    // Check if edit button has been submitted.
    if(isset($_GET['changes'])){
      $confirmation_alert = "Post was successfully edited: " . " " . "<a href='index.php?source=manage'>View all posts</a>";
    } else {
      $confirmation_alert = '';
    }
  } else {
  $confirmation_alert = '';
  $post_date_created = '';
  }


 // EDIT post
 if(isset($_POST['edit_post'])){

   $post_date = $_POST['post_date'];
   $post_category_id = $_POST['post_category_id'];

   $post_content = $_POST['post_content'];
   $post_content = mysqli_real_escape_string($conn, $post_content);

   $sql = "UPDATE posts SET ";
   $sql .= "post_date = '{$post_date}', ";
   $sql .= "post_category_id = '{$post_category_id}', ";
   $sql .= "post_content = '{$post_content}' ";
   //no komma before WHERE
   $sql .= "WHERE post_id = {$post_id} ";

   $edit_post_q = $conn->query($sql);

   if(confirmQuery($edit_post_q)){
     header("Location: index.php?source=edit&post_id={$post_id}&changes=true");
   }
}


  ?>


 <form class="" action="" method="post" enctype="multipart/form-data">

   <div class="container-create">
     <h1><?php
     if(isset($_GET['post_id'])) {
       echo 'Edit page';
     } else {
       echo 'No post has been selected';
     }
      ?></h1>

     <hr>

     <div class="form-group">
       <label for="">Time of creation: <?php echo $post_date_created; ?></label>
     </div>

     <div class="form-group">
       <label for="">Date</label>
       <input class="form-control" type="date" name="post_date" value=<?php echo $post_date; ?>>
     </div>

     <div class="form-group">
       <label for="">Category</label>
       <select class="form-control theme-container" name="post_category_id" required>

         <?php


         // Populate dropdown menu with the stored category first.
         $sql = "SELECT cat_id, cat_name FROM categories WHERE cat_id = {$post_category_id} "; //evt. tilføj LIMIT 3 for kun at få 3 inputs
         $get_categories_q = $conn->query($sql);

         if(confirmQuery($get_categories_q)){
           while($row = $get_categories_q->fetch_assoc()){
             $cat_id = $row['cat_id'];
             $cat_name = $row['cat_name'];
             echo "<option value='{$cat_id}'>{$cat_name}</option>";
           }
         }

         //Populate the dropdown menu with the rest of the categories in order.
         $sql = "SELECT cat_id, cat_name FROM categories ORDER BY cat_name ASC";
         $get_categories_q = $conn->query($sql);

         if(confirmQuery($get_categories_q)){
           while($row = $get_categories_q->fetch_assoc()){
             $cat_id = $row['cat_id'];
             $cat_name = $row['cat_name'];
             if ($cat_id != $post_category_id){
               echo "<option value='{$cat_id}'>{$cat_name}</option>";
             }
           }
         }

          ?>
       </select>
     </div>

     <div class="form-group">
     <label for="" >Blog content</label>
     <textarea class="form-control" name="post_content" rows="8" cols="8" required><?php echo $post_content; ?></textarea>
     </div>

     <div class="form-group align-right">
       <button class="btn btn-primary" type="submit" name="edit_post">Edit</button>
     </div>

     <div class="">
       <p><?php echo $confirmation_alert; ?></p>
     </div>

   </div>

 </form>
