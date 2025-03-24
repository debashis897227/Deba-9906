<?php include "../includes/header.php" ?>
<?php include "../includes/nav.php" ?>
<?php include "../../includes/db.php" ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-table me-1"></i>
                        Orders
                    </div>
                    <div class="col-6">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?php
                // Fetch orders from the database
                $query = "
                    SELECT o.id, o.patient_id, o.product_id, u.name AS patient_name, p.name AS product_name, o.status, 
                           o.payment_method, o.payment_status, o.price, o.expected_delivery_date
                    FROM orders o
                    JOIN patients pa ON o.patient_id = pa.id
                    JOIN users u ON pa.user_id = u.id
                    JOIN products p ON o.product_id = p.id
                ";
                $result = mysqli_query($conn, $query);
                ?>

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Price</th>
                            <th>Expected Delivery Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td>
                                    <a href="update_details.php?id=<?= $row['id']; ?>" class="text-primary">
                                        <?= $row['id']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="/rm/admin/common/patient_doctor_details.php?id=<?= $row['patient_id']; ?>&type=patient" class="text-primary">
                                        <?= $row['patient_name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="/rm/admin/common/product_details.php?id=<?= $row['product_id']; ?>" class="text-primary">
                                        <?= $row['product_name']; ?>
                                    </a>
                                </td>
                                <td><?= $row['status']; ?></td>
                                <td><?= $row['payment_method']; ?></td>
                                <td><?= $row['payment_status']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['expected_delivery_date']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>