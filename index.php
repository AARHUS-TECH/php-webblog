<?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>

    <?php
      if(isset($_GET['source'])){
        $source = $_GET['source'];
      } else {
        $source = '';
      }

      switch ($source) {
        case 'manage':
        include "includes/manage_posts.php";
        break;
        case 'create':
        include "includes/create_post.php";
        break;
        case 'edit':
        include "includes/edit_post.php";
        break;
        case 'category':
        include "includes/manage_categories.php";
        break;

        default:
        include "includes/view_posts.php";
        break;
      }
      
     ?>

<?php include "includes/footer.php"; ?>
