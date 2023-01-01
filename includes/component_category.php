<!-- Blog Categories Well -->
<div class="well">
    <h5>Blog Categories</h5>
    <div class="view-category-subgrid">
              <?php

              $sql = "SELECT cat_id, cat_name FROM categories ";
              $sql .= "ORDER BY cat_name ASC "; //evt. tilføj LIMIT 3 for kun at få 3 inputs
              $get_categories_q = $conn->query($sql);

              if (confirmQuery($get_categories_q)) {
                  while($row = $get_categories_q->fetch_assoc()) {
                  $cat_id = $row["cat_id"];
                  $cat_name = $row["cat_name"];

                ?>

                <div class="">
                  <a href="?source=view&cat_id=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a>
                </div>

                <?php
              } // While $row
              } //confirmQuery
               ?>




    </div>
    <!-- /.row -->
</div>
