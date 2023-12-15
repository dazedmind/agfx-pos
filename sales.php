<?php
    session_start();

    $transactionSuccess = isset($_SESSION['transaction_success']) && $_SESSION['transaction_success'];
    unset($_SESSION['transaction_success']);
    
    if (!isset($_SESSION['username'])) {
        // Redirect the user to the login page or another page
        header('Location: login.php');
        exit(); // Make sure to exit after sending the header to stop script execution
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sales.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="img/fav-icon.png" type="image/x-icon">
    <title>Point of Sale System</title>
</head>
<body>
    <header>
        <h1>AGFX Printing Services - POS</h1>
        
        <ul class="navigation">
            <li class="nav-links">
                <a href="index.php">Home</a>
            </li>
            <li class="nav-links">
                <a href="sales.php">Revenue</a>
            </li>
            <li class="nav-links">
                <a href="about.html">
                    <i class="fa-solid fa-circle-question fa-xl"></i>
                </a>
            </li>
        </ul>
    </header>

    <main>
        <div class="transaction-header">
            <h1>Transaction List</h1>
            <form action="" method="post">
                <select name="select-month" id="select-month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                <select class="select-year" id="select-year" name="select-year" value="2024">
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                </select>
                <button type="submit" id="select-month-btn">Submit</button>
            </form>
        </div>


        <div class="transaction-list">
            <?php
            // Replace these variables with your actual database information
            $host = "localhost"; // Your database host
            $dbname = "pointofsale"; // Your database name
            $username = "root"; // Your database username
            $password = ""; // Your database password

            try {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get the selected month from the form
                    $selectedMonth = isset($_POST['select-month']) ? intval($_POST['select-month']) : null;
                    $selectedYear = isset($_POST['select-year']) ? intval($_POST['select-year']) : null;

                    if ($selectedMonth !== null) {
                        // Fetch transactions for the selected month and year
                        $stmt = $conn->prepare("SELECT * FROM pos_sales WHERE MONTH(transactionDate) = :selectedMonth OR YEAR(transactionDate) = :selectedYear");
                        $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_INT);
                        $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
                        $stmt->execute();
                        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
    
                        // Display transactions in a table
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Transaction Amount</th>';
                        echo '<th>Transaction Date</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($transactions as $transaction) {
                            echo '<tr>';
                            echo '<td>₱' . $transaction['totalAmount'] . '</td>';
                            echo '<td>' . $transaction['transactionDate'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
    
                        // Calculate the sum
                        $sum = array_sum(array_column($transactions, 'totalAmount'));
                        echo '<h2>Total Sales: ₱' . $sum . '</h2>';
                    } else {
                        echo '<p>Please select a month.</p>';
                    }
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>


    </main>
</body>
</html>