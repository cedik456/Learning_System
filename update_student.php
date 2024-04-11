<?php
include("auth_session.php");

require_once "db.php"; // Include your database connection

if(isset($_POST['save'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Validate input
    if(empty($name) || empty($age) || empty($gender)) {
        echo "Error: Please fill in all fields.";
        exit;
    }
    // Further validation can be added for specific requirements such as age range, gender options, etc.

    // Update query to update the student record
    $sql = "UPDATE Students SET Name='$name', Age='$age', Gender='$gender' WHERE Id='" . $_POST['id'] . "'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Student has been updated.")</script>';
        echo "<script>window.location.href ='students.php'</script>";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Fetch the existing student data to pre-fill the form fields for update
if(isset($_GET['id']) && $_GET['id'] != '') {
    $studentId = $_GET['id'];
    $studentQuery = mysqli_query($conn, "SELECT * FROM Students WHERE Id = $studentId");
    if(!$studentQuery) {
        die("Query failed: " . mysqli_error($conn));
    }
    $studentData = mysqli_fetch_assoc($studentQuery);
} else {
    // Handle the case where no student ID is provided
    echo "Error: Student ID is missing!";
    exit; // Exit the script
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Student Form | Admin Panel</title>
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
                <h2>STUDENT FORM</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UPDATE STUDENT
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" maxlength="255" placeholder="Enter name" name="name" value="<?php echo $studentData['Name']; ?>">
                                    </div>
                                </div>
                                <label for="age">Age</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="age" class="form-control" placeholder="Enter age" name="age" value="<?php echo $studentData['Age']; ?>">
                                    </div>
                                </div>
                                <label for="gender">Gender</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="gender" class="form-control show-tick" name="gender">
                                            <option value="Male" <?php if($studentData['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                            <option value="Female" <?php if($studentData['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $studentData['Id']; ?>"/>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="students.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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

    <!-- Slimscroll Plugin Js -->
    <script src="includes/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="includes/js/demo.js"></script>
</body>

</html>
