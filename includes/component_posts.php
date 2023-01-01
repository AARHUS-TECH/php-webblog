<?php

  if(isset($_GET['display'])){
    $_SESSION['search_term'] = null;
    $_SESSION['cat_id'] = null;
  }
  if(isset($_GET['cat_id'])){
    $_SESSION['search_term'] = null;
  }
  if(isset($_POST['start_search'])){
    $_SESSION['cat_id'] = null;
  }

 ?>
<?php
  // Display all posts default + after search + by chosen category + by chosen order
  $sql = "SELECT post_id, DATE_FORMAT(post_date, '%Y-%m-%d') as post_date, post_content, post_category_id, cat_name ";
  $sql .= "FROM posts ";
  $sql .= "JOIN categories ";
  $sql .= "ON posts.post_category_id = categories.cat_id ";

  if(isset($_POST['start_search'])){
    $_SESSION['search_term'] = $_POST['search_term'];
  }
  // This needs to be checked separately because the session is reused if the amount of posts or the order is changed.
  if(isset($_SESSION['search_term'])){
    $search_term = $_SESSION['search_term'];
    $sql .= "WHERE post_content LIKE '%{$search_term}%' OR cat_name LIKE '%{$search_term}%' ";
    echo "<p>Posts containing: {$search_term} </p>";
  }

  if(isset($_GET['cat_id'])){
    $_SESSION['cat_id'] = $_GET['cat_id'];
  }
  // This needs to be checked separately because the session is reused if the amount of posts or the order is changed.
  if(isset($_SESSION['cat_id'])){
    $cat_id = $_SESSION['cat_id'];
    $sql .= "WHERE posts.post_category_id = {$cat_id} ";
  }

  // if(isset($_POST['order_by'])){
  //   $order_by = $_POST['order_selection'];
  // } else if(isset($_SESSION['sort_order'])) {
  //   $order_by = $_SESSION['sort_order'];
  // } else {
  //   $order_by = "DESC";
  // }
  //
  // $sql .= "ORDER BY post_date {$order_by}, post_date_updated {$order_by} ";
  //
  // if(isset($_POST['posts_per_page'])){
  //   $limit_posts_per_page = $_POST['post_amount_selection'];
  //   $sql .= "LIMIT 1,{$limit_posts_per_page} ";
  // } else if(isset($_SESSION['post_amount'])){
  //   $limit_posts_per_page = $_SESSION['post_amount'];
  //   $sql .= "LIMIT 1,{$limit_posts_per_page} ";
  // } else {
  //   $sql .= "LIMIT 1,3 ";
  // }
  $get_posts_q = $conn->query($sql);

  echo mysqli_num_rows($get_posts_q);

  if(mysqli_num_rows($get_posts_q) == 0){
    echo "<h2>There are no posts to display";
  } else {

  if(confirmQuery($get_posts_q)){
    while($row = $get_posts_q->fetch_assoc()){
      $post_id = $row['post_id'];
      $post_date = $row['post_date'];
      $post_content = $row['post_content'];
      $cat_id = $row['post_category_id'];
      $cat_name = $row['cat_name'];

    ?>


<div class="post">
  <label for="">Date: <a href="?source=edit&post_id=<?php echo $post_id; ?>"><?php echo $post_date; ?></a></label>
  <p class="paragraph-view">
    <?php echo $post_content; ?>
  </p>
  <label for="">Author: Trung Huynh</label>
  <br>
  <a href="?source=view&cat_id=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a>
  <hr>
</div>

<?php

  }// While loop
  }// If else
  }// confirmQuery

  ?>
