<?php

// echo 'Submitted!';

require_once('vendor/autoload.php');
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/Customer.php');
require_once('models/Transaction.php');
\Stripe\Stripe::setApiKey('sk_test_51Gye3FDYBdStWNsW8L7VsznquotwY3PcyiGFT7dWOaxmm6WeAB7Z8MAksiACxpM8x0cyhZg3QyBPHknQYCEkcGHN007QHV7tWH');

// $stripe = new \Stripe\StripeClient('sk_test_51Gye3FDYBdStWNsW8L7VsznquotwY3PcyiGFT7dWOaxmm6WeAB7Z8MAksiACxpM8x0cyhZg3QyBPHknQYCEkcGHN007QHV7tWH');
// $customer = $stripe->customers->create([
//     'description' => 'example customer',
//     'email' => 'email@example.com',
//     'payment_method' => 'pm_card_visa',
// ]);
// echo $customer;

//Filter post array to prevent hacking
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

//create customer in stripe
$customer =  \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token
));

//bill customer
$charge = \Stripe\Charge::create(array(
    "amount" => 5000,
    "currency" => "usd",
    "description" => "Intro to Progamming - Module 1",
    "customer" => $customer->id
));

//customer Data variable
//loading data from form
$transactionData = [
    'id' => $charge->id,
    'customer_id' => $charge->customer,
    'product'=> $charge->description,
    'amount'=> $charge->amount,
    'currency' => $charge->currency,
    'status'=> $charge->status
];
//instantiate transaction class object
$transaction = new Transaction();

//add transaction to DB
$transaction->addTransaction($transactionData);



//transaction Data variable
//loading data from form
$customerData = [
    'id' => $charge->customer,
    'first_name'=> $first_name,
    'last_name'=> $last_name,
    'email'=> $email
];

//instantiate customer object
$customer = new Customer();

//add customer to DB
$customer->addCustomer($customerData);

// print_r($charge);

//Redirect Successful transaction
header('Location: success.php?tid=' .$charge->id.'&product='.$charge->description);