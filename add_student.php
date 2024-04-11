<?php
require_once "db.php";
include("auth_session.php");

if(isset($_POST['save'])) {    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hashing the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into Users table
    $user_sql = "INSERT INTO Users (Username, Email, Password) VALUES ('$name', '$email', '$hashed_password')";
    
    if (mysqli_query($conn, $user_sql)) {
        // Retrieve the auto-generated ID of the inserted user
        $user_id = mysqli_insert_id($conn);
        
        // Insert student data into Students table
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $student_sql = "INSERT INTO Students (UserId, Name, Age, Gender) VALUES ($user_id, '$name', $age, '$gender')";
        
        if (mysqli_query($conn, $student_sql)) {
            echo '<script>alert("User and student data have been added successfully.")</script>';
            echo '<script>window.location.href = "students.php";</script>';
        } else {
            echo "Error: " . $student_sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $user_sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Form Examples | Bootstrap Based Admin Template - Material Design</title>
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

    <!-- Sweet Alert Css -->
    <link href="includes/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="includes/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">
    
    <!-- AdminBSB Themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body>
    <?php include ("nav.php"); ?>
    
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>FORM EXAMPLES</h2>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VERTICAL LAYOUT</h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <label for="name">Name</label>
                                <div class="form-group">
                                    <input type="text" id="name" class="form-control" maxlength="255" placeholder="Enter your Name" name="name" required>
                                </div>
                                <label for="email">Email Address</label>
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" maxlength="255" placeholder="Enter your email address" name="email" required>
                                </div>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <input type="password" id="password" class="form-control" maxlength="255" placeholder="Enter your password" name="password" required>
                                </div>
                                <label for="age">Age</label>
                                <div class="form-group">
                                    <input type="number" id="age" class="form-control" min="0" max="150" placeholder="Enter your age" name="age" required>
                                </div>
                                <label for="gender">Gender</label>
                                <div class="form-group">
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="save">Submit</button>
                                <a href="dashboard.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>
    
    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Bootstrap Select Plugin Js -->
    <script src="includes/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="includes/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
</body>
</html>
