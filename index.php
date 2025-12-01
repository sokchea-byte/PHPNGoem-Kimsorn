<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CUS_PHP-Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="text">PHP-Dashboard</h1>
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <br>
                        <a href="create.php" class="btn btn-success btn-sm">Add New CUS_PHP</a>
                    </div>
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * FROM employees";
                        if ($result = mysqli_query($link, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-striped table-hover">';
                                echo '<thead class="thead-dark">
                                    <tr>
                                    <th>#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Salary</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $row['id'] . '</th>';
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
                        <style>
                            th,
                            td {
                                text-align: center;
                                vertical-align: top;
                                padding: 8px 12px;

                            }

                            .table-striped tbody tr:nth-of-type(even) {
                                background-color: rgba(0, 0, 0, 0.05);
                            }

                            .table-striped tbody tr:nth-of-type(odd) {
                                background-color: rgba(0, 0, 0, 0.05);
                            }

                            .table-hover tbody tr:hover {
                                background-color: rgba(0, 0, 0, 0.1);

                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(function (button) {
            button.addEventListener('click', function (e) {
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