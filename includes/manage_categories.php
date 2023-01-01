
  <div class="container-category">

    <div class="category-header">
      <h1>Category page</h1>
      <hr>
    </div>


    <div class="category-add">
      <?php
      if(isset($_GET['edit'])){

        $cat_id = $_GET['edit'];
        $sql = "SELECT cat_name FROM categories WHERE cat_id = $cat_id ";
        $get_category_q = $conn->query($sql);

        if(confirmQuery($get_category_q)){
          while($row = $get_category_q->fetch_assoc()) {
          $cat_name = $row["cat_name"];

          $input_label = "Edit category";
          $input_value = $cat_name;
          $button_label = "Edit";
          $button_action = "edit_category";
        }
      }
      } else {
        $input_label = "Create category";
        $input_value = "";
        $cat_id = "";
        $button_label = "Add";
        $button_action = "create_category";
      }

       ?>

      <form class="" action="" method="post">
        <div class="form-group">
          <label for="cat-name-label"><?php echo $input_label; ?></label>
          <input class="form-control" type="text" name="cat_name" value="<?php echo $input_value; ?>" required>
          <!-- Hidden input field for id -->
          <input type="number" name="cat_id" value="<?php echo $cat_id; ?>" style="display: none">
        </div>
        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="<?php echo $button_action; ?>" value="<?php echo $button_label; ?>">
        </div>
      </form>

    </div>

    <div class="category-table">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Category title</th>
            <th>Related posts</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>

            <?php
            find_all_categories();

            create_category();

            edit_category();

            delete_category();
            ?>

        </tbody>
      </table>
    </div>



</div>
