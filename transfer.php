<?php
session_start();
$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password,"studuents");
if(!$con){
    die("Connection failed");
} 

$flag=false;

if (isset($_POST['transfer'])) {
    $sender_acc = $_POST['sender_acc'];
    $receiver_acc = $_POST['reciever_acc'];
    $amount = $_POST['amount'];

    // Get sender's balance and name
    $sql = "SELECT Balance, Name FROM customer WHERE Acc_Number='$sender_acc'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sender_balance = $row["Balance"];
        $sender_name = $row["Name"];
        if($amount > $sender_balance || $sender_balance - $amount < 100){
            echo "<div class='alert alert-error'>Transaction Denied: Insufficient Balance</div>";
            exit();
        } else {
            // Deduct from sender
            $sql = "UPDATE customer SET Balance = Balance - $amount WHERE Acc_Number = '$sender_acc'";
            if ($con->query($sql) === TRUE) {
                $flag = true;
            } else {
                echo "Error in updating record: " . $con->error;
            }
        }
    } else {
        echo "Sender not found";
        exit();
    }

    // Add to receiver
    if($flag == true){
        $sql = "UPDATE customer SET Balance = Balance + $amount WHERE Acc_Number = '$receiver_acc'";
        if ($con->query($sql) !== TRUE) {
            echo "Error in updating record: " . $con->error;
            $flag = false;
        }
    }

    // Get receiver's name
    if($flag == true){
        $sql = "SELECT Name FROM customer WHERE Acc_Number='$receiver_acc'";
        $result = $con->query($sql);
        $receiver_name = "";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $receiver_name = $row["Name"];
        }
        // Insert into transfer table
        $sql = "INSERT INTO transfer (s_name, s_acc_no, r_name, r_acc_no, amount) VALUES ('$sender_name', '$sender_acc', '$receiver_name', '$receiver_acc', '$amount')";
        if (!$con->query($sql)) {
            echo "Error updating record: " . $con->error;
        }
    }

    if($flag == true){
        echo "<div style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); max-width: 500px; margin: 20px auto; text-align: center;'>
                <div style='font-size: 48px; margin-bottom: 15px;'>✅</div>
                <h3 style='margin: 0 0 20px 0; font-size: 28px; font-weight: bold; color: #fff;'>Transaction Successful!</h3>
                <div style='background: rgba(255,255,255,0.2); padding: 20px; border-radius: 10px; margin: 20px 0;'>
                    <p style='margin: 8px 0; font-size: 16px;'><strong>💰 Amount Transferred:</strong> <span style='color: #90EE90; font-weight: bold;'>₹".number_format($amount, 2)."</span></p>
                    <p style='margin: 8px 0; font-size: 16px;'><strong>📤 From Account:</strong> <span style='color: #FFD700;'>".$sender_acc."</span></p>
                    <p style='margin: 8px 0; font-size: 16px;'><strong>📥 To Account:</strong> <span style='color: #FFD700;'>".$receiver_acc."</span></p>
                    <p style='margin: 8px 0; font-size: 14px;'><strong>🕐 Date & Time:</strong> <span style='color: #E0E0E0;'>".date('d-m-Y H:i:s')."</span></p>
                </div>
                <p style='margin: 20px 0; font-size: 16px; color: #E0E0E0;'>Thank you for using our banking services!</p>
            </div>";
        
        // Enhanced action buttons with better styling
        echo "<div style='text-align: center; margin-top: 30px;'>
                <a href='transfer.php' style='display: inline-block; margin: 10px; padding: 12px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 25px; font-weight: bold; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: transform 0.3s ease;'>Make Another Transfer</a>
                <a href='Transc.php' style='display: inline-block; margin: 10px; padding: 12px 30px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; text-decoration: none; border-radius: 25px; font-weight: bold; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: transform 0.3s ease;'>View Transaction History</a>
              </div>
              <style>
                a:hover {
                    transform: translateY(-2px);
                }
              </style>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money - Internet Banking System</title>
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .top-nav {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .top-nav-menu {
            max-width: 600px;
            padding: 0;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            list-style: none;
        }
        .top-nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .top-nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 600px;
            width: 90%;
            margin: 0 auto 2rem;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            flex-direction: column;
            align-items: center;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            width: 100%;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .alert {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 4px;
            text-align: center;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }
            
            .top-nav-menu {
                gap: 1rem;
            }
            
            .top-nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
      <!-- Navigation -->
<nav class="top-nav">
             <div class="top-nav-menu">
                 <a href="index.html" class="top-nav-link">Home</a>
                 <a href="view.php" class="top-nav-link">View Customers</a>
                 <a href="transc.php" class="top-nav-link">View Transactions</a>
                 <a href="transfer.php" class="top-nav-link">Transfer Money</a>
        </div>
    </nav>
     <div class="container">
    <!-- Main Content -->
        <h1>Transfer Money</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="sender_acc">Sender Account Number</label>
                <input type="text" id="sender_acc" name="sender_acc" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reciever_acc">Receiver Account Number</label>
                <input type="text" id="reciever_acc" name="reciever_acc" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount to Transfer</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>
            <button type="submit" name="transfer" class="btn">Transfer</button>
        </form>
    </div>
</body>
</html>
