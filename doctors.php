<?php include "includes/header.php" ?>


<section id="doctors" class="doctors section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Doctors</h2>
  <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">
    <?php
     $query ="SELECT * from doctors INNER JOIN users on doctors.user_id = users.id ";
     $result = mysqli_query($conn, $query);
    ?>

<?php while ($row = mysqli_fetch_assoc($result)) :?>

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
      <div class="team-member d-flex align-items-start">
        <div class="pic"><img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
          <h4><?= $row['name'];?></h4>
          <span><?= $row['qualification'];?></span>
          <p><?= $row['visit_fee'];?></p>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
          </div>
        </div>
      </div>
    </div><!-- End Team Member -->
    <?php endwhile; ?>

  

</section><!-- /Doctors Section -->


<section>
<nav aria-label="..." class="float-end me-3">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <span class="page-link">2</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</section>

<?php include "includes/footer.php" ?>