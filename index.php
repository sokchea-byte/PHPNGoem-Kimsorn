<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IU_MD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table th,
        table td {
            vertical-align: middle;
            text-align: center;
        }

        .table td a {
            margin: 0 2px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>MD_CCMHF-Dashboard</h2>
            <a href="create.php" class="btn btn-success">Add New MD</a>
        </div>

        <?php
        $sql = "SELECT * FROM employees";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo '<table class="table table-bordered table-striped table-hover">';
                echo '<thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                    echo '<td>$' . number_format($row['salary'], 2) . '</td>';
                    echo '<td>
                        <a href="update.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">Edit</a>
                        <a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm delete-btn">Delete</a>
                      </td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
                mysqli_free_result($result);
            } else {
                echo '<div class="alert alert-warning text-center">No records found.</div>';
            }
        } else {
            echo '<div class="alert alert-danger text-center">Something went wrong. Please try again later.</div>';
        }

        mysqli_close($link);
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'តើអ្នកប្រាកដមែនទេ?',
                    text: "អ្នកមិនអាចត្រឡប់វិញបានទេ!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'លុបវា!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>

</body>

</html>