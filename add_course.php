<?php
require_once "db.php";
include("auth_session.php");

if(isset($_POST['save'])) {
    $courseName = $_POST['courseName'];
    $languageId = $_POST['languageId'];

    // Insert course data into Courses table
    $course_sql = "INSERT INTO Courses (CourseName, LanguageId) VALUES ('$courseName', $languageId)";

    if (mysqli_query($conn, $course_sql)) {
        echo '<script>alert("Course data has been added successfully.")</script>';
        echo '<script>window.location.href = "courses.php";</script>';
    } else {
        echo "Error: " . $course_sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Course | Your Website</title>
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
</head>
<body>
    <?php include ("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD COURSE</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>NEW COURSE DETAILS</h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <label for="courseName">Course Name</label>
                                <div class="form-group">
                                    <input type="text" id="courseName" class="form-control" maxlength="255" placeholder="Enter course name" name="courseName" required>
                                </div>
                                <label for="languageId">Language</label>
                                <div class="form-group">
                                    <select id="languageId" class="form-control" name="languageId" required>
                                        <option value="">Select Language</option>
                                        <!-- Populate this dropdown with language options from your database -->
                                        <?php
                                        $language_query = "SELECT * FROM Languages";
                                        $language_result = mysqli_query($conn, $language_query);
                                        while ($row = mysqli_fetch_assoc($language_result)) {
                                            echo "<option value='" . $row['Id'] . "'>" . $row['LanguageName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="save">Add Course</button>
                                <a href="courses.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
</body>
</html>
