<?php include "header.inc.php" ?>

<main style="min-height: 550px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5 p-5" style="box-shadow: 0px 0px 10px #999;border-radius: 5px;">
                <h2 class="mt-4 text-center my-3">Login</h2>
                <form action="send_otp.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send OTP</button>
                </form>
                <!-- Link to Register Page -->
                <div class="mt-3 text-center">
                    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "footer.inc.php" ?>