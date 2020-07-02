<?php 

//database config here
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/Transaction.php');

//instantiatie customer
$transaction = new Transaction();


//get customer
$transactions = $transaction->getTransactions();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>View Transactions</title>
</head>
<body>
    <div class="container mt-4">
        <div class="btn-group" role="group">
            <a href="customers.php" class="btn btn-secondary">Customers</a>
            <a href="transactions.php" class="btn btn-primary">Transactions</a>
        </div>
        <hr>
        <h2>Transactions</h2>
        
        <!--Table starts here-->
        <table class="table table-stripped">
            <thread>
                <tr>
                    <th>Transaction ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thread>
            <tbody>
            <?php 
                foreach($transactions as $trans): ?>
                    <tr>
                        <td><?php echo $trans->id; ?></td>
                        <td><?php echo $trans->customer_id; ?> </td>                  
                        <td><?php echo $trans->product; ?></td>
                        <td><?php echo sprintf('%.2f', $trans->amount/100); ?>
                        <?php echo strtoupper('Ghc') ?>
                        </td>
                        <td><?php echo $trans->created_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            
            </tbody>
        </table>
        <br>
        <p><a href="index.php" class="btn btn-light mt-2">Go Back</a></p>
    </div>
    
</body>
</html>