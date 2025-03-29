<?php
include "includes/header.php";
if(!isset($_SESSION['user_id'])){
    echo '<script>alert("You Have To Login First !");
    window.location.href="auth/login.php";
    </script>';
}
if($_GET['product_id']){
   $product_id = $_GET['product_id']; 
   $patient_id = $_SESSION['user_id']; 
   
}
?>
<div class="container ">
    <div class="row my-3">
        <?php
        
        ?>
    </div>
</div>

<?php
include "includes/footer.php";

?>