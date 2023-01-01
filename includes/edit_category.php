


<?php // update category query - this is connected to update inputfield
if(isset($_GET['edit'])){
  $cat_id = $_GET['edit'];
  $sql = "SELECT * FROM category WHERE id = $cat_id "; //evt. tilføj LIMIT 3 for kun at få 3 inputs
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
  $cat_id = $row["cat_id"];
  $cat_name = $row["cat_name"];

?>

    <input class="form-control" type="text" name="cat_name_update" value="<?php if(isset($cat_name)){echo $cat_name;} ?> required">

<?php }} ?>


<!-- This php is connected to the update button -->
<?php
  if(isset($_POST['update'])){
    $cat_title = $_POST['cat_name_update'];
    $sql = "UPDATE category SET name = '{$cat_name}' WHERE id = {$cat_id} ";
    $result = $conn->query($sql);

    if(!$result){
      die("Query failed" . mysqli_error($conn));
    }
    header("Location: manage_categories.php");

  }

 ?>

 <form class="" action="" method="post">
   <div class="form-group">
     <label for="cat-title">Edit Category </label>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update" value="Update">
  </div>
</form>
