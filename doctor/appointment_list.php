<?php include "../includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Appointment List</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Appointment List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Appointments
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
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
                            SELECT a.id, a.schedule, a.status, a.payment_status, u.name AS patient_name, p.id AS patient_id
                            FROM appointments a
                            JOIN patients p ON a.patient_id = p.id
                            JOIN users u ON p.user_id = u.id
                            WHERE a.doctor_id = $doctor_id
                        ";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td>
                                    <a href="appointment_details.php?id=<?= $row['id']; ?>" class="text-primary">
                                        <?= $row['id']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="patient_details.php?id=<?= $row['patient_id']; ?>" class="text-primary">
                                        <?= htmlspecialchars($row['patient_name']); ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($row['schedule']); ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><?= htmlspecialchars($row['payment_status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.php" ?>