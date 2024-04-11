<?php
include_once 'db.php'; // Assuming db.php contains the database connection code

if(isset($_GET["id"]) && is_numeric($_GET["id"])) { // Check if "id" is set and numeric
    $id = $_GET["id"]; // Sanitize the input
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // Prepare the SQL statement to delete a course
        $sql = "DELETE FROM Courses WHERE Id=?"; // Using prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Close the statement
            mysqli_stmt_close($stmt);
            // Close the database connection
            mysqli_close($conn);
            // Redirect back to courses.php (assuming this is the page for listing courses)
            header("Location: courses.php");
            exit();
        } else {
            // Display an error message if deletion fails
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Display a confirmation message before deleting a course
        echo '<script>
            if (confirm("Are you sure you want to delete this course?")) {
                // Redirect to confirm deletion
                window.location.href = "delete_course.php?id=' . $id . '&confirmed=true";
            } else {
                // Redirect back to courses.php
                window.location.href = "courses.php";
            }
        </script>';
    }
} else {
    // Invalid or missing ID parameter
    echo "Invalid or missing ID parameter.";
}
?>
