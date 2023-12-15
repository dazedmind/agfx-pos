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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="img/fav-icon.png" type="image/x-icon">
    <title>Point of Sale System</title>
</head>
<body>
    <input type="hidden" id="status" value="<?php echo isset($_SESSION['status']) ? $_SESSION['status'] : ''; ?>">

    <header>
        <h1>AGFX Printing Services - POS</h1>
        
        <ul class="navigation">
            <li class="nav-links">
                <a href="sales.php">Revenue</a>
            </li>
            <li class="nav-links">
                <a href="about.html">
                    <i class="fa-solid fa-circle-question fa-xl"></i>
                </a>
            </li>
            <form action="backend/logout.php">
                    <button id="logout-btn" type="submit">Log Out</button>
            </form>
        </ul>
   
    </header>

    <main>
        <div class="panel">
            <div id="normal">
                <h1 class="card-heading">Services</h1>
                <div class="services">
                    <div class="card">
                        <img class="card-img" src="img/bnw-print.png" alt="">
                        <h2>BNW PRINT </h2>
                        <p>₱10.00</p>
                        <button id="bnw-print" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/colored-print.png" alt="">
                        <h2>COLORED PRINT</h2>
                        <p>₱15.00</p>
                        <button  id="colored-print" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/package-a.png" alt="">
                        <h2>ID PACKAGE A</h2>
                        <p>₱65.00</p>
                        <button id="id-pkg-a" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/package-b.png" alt="">
                        <h2>ID PACKAGE B</h2>
                        <p>₱65.00</p>
                        <button id="id-pkg-b" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/editfee.png" alt="">
                        <h2>EDIT FEE</h2>
                        <p>₱15.00</p>
                        <button id="edit-fee"class="btn-selector">Select</button>
                    </div>
        
                    <div class="card">
                        <img class="card-img" src="img/colored-image.png" alt="">
                        <h2>COLORED - IMG</h2>
                        <p>₱25.00</p>
                        <button id="colored-img" class="btn-selector">Select</button>
                    </div>
        
                    <div class="card">
                        <img class="card-img" src="img/photocopy.png" alt="">
                        <h2>XEROX</h2>
                        <p>₱3.00</p>
                        <button id="photocopy" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/photocopy-b2b.png" alt="">
                        <h2>XEROX B2B</h2>
                        <p>₱6.00</p>
                        <button id="photocopy-b2b" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/lamination.png" alt="">
                        <h2>LAMINATION</h2>
                        <p>₱45.00</p>
                        <button id="lamination" class="btn-selector">Select</button>
                    </div>
        
                </div>
            </div>
            
            <div id="promo">
                <h1 class="card-heading">Student</h1>
                <div class="services">
                    <div class="card">
                        <img class="card-img" src="img/s-print.png" alt="">
                        <h2>BNW PRNT/XRX</h2>
                        <p>₱3.00</p>
                        <button id="promo-xerox" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/s-coloredprint.png" alt="">
                        <h2>COLORED PRINT</h2>
                        <p>₱5.00</p>
                        <button id="promo-print" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/s-coloredimage.png" alt="">
                        <h2>COLORED IMAGE</h2>
                        <p>₱10.00</p>
                        <button id="promo-image" class="btn-selector">Select</button>
                    </div>
                </div>
            </div>
            
            <div id="others">
                <h1 class="card-heading">Others</h1>
                <div class="services">
                    <div class="card">
                        <img class="card-img" src="img/gcash-in.png" alt="">
                        <h2>GCASH IN/OUT</h2>
                        <p>₱10.00</p>
                        <button id="gcash" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/short-brown.png" alt="">
                        <h2>SHORT ENVELOPE</h2>
                        <p>₱10.00</p>
                        <button id="short-brown" class="btn-selector">Select</button>
                    </div>
                    <div class="card">
                        <img class="card-img" src="img/long-brown.png" alt="">
                        <h2>LONG ENVELOPE</h2>
                        <p>₱15.00</p>
                        <button id="long-brown" class="btn-selector">Select</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" id="overlay"></div>

        <div class="popup" id="popup">
            <div class="more-info">
                <input type="number" name="product-code" id="product-code" hidden>

                <label for="number" style="font-weight: bold;">Enter Quantity</label>
                <input type="number" name="qty" id="qty" placeholder="0" value="1" min="1">

                <div class="popup-btn-container">
                    <button id="popup-btn" type="submit">OK</button>
                    <button id="cancel-btn">CANCEL</button>
                </div>
            </div>
        </div>

        <div class="cash-register" id="cash-register">
            <div class="more-info">
                <label for="cash-amount" style="font-weight: bold;">Enter Cash Amount</label>
                <input type="number" name="cash-amount" id="cash-amount" placeholder="100">

                <div class="popup-btn-container">
                    <button id="cash-confirm-btn">OK</button>
                    <button id="cash-cancel-btn">CANCEL</button>
                </div>
            </div>
        </div>

        <aside id="printable-content">
            <div class="side-panel">
                <h1>Total</h1>
                <div class="total-box" id="total-box">
                    <table border="0">
                        <thead>
                            <th>Product</th>
                            <th>Amount</th>
                            <th></th>
                        </thead>
                        <tbody id="total-table-body">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>
                    
                    <div class="grand-total-container">
                        <h2 id="grand-total">Grand Total:</h2>
                        <h3 id="amount-inserted"></h3>
                        <h3 id="change-display"></h3>
                    </div>

                    <div class="total-actions">
                        <button id="cash-btn"><i class="fa-regular fa-money-bill-1"></i> Insert Cash Amount</button>
                        <button id="clear-btn"><i class="fa-solid fa-times"></i> Clear Total</button>
                        <button id="print-btn"><i class="fa-solid fa-print"></i> Print</button>
                        <form id="save-form" action="backend/save_transaction.php" method="post">
                            <input type="number" name="grand-total-amount" id="grand-total-amount" hidden>
                            <button id="save-btn" type="submit"><i class="fa-regular fa-circle-check"></i> Done Transaction</button>
                        </form>
                    </div>

                </div>
            </div>
        </aside>
    </main>

    <script src="app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const saveBtn = document.getElementById('save-btn');
            const status = document.getElementById('status').value;
            const form = document.getElementById('save-form');

            <?php if ($transactionSuccess) : ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Transaction Successful!',
                    text: 'Your transaction has been saved successfully.',
                });
            <?php endif; ?>
        });

    </script>

</body>
</html>