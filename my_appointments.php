<?php
include "includes/header.php";

?>
<div class="container ">
    <div class="row my-3">
        <?php
        $patient_id = 1; // Change this as needed

        $sql = "SELECT * FROM appointments WHERE patient_id = $patient_id ORDER BY schedule DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $appointment_id = $row['id'];
                $doctor_id = $row['doctor_id'];
                $schedule = $row['schedule'];
                $status = $row['status'];
                $payment_status = $row['payment_status'];
                $visit_fee = $row['visit_fee'];

                echo '
                <div class="col-md-6">
                    <div class="card my-2">
                        <div class="card-body">
                            <p><strong>Doctor ID:</strong> ' . $doctor_id . '</p>
                            <p><strong>Schedule:</strong> ' . $schedule . '</p>
                            <p><strong>Status:</strong> ' . $status . '</p>
                            <p><strong>Payment Status:</strong> ' . $payment_status . '</p>
                            <p><strong>Visit Fee:</strong> $' . $visit_fee . '</p>
                        </div>
                        <div class="card-footer">';

                if ($status === 'Scheduled') {
                    echo '<form method="post" action="cancel_appointment.php">
                    <input type="hidden" name="appointment_id" value="' . $appointment_id . '">
                    <button type="submit" class="btn btn-danger">Cancel</button>
                  </form>';
                } else {
                    echo '<button class="btn btn-secondary" disabled>Cancelled</button>';
                }

                echo '      </div>
                    </div>
                </div>
           ';
            }
        } else {
            echo "<p>No appointments found.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</div>

<?php
include "includes/footer.php";

?>