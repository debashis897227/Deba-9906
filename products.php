<?php include "includes/header.php" ?>


<section id="products" class="doctors section">

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

            <?php while ($row = mysqli_fetch_assoc($result)) :
                echo '<input type="hidden" id="product_id'.$row['id'].'" name="product_id" value="' . $row['id'] . '">';
                echo '<input type="hidden" id="product_name'.$row['id'].'" name="product_name" value="' . $row['name'] . '">';
                echo '<input type="hidden" id="brand'.$row['id'].'" name="brand" value="' . $row['brand'] . '">';
                echo '<input type="hidden" id="type'.$row['id'].'" name="type" value="' . $row['type'] . '">';
                echo '<input type="hidden" id="stock_available'.$row['id'].'" name="stock_available" value="' . $row['stock_available'] . '">';
                echo '<input type="hidden" id="original_price'.$row['id'].'" name="original_price" value="' . $row['original_price'] . '">';
                echo '<input type="hidden" id="selling_price'.$row['id'].'" name="selling_price" value="' . $row['selling_price'] . '">';
            ?>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic" style="border-radius:0px;"><img src="assets\img\product\medicien-1.webp" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4><?= $row['name']; ?> </h4>
                            <span><?= $row['brand']; ?></span>
                            <p><?= $row['selling_price']; ?></p>



                            <input type="hidden" name=""><input type="hidden" name=""><input type="hidden" name=""><input type="hidden" name=""><input type="hidden" name=""><input type="hidden" name=""><input type="hidden" name="">
                            <div class="d-flex gap-4">
                                <span  id="addToCartBtn" onclick="addToCart(<?php echo $row['id']; ?>)"><i class="bi bi-bag-plus-fill"></i> Add to Cart</span>
                            </div>
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
<script>
    // Example Usage
    // addProduct(product);

    function addToCart(id){
        let product = {
        "id": Number($("#product_id"+id).val()),
        "name": $("#product_name"+id).val(),
        "brand": $("#brand"+id).val(),
        "type": $("#type"+id).val(),
        "stock_available": $("#stock_available"+id).val(),
        "selling_price": $("#selling_price"+id).val()
    };

    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

        // Check if the product already exists
        let existingProduct = cartItems.find(p => p.id === product.id);

        if (existingProduct) {
            alert("Product already added!");
            return;
        }

        // Add new product
        cartItems.push(product);

        // Save updated array back to localStorage
        localStorage.setItem("cartItems", JSON.stringify(cartItems));

        console.log("Product added:", cartItems);
    }

</script>