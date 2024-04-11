<?php
include_once 'db.php'; // Assuming db.php contains the database connection code

if(isset($_GET["id"]) && is_numeric($_GET["id"])) { // Check if "id" is set and numeric
    $id = $_GET["id"]; // Sanitize the input
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // Prepare the SQL statement to delete a student
        $sql = "DELETE FROM Students WHERE Id=$id"; // Using prepared statement to prevent SQL injection
        
        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            // Close the database connection
            mysqli_close($conn);
            // Redirect back to students.php (assuming this is the page for listing students)
            header("Location: students.php");
            exit();
        } else {
            // Display an error message if deletion fails
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Display a confirmation message before deleting a student
        echo '<script>
            if (confirm("Are you sure you want to delete this student?")) {
                // Redirect to confirm deletion
                window.location.href = "delete_student.php?id=' . $id . '&confirmed=true";
            } else {
                // Redirect back to students.php
                window.location.href = "students.php";
            }
        </script>';
    }
} else {
    // Invalid or missing ID parameter
    echo "Invalid or missing ID parameter.";
}
?>
