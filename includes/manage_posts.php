<?php

if(isset($_POST['delete'])){

  $post_id = $_POST['post_id'];

  $sql = "DELETE FROM posts WHERE post_id={$post_id}";
  $delete_post_q = $conn->query($sql);

  if(!confirmQuery($delete_post_q)){
    echo "Something went wrong with the query to database.";
  }

}


 ?>


<form class="" action="#" method="post">


<div class="container-manage">
  <div class="manage-header">
    <h1>Post management page</h1>
    <hr>
  </div>

  <div class="manage-create form-group">
    <a class="btn btn-primary" href="?source=create">Create new post</a>
  </div>

  <!-- <div class="manage-multiselect-subgrid form-group">
    <select class="form-control category-selector" name="bulk_options">
      <option value="">Select options</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
    </select>
    <input class="btn btn-success category-button" type="button" name="" value="Apply">
  </div> -->

  <div class="manage-table-subgrid">
    <!-- <div class="manage-checkbox">
      <input type="checkbox" name="" value="">
    </div> -->

    <div class="manage-table-subsubgrid">
      <div class="manage-date padding-left">
        <label for="">Date</label>
      </div>

      <!-- <div class="manage-img">
        <label for="">IMG</label>
      </div> -->

      <div class="manage-category padding-left">
        <label for="">Category</label>
      </div>

      <div class="manage-edit padding-left">
        <label for="">Edit</label>
      </div>

      <div class="manage-delete padding-left">
        <label for="">Delete</label>
      </div>
    </div>

    <?php

      $sql = "SELECT post_date_created, post_category_id, post_id, cat_name FROM posts ";
      $sql .= "JOIN categories ";
      $sql .= "ON posts.post_category_id = categories.cat_id ";
      $sql .= "ORDER BY post_date_created DESC ";
      $get_posts_q = $conn->query($sql);

      if(confirmQuery($get_posts_q)){
        while($row = $get_posts_q->fetch_assoc()){
          $post_date_created = $row['post_date_created'];
          $post_id = $row['post_id'];
          $post_category_name = $row['cat_name'];

          ?>

          <form class="" action="index.php?source=manage" method="post">
          <div class="manage-table-subsubgrid">

          <div class="padding-left">
            <?php echo $post_date_created; ?>
            <input type="text" name="post_id" value="<?php echo $post_id; ?>" style="display:none;">
          </div>

          <div class="padding-left">
            <?php echo $post_category_name; ?>
          </div>

          <div class="">
            <button class="manage-button" type="button" name="edit"><a href="index.php?source=edit&post_id=<?php echo $post_id; ?>"><i class="fas fa-edit"></a></i></button>
          </div>

          <div class="">
            <button class="manage-button" type="submit" name="delete"><i class="fas fa-trash"></i></button>
          </div>
        </div>

        </form>

          <?php
        } //while
      } //confirmQuery
     ?>

  </div><!-- manage-subgrid -->

</div><!-- container-manage -->

</form>
