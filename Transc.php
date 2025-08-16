<?php
// filepath: c:\Users\ranji\OneDrive\Desktop\inter project\BanckingSystem-main\BanckingSystem-main\Transc.php
// DB connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "studuents";

$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_errno) {
    die("Database connection failed: " . $conn->connect_error);
}

// Query the transfer table for transaction history
$sql = "
SELECT 
    t.s_name AS sender_name,
    t.r_name AS receiver_name,
    t.amount,
    t.date_time AS t_date
FROM transfer t
ORDER BY t.date_time DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Internet Banking System</title>
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
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-bottom: 2rem;
            border-radius: 10px;
        }
        
        .transaction-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .transaction-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: center;
        }
        
        .transaction-info {
            text-align: center;
        }
        
        .transaction-info h4 {
            margin: 0 0 0.5rem 0;
            color: #333;
        }
        
        .transaction-info p {
            margin: 0.25rem 0;
            color: #666;
        }
        
        .amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .date {
            color: #666;
            font-size: 0.9rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        
        .table-responsive {
            width: 100%;
        }
        
        .table-responsive th,
        .table-responsive td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .table-responsive th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
        }
        
        .table-responsive tr:hover {
            background-color: #f8f9fa;
        }
        
        @media (max-width: 768px) {
            .transaction-details {
                grid-template-columns: 1fr;
            }
            
            .transaction-info {
                text-align: left;
            }
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
             <div class="top-nav-menu">
                 <a href="index.html" class="top-nav-link">Home</a>
                 <a href="view.php" class="top-nav-link">View Customers</a>
                 <a href="transc.php" class="top-nav-link">View Transactions</a>
                 <a href="transfer.php" class="top-nav-link">Transfer Money</a>
        </div>
    </nav>



    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Transaction History</h1>
            <p>View all completed transactions</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="table-container">
            <h2 class="mb-3">All Transactions</h2>
            
            <?php if ($result && $result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['sender_name']); ?></strong></td>
                            <td><strong><?php echo htmlspecialchars($row['receiver_name']); ?></strong></td>
                            <td class="amount">$<?php echo number_format($row['amount'], 2); ?></td>
                            <td class="date"><?php echo htmlspecialchars($row['t_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>No transactions found</h3>
                    <p>There are no transactions in the system yet.</p>
                </div>
            <?php endif; ?>
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
