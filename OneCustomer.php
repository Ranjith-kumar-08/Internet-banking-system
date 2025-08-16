<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studuents";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$acc_number = $_POST['acc_number'] ?? '';
if (empty($acc_number)) {
    die("Account number is required");
}

$stmt = $conn->prepare("SELECT * FROM customer WHERE Acc_Number = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $acc_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Customer not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details - Internet Banking System</title>
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
        .customer-details-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .customer-details-card:hover {
            transform: translateY(-2px);
        }
        .customer-details-card:hover {
            transform: translateY(-2px);
        }
        
        .customer-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            align-items: center;
        }
        
        .customer-info h3 {
            margin: 0 0 0.5rem 0;
            color: #333;
        }
        
        .customer-info p {
            margin: 0.25rem 0;
            color: #666;
        }
        
        .customer-actions {
            margin-top: 1.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .balance-display {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin: 1rem 0;
        
        }
        .text-center{
            text-align: center;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-label {
            font-weight: 600;
            color: #333;
        }
        
        .detail-value {
            color: #666;
        }
        
        @media (max-width: 768px) {
            .customer-info {
                grid-template-columns: 1fr;
            }
            
            .customer-actions {
                text-align: center;
            }
        }
            
            .btn-primary, .btn-secondary {
                display: block;
                width: 100%;
                margin: 0.5rem 0;
            }
            .page-header{
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;

            }
            .btn-btn-primary{
            background: whitesmoke;
            color:black;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .btn-btn-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .options {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
            gap: 1rem;
        }
        .text-center-left {
            text-align: left;
            margin-bottom: 1.5rem;
        }
        .footer-container {
    width: 100%;
    color: white;
    padding: 10px 0;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    background-color: #333;
    margin-top:0;
    margin-bottom: 0;
    height: 80px;
    align-items: center;       
}
    
        
        
    </style>
</head>
<body>
    <!-- Navigation -->
   <nav class="top-nav">
        <div class="container">
             <div class="top-nav-menu">
                 <a href="index.html" class="top-nav-link">Home</a>
                 <a href="view.php" class="top-nav-link">View Customers</a>
                 <a href="transc.php" class="top-nav-link">View Transactions</a>
                 <a href="transfer.php" class="top-nav-link">Transfer Money</a>
            </div>
        </div>
    </nav>
    
    <!-- Page Header -->
    <section class="page-header">
            <h1>Customer Details</h1>
            <p>View customer information and account details</p>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="customer-details-card">
            <h2 class="text-center-left">Customer Information</h2>
            
            <div class="customer-info">
                <div>
<h3><?php echo htmlspecialchars($row['Name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                    <div class="detail-item">
                        <span class="detail-label">Account Number:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($row['Acc_Number'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($row['Email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Phone:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($row['Phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Address:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($row['Address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
                
                <div>
                    <div class="balance-display">
                        $<?php echo number_format($row['Balance'] ?? 0, 2); ?>
                    </div>
                    <p class="text-center">Current Balance</p>
                </div>
            </div>
            <div class="options">
                <form method="post" action="transfer.php" style="display: inline;">
                    <input type="hidden" name="sender_acc" value="<?php echo htmlspecialchars($row['Acc_Number']); ?>">
                    <button type="submit" class="btn-btn-primary">Transfer Money</button>
                </form>
                <a href="view.php" class="btn-btn-primary">Back to Customers</a>
            </div>
        </div>
    </div>
</body>
     <!-- Footer -->
    <footer class="footer-container">
        <p>&copy; 2024 Internet Banking System. All rights reserved ,</p>
            <!-- Social Media Links -->
      
    <span>Made by Ranjith Kumar</span>
      <a href="https://www.linkedin.com/in/ranjith-kumar-m-339490275" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-linkedin" viewBox="0 0 16 16">
            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
        </svg>
    </a>
    <a href="https://github.com/Ranjith-kumar-08" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-github" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
        </svg>
    </a>            
    </footer>
</html>
<?php
$conn->close();
?>
