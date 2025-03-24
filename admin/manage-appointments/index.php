<?php include "../includes/header.php" ?>
<?php include "../includes/nav.php" ?>
<?php include "../../includes/db.php" ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Appointments</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Appointments</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-table me-1"></i>
                        Appointments
                    </div>
                    <div class="col-6">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?php
                // Fetch appointments from the database
                $query = "
                    SELECT a.id, a.patient_id, a.doctor_id, pu.name AS patient_name, du.name AS doctor_name, a.schedule, 
                           a.status, a.payment_method, a.payment_status, a.visit_fee
                    FROM appointments a
                    JOIN patients p ON a.patient_id = p.id
                    JOIN users pu ON p.user_id = pu.id
                    JOIN doctors d ON a.doctor_id = d.id
                    JOIN users du ON d.user_id = du.id
                ";
                $result = mysqli_query($conn, $query);
                ?>

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Visit Fee</th>
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
                                    <a href="/rm/admin/common/patient_doctor_details.php?id=<?= $row['doctor_id']; ?>&type=doctor" class="text-primary">
                                        <?= $row['doctor_name']; ?>
                                    </a>
                                </td>
                                <td><?= $row['schedule']; ?></td>
                                <td><?= $row['status']; ?></td>
                                <td><?= $row['payment_method']; ?></td>
                                <td><?= $row['payment_status']; ?></td>
                                <td><?= $row['visit_fee']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>