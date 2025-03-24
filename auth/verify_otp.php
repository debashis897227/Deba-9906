<?php include "header.inc.php" ?>

<main style="min-height: 550px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5 p-5" style="box-shadow: 0px 0px 10px #999;border-radius: 5px;">
                <h2 class="mt-4 text-center my-3">Verify OTP</h2>
                <form action="verify_otp_process.php" method="POST">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "footer.inc.php" ?>