<?php
include("auth_session.php");

require_once "db.php"; // Include your database connection

if(isset($_POST['save'])) {
    $courseName = $_POST['course_name'];
    $languageId = $_POST['language_id'];

    // Validate input
    if(empty($courseName) || empty($languageId)) {
        echo "Error: Please fill in all fields.";
        exit;
    }
    
    // Further validation can be added for specific requirements such as language existence check, etc.

    // Update query to update the course record
    $sql = "UPDATE Courses SET CourseName='$courseName', LanguageId='$languageId' WHERE Id='" . $_POST['id'] . "'";

    try {
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Course has been updated.")</script>';
            echo "<script>window.location.href ='courses.php'</script>";
        } else {
            echo "Error: " . $sql . " " . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
        // Handle foreign key constraint violation error
        echo "Error: Unable to update course. This language ID may not exist.";
    }

    mysqli_close($conn);
}

// Fetch the existing course data to pre-fill the form fields for update
if(isset($_GET['id']) && $_GET['id'] != '') {
    $courseId = $_GET['id'];
    $courseQuery = mysqli_query($conn, "SELECT * FROM Courses WHERE Id = $courseId");
    if(!$courseQuery) {
        die("Query failed: " . mysqli_error($conn));
    }
    $courseData = mysqli_fetch_assoc($courseQuery);
} else {
    // Handle the case where no course ID is provided
    echo "Error: Course ID is missing!";
    exit; // Exit the script
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Course Form | Admin Panel</title>
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
                <h2>COURSE FORM</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UPDATE COURSE
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <label for="course_name">Course Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="course_name" class="form-control" maxlength="255" placeholder="Enter course name" name="course_name" value="<?php echo $courseData['CourseName']; ?>">
                                    </div>
                                </div>
                                <label for="language_id">Language ID</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="language_id" class="form-control" placeholder="Enter language ID" name="language_id" value="<?php echo $courseData['LanguageId']; ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $courseData['Id']; ?>"/>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="courses.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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
