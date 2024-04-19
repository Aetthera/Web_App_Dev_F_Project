<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        #alert,
        #register-box,
        #forgot-box {
            display: none;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="text- center heading6">
        <h1>Team 6</h1>
    </nav>


    <!-- Login Form -->
    <div class="row">
        <div class="col-lg-4 offset-lg-4 bg-body-secondary rounded" id="login-box">
            <h2 class="text-center mt-2">Login</h2>
            <form action="login.php" method="post" role="form" class="p-2" id="login-frm">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"> <?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group mt-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mt-4 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="rem" class="custom-control-input" id="customCheck">
                        <label for="customCheck" class="custom-control-label">Remember Me</label>
                        <a href="#" id="forgot-btn" class="float-end">Forgot Password?</a>
                    </div>
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="login" id="login" value="Login" class="btn btn-primary d-grid col-12 mt-4 mb-2">
                </div>
                <div class="form-group">
                    <p class="text-center mt-4">New User? <a href="#" id="register-btn">Register Here</a></p>
                </div>
            </form>
        </div>
    </div>


    <!-- Registration Form -->
    <div class="row">
        <div class="col-lg-4 offset-lg-4 bg-body-secondary rounded" id="register-box">
            <h2 class="text-center mt-2">Register</h2>
            <form action="register.php" method="post" role="form" class="p-2" id="register-frm">
                <div class="form-group mt-3">
                    <input type="text" name="uname" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group mt-3">
                    <input type="password" name="pass" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mt-3">
                    <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="form-group mt-4 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="rem" class="custom-control-input" id="customCheck2">
                        <label for="customCheck2" class="custom-control-label">I agree to <a href="#">be happy.</a></label>
                    </div>
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="register" id="register" value="Register" class="btn btn-primary d-grid col-12 mt-4 mb-2"></input>
                </div>
                <div class="form-group">
                    <p class="text-center mt-4">Already Registered? <a href="#" id="login-btn">Login Here</a></p>
                </div>
            </form>
        </div>
    </div>


    <!-- Forgot Password -->
    <div class="row">
        <div class="col-lg-4 offset-lg-4 bg-body-secondary rounded" id="forgot-box">
            <h2 class="text-center mt-2">Reset Password</h2>
            <form action="" method="post" role="form" class="p-2" id="forgot-frm">
                <div class="form-group mb-3">
                    <small class="text-muted">
                        To reset the password, enter your username.
                    </small>
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="uname" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="forgot" id="forgot" value="Reset" class="btn btn-primary d-grid col-12 mt-4 mb-2">
                </div>
                <div class="form-group text-center mt-3">
                    <a href="#" id="back-btn">Back</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    <footer>
        <h6 class="text-center">All right reserved</h6>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#forgot-btn").click(function() {
                $("#login-box").hide();
                $("#forgot-box").show();
            });
        });

        $("#register-btn").click(function() {
            $("#login-box").hide();
            $("#register-box").show();
        });

        $("#login-btn").click(function() {
            $("#register-box").hide();
            $("#login-box").show();
        });

        $("#back-btn").click(function() {
            $("#forgot-box").hide();
            $("#login-box").show();
        });
    </script>
</body>

</html>