<?php
require_once "config.php";

// Check if id is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete employee
    $sql = "DELETE FROM employees WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            // Success, redirect back to dashboard
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Error: Could not delete employee. Please try again.</div>";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "<div class='alert alert-warning text-center'>Invalid ID.</div>";
}

mysqli_close($link);
