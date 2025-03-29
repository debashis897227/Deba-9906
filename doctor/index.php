<?php include "../includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Dashboard</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Hi doc, welcome back !!</li>
        </ol>

        <!-- Area Chart -->
        <div class="row">
            <div class="col-xl-12">
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
        </div>

        <!-- Table Section -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Appointments
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Hardcoded user ID (replace with logged-in user's ID later)
                        $user_id = $_SESSION['user_id'];

                        // Fetch doctor ID based on user ID
                        $query = "SELECT id FROM doctors WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $query);
                        $doctor = mysqli_fetch_assoc($result);
                        $doctor_id = $doctor['id'];

                        // Fetch appointments for the doctor
                        $query = "
                            SELECT a.schedule, a.status, a.payment_status, u.name AS patient_name
                            FROM appointments a
                            JOIN patients p ON a.patient_id = p.id
                            JOIN users u ON p.user_id = u.id
                            WHERE a.doctor_id = $doctor_id
                        ";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row['patient_name']); ?></td>
                                <td><?= htmlspecialchars($row['schedule']); ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><?= htmlspecialchars($row['payment_status']); ?></td>
                            </tr>
                        `<?php endwhile; ?>`
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
    // Fetch appointments data for the current year for the logged-in doctor
    fetch('get_doctor_appointments_data.php?user_id=2') // Hardcoded user ID (replace with logged-in user's ID later)
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

<?php include "includes/footer.php" ?>