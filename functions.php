<?php

function populate_posts_per_page_options($string){

    if($string === "15"){
      ?>

      <option value="15">15</option>
      <option value="5">5</option>
      <option value="25">25</option>

      <?php
    } else if($string === "25"){
      ?>

      <option value="25">25</option>
      <option value="5">5</option>
      <option value="15">15</option>

      <?php
    } else {
      ?>

      <option value="5">5</option>
      <option value="15">15</option>
      <option value="25">25</option>

      <?php

    }

}


function populate_sort_setting_options($string){


    if($string === "DESC"){
      ?>

      <option value="DESC">Newest</option>
      <option value="ASC">Oldest</option>

      <?php
    } else {
      ?>

      <option value="ASC">Oldest</option>
      <option value="DESC">Newest</option>

      <?php
    }

}


function confirmQuery($result){
  global $conn;
  if(!$result){
    die("Query failed. " . mysqli_error($conn)); // prøv $conn->connect_error
  } else {
    return true;
  }
}


function create_category() {
  // REMEMBER to make the connection global when implementing a function!!!
  global $conn;
  if(isset($_POST['create_category'])){

    $cat_name = $_POST['cat_name'];
    $cat_name = mysqli_real_escape_string($conn, $cat_name);

    $sql = "INSERT INTO categories (cat_name) ";
    $sql .= "VALUE ('{$cat_name}') ";

    $create_category_q = $conn->query($sql);

    if(!$create_category_q){
      die('Query failed' . mysqli_error($conn));
    } else {
      header("Location: index.php?source=category");
    }

  }
}

function edit_category() {
  global $conn;
  if(isset($_POST['edit_category'])){
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $cat_name = mysqli_real_escape_string($conn, $cat_name);

    $sql = "UPDATE categories SET cat_name = '{$cat_name}' WHERE cat_id = {$cat_id} ";
    $edit_cat_name_q = $conn->query($sql);

    if(!$edit_cat_name_q){
      die("Query failed" . mysqli_error($conn));
    }
    header("Location: ?source=category");

  }
}


function find_all_categories(){
  global $conn;
  // find all categories query
  $sql = "SELECT cat_id, cat_name, COUNT(post_id) FROM categories ";
  $sql .= "LEFT JOIN posts ";
  $sql .= "ON categories.cat_id = posts.post_category_id ";
  $sql .= "GROUP BY cat_id ";
  $sql .= "ORDER BY cat_name ASC "; //evt. tilføj LIMIT 3 for kun at få 3 inputs
  $get_categories_q = $conn->query($sql);

  if (confirmQuery($get_categories_q)) {
      while($row = $get_categories_q->fetch_assoc()) {
      $cat_id = $row["cat_id"];
      $cat_name = $row["cat_name"];
      $count = $row["COUNT(post_id)"];

      echo "<tr>";
      echo "<td>{$cat_name}</td>";
      echo "<td>{$count}</td>";
      echo "<td><a href='index.php?source=category&edit={$cat_id}'><i class='fas fa-edit'></i></a></td>";

      ?>

      <form class='' action='index.php?source=category' method='post'>
        <td>
        <input type='text' name='cat_id' value='<?php echo $cat_id; ?>' style='display:none;'>
        <button class='manage-button' type='submit' name='delete'><i class='fas fa-trash'></i></button>
        </td>
      </form>

      <?php
      //echo "<td><a href='index.php?source=category&delete={$cat_id}'>Delete</a></td>";
      echo "</tr>";
    }
  }
}


function delete_category(){
  global $conn;
  // delete a category query
  if(isset($_POST['delete'])){
    $cat_id_delete = $_POST['cat_id'];

    $sql = "DELETE FROM categories WHERE cat_id = {$cat_id_delete} ";
    $delete_category_q = $conn->query($sql);
    if (!$delete_category_q){
      "The query failed" . mysqli_error($conn);
    } else {
      header("Location: index.php?source=category");
    }

  }
}





 ?>
