<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
<?php include "../includes/db.php" ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Welcome to admin dashboard</li>
        </ol>

        <!-- Card Section -->
        <div class="row">
            <!-- Total Users -->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <?php
                    $query = "SELECT COUNT(*) AS total_users FROM users";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_users = $row['total_users'];
                    ?>
                    <div class="card-body">Total Users: <?= $total_users; ?></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="manage-users">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <?php
                    $query = "SELECT COUNT(*) AS total_products FROM products";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_products = $row['total_products'];
                    ?>
                    <div class="card-body">Total Products: <?= $total_products; ?></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="manage-products">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <?php
                    $query = "SELECT COUNT(*) AS total_orders FROM orders";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_orders = $row['total_orders'];
                    ?>
                    <div class="card-body">Total Orders: <?= $total_orders; ?></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="manage-orders">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Total Appointments -->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <?php
                    $query = "SELECT COUNT(*) AS total_appointments FROM appointments";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_appointments = $row['total_appointments'];
                    ?>
                    <div class="card-body">Total Appointments: <?= $total_appointments; ?></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="manage-appointments">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphs Section -->
        <div class="row">
            <!-- Appointments Graph -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Appointments This Year
                    </div>
                    <div class="card-body">
                        <canvas id="appointmentsChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>

            <!-- Orders Graph -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Orders This Year
                    </div>
                    <div class="card-body">
                        <canvas id="ordersChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Registered Users
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT name, email, role, is_active FROM users";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['role']); ?></td>
                                <td><?= $row['is_active'] ? 'Active' : 'Inactive'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script for Appointments Chart -->
<script>
    // Fetch appointments data for the current year
    fetch('common/get_appointments_data.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('appointmentsChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Appointments',
                        data: data.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

<!-- Script for Orders Chart -->
<script>
    // Fetch orders data for the current year
    fetch('common/get_orders_data.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('ordersChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Orders',
                        data: data.values,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

<?php include "includes/footer.php" ?>