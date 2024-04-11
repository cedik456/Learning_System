<?php
include_once 'db.php';

if(isset($_GET["id"])) {
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // Prepare the SQL statement to delete a user
        $sql = "DELETE FROM Users WHERE Id='" . $_GET["id"] . "'";
        
        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            // Close the database connection
            mysqli_close($conn);
            // Redirect back to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Display an error message if deletion fails
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Display a confirmation message before deleting a user
        echo '<script>
            if (confirm("Are you sure you want to delete this user?")) {
                // Redirect to confirm deletion
                window.location.href = "delete.php?id=' . $_GET['id'] . '&confirmed=true";
            } else {
                // Redirect back to dashboard
                window.location.href = "dashboard.php";
            }
        </script>';
    }
}
?>
