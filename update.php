<?php
include("auth_session.php");

require_once "db.php"; // Include your database connection

if(isset($_POST['save'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update query to update the user record
    $sql = "UPDATE Users SET Username='$username', Email='$email', Password='$password' WHERE Id='" . $_POST['id'] . "'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User has been updated.")</script>';
        echo "<script>window.location.href ='dashboard.php'</script>";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Fetch the existing user data to pre-fill the form fields for update
if(isset($_GET['id']) && $_GET['id'] != '') {
    $user_id = $_GET['id'];
    $user_query = mysqli_query($conn, "SELECT * FROM Users WHERE Id = $user_id");
    if(!$user_query) {
        die("Query failed: " . mysqli_error($conn));
    }
    $user_data = mysqli_fetch_assoc($user_query);
} else {
    // Handle the case where no user ID is provided
    echo "Error: User ID is missing!";
    exit; // Exit the script
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>User Form | Admin Panel</title>
    <!-- Favicon-->
    <link rel="icon" href="includes/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="includes/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="includes/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="includes/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="includes/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of getting all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
<?php include ("nav.php");   ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>USER FORM</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UPDATE USER
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <label for="username">Username</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="username" class="form-control" maxlength="50" placeholder="Enter username" name="username" value="<?php echo $user_data['Username']; ?>">
                                    </div>
                                </div>
                                <label for="email">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="email" class="form-control" maxlength="50"  placeholder="Enter email address" name="email" value="<?php echo $user_data['Email']; ?>">
                                    </div>
                                </div>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password" class="form-control" placeholder="Enter password" name="password">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $user_data['Id']; ?>"/>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="dashboard.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="includes/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="includes/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="includes/js/demo.js"></script>

    
    <!-- Select Plugin Js -->
    <script src="includes/plugins/bootstrap-select/js/bootstrap-select.js"></script>
</body>

</html>
