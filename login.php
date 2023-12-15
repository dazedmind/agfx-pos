<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
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
    </header>

    <main>
        <div class="login-box">
            <h1>Log-In</h1>
            <form class="login-form" action="backend/logindb.php" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <button type="submit" id="login-btn">Log In</button>
            </form>
        </div>            
    </main>
</body>
</html>