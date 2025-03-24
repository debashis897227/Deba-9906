<?php include "header.inc.php" ?>

<main style="min-height: 550px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5 p-5" style="box-shadow: 0px 0px 10px #999;border-radius: 5px;">
                <h2 class="mt-4 text-center my-3">Register</h2>
                <form action="register_process.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" id="pincode" name="pincode" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <input type="radio" id="male" name="gender" value="Male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female">
                            <label for="female">Female</label>
                            <input type="radio" id="other" name="gender" value="Other">
                            <label for="other">Other</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required onchange="toggleFields()">
                            <option value="">Select Role</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Patient">Patient</option>
                        </select>
                    </div>

                    <!-- Doctor Fields -->
                    <div id="doctorFields" style="display: none;">
                        <div class="mb-3">
                            <label for="qualification" class="form-label">Qualification*</label>
                            <input type="text" class="form-control" id="qualification" name="qualification">
                        </div>
                        <div class="mb-3">
                            <label for="day" class="form-label">Day*</label>
                            <select class="form-control" id="day" multiple name="day[]">
                                <option value="1">Sunday</option>
                                <option value="2">Monday</option>
                                <option value="3">Tuesday</option>
                                <option value="4">Wednesday</option>
                                <option value="5">Thursday</option>
                                <option value="6">Friday</option>
                                <option value="7">Saturday</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="opening_time" class="form-label">Opening Time*</label>
                            <input type="time" class="form-control" id="opening_time" name="opening_time">
                        </div>

                        <div class="mb-3">
                            <label for="closing_time" class="form-label">Closing Time*</label>
                            <input type="time" class="form-control" id="closing_time" name="closing_time">
                        </div>

                        <div class="mb-3">
                            <label for="visit_fee" class="form-label">Visit Fee*</label>
                            <input type="number" step="0.01" class="form-control" id="visit_fee" name="visit_fee">
                        </div>
                    </div>

                    <!-- Patient Fields -->
                    <div id="patientFields" style="display: none;">
                        <div class="mb-3">
                            <label for="disease" class="form-label">Disease*</label>
                            <input type="text" class="form-control" id="disease" name="disease">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <!-- Link to Login Page -->
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="login.php">Login here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function toggleFields() {
        const role = document.getElementById("role").value;
        const doctorFields = document.getElementById("doctorFields");
        const patientFields = document.getElementById("patientFields");

        if (role === "Doctor") {
            doctorFields.style.display = "block";
            patientFields.style.display = "none";
        } else if (role === "Patient") {
            patientFields.style.display = "block";
            doctorFields.style.display = "none";
        } else {
            doctorFields.style.display = "none";
            patientFields.style.display = "none";
        }
    }
</script>

<?php include "footer.inc.php" ?>