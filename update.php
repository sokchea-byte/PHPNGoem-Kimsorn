<?php
require_once "config.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM employees WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $address = $row['address'];
            $salary = $row['salary'];
        } else {
            echo "No record found.";
            exit();
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Invalid ID.";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssdi", $name, $address, $salary, $id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Something went wrong. Please try again.";
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update md_ccmhf</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Update md_ccmhf</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"
                                value="<?php echo htmlspecialchars($address); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="number" step="0.01" name="salary" class="form-control"
                                value="<?php echo $salary; ?>" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update">
                        <!-- <a href="index.php" class="btn btn-secondary">Cancel</a> -->
                    </form>

                </div>
                <style>
                    /* General Container Styling */
                    .container {
                        max-width: 800px;
                        padding: 20px;
                        margin-top: 20px;
                    }

                    /* Row spacing */
                    .row.justify-content-center {
                        margin-bottom: 20px;
                    }

                    /* Card Styling */
                    .card {
                        border: none;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        transition: box-shadow 0.3s ease;
                    }

                    .card:hover {
                        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
                    }

                    .card-header {
                        background-color: #f8f9fa;
                        border-bottom: 1px solid #dee2e6;
                        font-weight: bold;
                        color: #495057;
                        padding: 15px 20px;
                        border-radius: 10px 10px 0 0;
                        text-align: center;
                        font-size: 1.25rem;
                    }

                    .card-body {
                        padding: 30px;
                    }

                    /* Form Styling */
                    .form-label {
                        font-weight: 500;
                        color: #495057;
                        margin-bottom: 8px;
                    }

                    .form-control {
                        border-radius: 5px;
                        border: 1px solid #ced4da;
                        padding: 12px;
                        transition: border-color 0.3s ease, box-shadow 0.3s ease;
                        font-size: 1rem;
                    }

                    .form-control:focus {
                        border-color: #007bff;
                        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                        outline: none;
                    }

                    /* Form spacing */
                    .mb-3 {
                        margin-bottom: 20px;
                    }

                    /* Button Styling */
                    .btn-primary,
                    .btn-secondary {
                        border-radius: 5px;
                        padding: 10px 20px;
                        font-weight: 500;
                        width: 100%;
                        transition: background-color 0.3s ease, transform 0.2s ease;
                    }

                    .btn-primary {
                        background-color: #007bff;
                        border-color: #007bff;
                    }

                    .btn-primary:hover {
                        background-color: #0056b3;
                        border-color: #0056b3;
                        transform: translateY(-1px);
                    }

                    .btn-primary:active {
                        transform: translateY(0);
                    }

                    /* Responsive Adjustments */
                    @media (max-width: 768px) {
                        .container {
                            padding: 10px;
                            margin-top: 10px;
                        }

                        .card-body {
                            padding: 20px;
                        }

                        .card-header {
                            padding: 12px 15px;
                            font-size: 1.1rem;
                        }

                        .btn-primary,
                        .btn-secondary {
                            padding: 12px;
                        }
                    }

                    /* Reduced Motion Support */
                    @media (prefers-reduced-motion: reduce) {
                        * {
                            animation-duration: 0.01ms !important;
                            animation-iteration-count: 1 !important;
                            transition-duration: 0.01ms !important;
                        }
                    }
                </style>
            </div>
        </div>
    </div>