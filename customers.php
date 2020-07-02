<?php 

//database config here
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/Customer.php');

//instantiatie customer
$customer = new Customer();


//get customer
$customers = $customer->getCustomers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>View Customers</title>
</head>
<body>
    <div class="container mt-4">
        <div class="btn-group" role="group">
            <a href="customers.php" class="btn btn-primary">Customers</a>
            <a href="transactions.php" class="btn btn-secondary">Transactions</a>
        </div>
        <hr>
        <h2>Customers</h2>
        
        <!--Table starts here-->
        <table class="table table-stripped">
            <thread>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thread>
            <tbody>
            <?php 
                foreach($customers as $cus): ?>
                    <tr>
                        <td><?php echo $cus->id; ?></td>
                        <td><?php echo $cus->first_name; ?>
                        <?php echo $cus->last_name; ?>
                        </td>
                        <td><?php echo $cus->email; ?></td>
                        <td><?php echo $cus->created_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            
            </tbody>
        </table>
        <br>
        <p><a href="index.php" class="btn btn-light mt-2">Go Back</a></p>
    </div>
    
</body>
</html>