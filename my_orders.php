<?php include "includes/header.php" ?>

<section id="order" class="order section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>products</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">
      <?php
      // Fetch products from the database
      $query = "SELECT id, name, brand, type, stock_available, original_price, selling_price FROM products";
      $result = mysqli_query($conn, $query);
      ?>

      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <div class="team-member d-flex align-items-start gap-4" style="background-color: var(--surface-color);box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);position: relative;border-radius: 5px;transition: 0.5s;padding: 30px;height: 100%;">
            <div class="pic" style="border-radius:0px;"><img src="assets\img\product\medicien-1.webp" style="width:150px;" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4><?= $row['name']; ?> </h4>
              <span><?= $row['brand']; ?></span>
              <p><?= $row['selling_price']; ?></p>
            </div>
          </div>
        </div><!-- End Team Member -->
      <?php endwhile; ?>

    </div>

  </div>

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