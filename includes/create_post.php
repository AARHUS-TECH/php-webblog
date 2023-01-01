<?php


// CREATE new post
if(isset($_POST['create_post'])){

  // The date the entry is about (which does not have to be the current date!)
  $post_date = $_POST['date'];
  if($post_date == ''){
    $post_date = date('Y-m-d', time());
  }

  // Default because there is only 1 user for the time being.
  $post_author_id = 1;

  $post_category_id = $_POST['post_category_id'];

  $post_content = $_POST['post_content'];
  $post_content = mysqli_real_escape_string($conn, $post_content);


  $sql = "INSERT INTO posts (post_date, post_author_id, post_category_id, post_content) ";
  $sql .= "VALUES ('{$post_date}', '{$post_author_id}', '{$post_category_id}', '{$post_content}') ";

  $create_post_q = $conn->query($sql);

  if(confirmQuery($create_post_q)){

    $post_id = mysqli_insert_id($conn);

     $confirmation_alert = "Post was successfully created: " . " " . "<a href='index.php?source=manage'>View all posts</a>";

  }
} else {
  $confirmation_alert = '';
}

// CREATE dummy data
if(isset($_POST['create_dummy_data'])){

  $lorem = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
  $lorem = mysqli_real_escape_string($conn, $lorem);

  $sql = "INSERT INTO posts (post_date, post_author_id, post_category_id, post_content) ";
  $sql .= "VALUES (now(), '1', '1', '{$lorem}'), ";
  $sql .= "('2020-03-01', '1', '1', '{$lorem}'), ";
  $sql .= "('2020-03-02', '1', '3', '{$lorem}'), ";
  $sql .= "('2020-03-05', '1', '5', '{$lorem}'), ";
  $sql .= "('2020-03-04', '1', '4', '{$lorem}') ";

  $create_post_q = $conn->query($sql);

  if(confirmQuery($create_post_q)){

    $post_id = mysqli_insert_id($conn);

    $confirmation_alert = "Dummy data successfully created: " . " " . "<a href='index.php?source=manage'>View all posts</a>";
  }

}


 ?>


<form class="" action="" method="post" enctype="multipart/form-data">

  <div class="container-create">
    <h1>Create page</h1>

    <hr>

    <div class="form-group">
      <label for="">Date</label>
      <input class="form-control" type="date" name="date" value="">
    </div>

    <div class="form-group">
      <label for="">Category</label>
      <select class="form-control theme-container" name="post_category_id" required>
        <option value="">-</option>

        <?php
        // Populate dropdown menu with categories.
        $sql = "SELECT cat_id, cat_name FROM categories ORDER BY cat_name ASC "; //evt. tilføj LIMIT 3 for kun at få 3 inputs
        $get_categories_q = $conn->query($sql);

        if (confirmQuery($get_categories_q)) {
            while($row = $get_categories_q->fetch_assoc()) {
            $cat_id = $row["cat_id"];
            $cat_name = $row["cat_name"];

            echo "<option value={$cat_id}>{$cat_name}</option>";
          }
        }
         ?>
      </select>
    </div>

    <div class="form-group">
    <label for="" >Blog content</label>
    <textarea class="form-control" name="post_content" rows="8" cols="8" required></textarea>
    </div>

    <div class="form-group align-right">
      <button class="btn btn-primary" type="submit" name="create_post">Submit</button>
    </div>

    <div class="form-group align-right">
      <button class="btn btn-primary" type="submit" name="create_dummy_data">Dummy data</button>
    </div>

    <div class="">
      <p><?php echo $confirmation_alert; ?></p>
    </div>

  </div>

</form>
