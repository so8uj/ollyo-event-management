<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['auth'])){
        header("Location: dashboard/");
    }
    require_once('includes/frontend/header.php'); 
?>


    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card my-5">
                        <div class="card-body p-4">
                            <h2 class="fw-semi-bold">Login</h2>
                            <form id="login_form" class="pt-4">
                                <div class="mb-3 form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                                </div>
                                <input type="hidden" name="catchLoginData">
                                <div class="d-block">
                                    <button type="button" class="btn btn-a w-100 form_submit" data-target-form="#login_form" data-method="POST" data-form-action="core/auth.php">Login</button>
                                </div>
                                
                            </form>
                            <p class="text-center mt-4">Don't have an Account? <a href="register.php" class="hover-color-black color-a">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once('includes/frontend/footer.php'); ?>