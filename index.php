<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myshop</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/myshop/create.php" role="button">New client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername="localhost";
                    $username="root";
                    $password="";
                    $databse="myshop";

                    //Create connection
                    $connection = new mysqli($servername, $username, $password, $databse);

                    //Check connection
                    if ($connection->connect_error) {
                       die("Connectoin Failed: " . $connection->connect_error);
                    }

                    //Read All raws from database table
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query:" . $connection->connect_error);
                    }

                    // check if there are any rows returned
                    if ($result->num_rows > 0) {

                    //read data of each raw
                    while($row = $result->fetch_assoc()) {
                        echo "
                             <tr>
                                <td>$row[id]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[phone]</td>
                                <td>$row[address]</td>
                                <td>$row[created_at]</td>
                                <td>
                                    <a class='btn btn-primary' href='/myshop/edit.php?id=$row[id]' role='button'>Edit</a>
                                    <a class='btn btn-danger' href='/myshop/delete.php?id=$row[id]' role='button'>Delete</a>
                                </td>
                            </tr> 
                        ";
                    }
                    } else {
                        echo "
                            <tr>
                                <td colspan='7' class='text-center'>No Data Available</td>
                            </tr>
                        ";

                        // Reset the auto-increment value to 1 when there are no rows in the table
                        $sql = "ALTER TABLE clients AUTO_INCREMENT = 1";
                        $connection->query($sql);
                        
                    }

                ?>
               
            </tbody>
        </table>
    </div>
</body>
</html>