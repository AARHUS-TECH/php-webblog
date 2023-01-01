
<div class="post-per-page">
  <form class="" action="?source=view" method="post">
  <label for="">Number of posts per page:</label>
  <div class="manage-multiselect-subgrid form-group">
    <select class="form-control category-selector" name="post_amount_selection">
      <?php

      if(isset($_POST['posts_per_page'])){
        $_SESSION['post_amount'] = $_POST['post_amount_selection'];
        $post_amount = $_POST['post_amount_selection'];

        populate_posts_per_page_options($post_amount);

      } else {
        // Check if session has stored a value and display according to that.
        if(isset($_SESSION['post_amount'])){
          $post_amount = $_SESSION['post_amount'];

          populate_posts_per_page_options($post_amount);
        } else {
        ?>

        <option value="5">5</option>
        <option value="15">15</option>
        <option value="25">25</option>

        <?php
      }
    }
       ?>

    </select>
    <input class="btn btn-success category-button" type="submit" name="posts_per_page" value="Apply">
  </div>
  </form>
</div>





<div class="post-by-category">
  <form class="" action="?source=view" method="post">

  <div class="">
    <label for="">Sort by:</label>
    <div class="manage-multiselect-subgrid form-group">
      <select class="form-control category-selector" name="order_selection">
        <?php

        if(isset($_POST['order_by'])){
          $_SESSION['sort_order'] = $_POST['order_selection'];
          $order_selection = $_POST['order_selection'];

        populate_sort_setting_options($order_selection);

      } else {
        // Check if session has stored a value and dosplay according to that.
        if(isset($_SESSION['sort_order'])){
          $sort_order = $_SESSION['sort_order'];

          populate_sort_setting_options($sort_order);

        } else {

        ?>

        <option value="DESC">Newest</option>
        <option value="ASC">Oldest</option>

        <?php

      }
      }


         ?>

        <!-- <option value="">Author</option> -->
      </select>
      <input class="btn btn-success category-button" type="submit" name="order_by" value="Apply">
    </div>
  </div>

  </form>
</div>
