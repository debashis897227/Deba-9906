
<footer id="footer" class="footer light-background mt-5">

<div class="container copyright text-center">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
  <div class="credits">
  </div>
</div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="/rm/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/rm/assets/vendor/php-email-form/validate.js"></script>
<script src="/rm/assets/vendor/aos/aos.js"></script>
<script src="/rm/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/rm/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/rm/assets/vendor/swiper/swiper-bundle.min.js"></script>

<script src="/rm/assets/js/toastr.min.js"></script>
<script src="/rm/assets/js/jquery-3.7.1.min.js"></script>
<script src="/rm/assets/js/jquery.validate.min.js"></script>

<!-- Main JS File -->
<script src="/rm/assets/js/main.js"></script>

<?php
if(isset($_SESSION["success"])) {
  echo "<script>toastr.success(".$_SESSION['success'].")</script>";
}
if(isset($_SESSION["error"])) {
  echo "<script>toastr.error(".$_SESSION['error'].")</script>";
}
?>

</body>

</html>