<?php

$servername="localhost";
$username="root";
$password="";
$databse="myshop";

//Create connection
$connection = new mysqli($servername, $username, $password, $databse);

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if ( empty($name) || empty($email) || empty($phone) || empty($address) )
        {
            $errorMessage = "All the fields are required!";
            break;
        }
        // add a New Client to database

        $sql = "INSERT INTO clients (name, email, phone, address)" . " VALUES ('$name', '$email', '$phone', '$address')";
        // $result = $connection->query($sql);
        $result = "";

        try {
            $result = $connection->query($sql); 
        } 
        catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { 
        $errorMessage = "Invalid Query: This email address is already registered!";
        } else {
                $errorMessage = "Invalid Query: " . $e->getMessage();
            }
        }

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }
 

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client Added Successfully !";   // Success Message after Successfully Submit input and new client add

        header("location: /myshop/index.php");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New client</h2>

        <?php

        // For Display Error Message in Page using Bootstrap()
        if ( !empty($errorMessage) ) {
            // Shows ErrorMessage with Alert-Box in Page ( Using Bootstrap(Dismissing in alert section) )
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
               <strong> $errorMessage </strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            

            <!-- Inputs Uisng Bootstrap -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-table">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-table">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo$email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-table">Phone</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-table">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <!-- For Display Success Message in Page using Bootstrap()    -->
             
             <?php
             if ( !empty($successMessage) ) {
                echo "
                    <div class = 'row mb-3'>
                        <div class = 'offset-sm-3 col-sm-3 d-grid'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                ";
             }
             ?>
            
             <!-- Submit and Cancel Buttons Using Bootstrap -->
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</body>
</html>