<?php
include("auth_session.php");

require_once "db.php"; // Include your database connection

if(isset($_POST['save'])) {
    $languageName = $_POST['language_name'];

    // Update query to update the language record
    $sql = "UPDATE Languages SET LanguageName='$languageName' WHERE Id='" . $_POST['id'] . "'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Language has been updated.")</script>';
        echo "<script>window.location.href ='languages.php'</script>";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Fetch the existing language data to pre-fill the form fields for update
if(isset($_GET['id']) && $_GET['id'] != '') {
    $languageId = $_GET['id'];
    $languageQuery = mysqli_query($conn, "SELECT * FROM Languages WHERE Id = $languageId");
    if(!$languageQuery) {
        die("Query failed: " . mysqli_error($conn));
    }
    $languageData = mysqli_fetch_assoc($languageQuery);
} else {
    // Handle the case where no language ID is provided
    echo "Error: Language ID is missing!";
    exit; // Exit the script
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Language Form | Admin Panel</title>
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
                <h2>LANGUAGE FORM</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UPDATE LANGUAGE
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <label for="language_name">Language Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="language_name" class="form-control" maxlength="255" placeholder="Enter language name" name="language_name" value="<?php echo $languageData['LanguageName']; ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $languageData['Id']; ?>"/>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="languages.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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
