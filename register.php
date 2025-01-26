<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['auth'])){
        header("Location: ./dashboard/");
    }
    require_once('includes/frontend/header.php'); 
?>


    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card my-5">
                        <div class="card-body p-4">
                            <h2 class="fw-semi-bold">Regsiter Here</h2>
                            <form id="register_form" class="pt-4">
                                <div class="mb-3 form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="********" required>
                                </div>
                                <input type="hidden" name="catchRegisterData">
                                <div class="d-block">
                                    <button type="button" class="btn btn-a w-100 form_submit" data-target-form="#register_form" data-method="POST" data-form-action="core/auth.php">Register</button>
                                </div>
                                
                            </form>
                            <p class="text-center mt-4">Have an Account? <a href="login.php" class="hover-color-black color-a">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once('includes/frontend/footer.php'); ?>