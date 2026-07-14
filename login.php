<?php 
include "e-com.php";
session_start();

$message = "";

if (isset($_POST['submit'])) {   
    $name = $_POST['name'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE name = '$name'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if($password == $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            header("Location: product.php");
            exit();
            }
         else {
            $message = "❌ Wrong Password!";
        }
    }   
    else {
        $message = "❌ User not found!";
    }   
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Trending Shoes </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #1f1f1f;">

<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4 text-center" style="width: 25rem;">
<h2 class="mb-4"> LOGIN </h2>

<form method="POST">
    <input placeholder="Name" type="text" class="form-control" name="name" required> <br><br>
    <input placeholder="Password" type="password" class="form-control" name="password" required> <br><br>

    <button class="btn btn-success mb-3" type="submit" name="submit"> Login </button> <br><br>

    <?php if (!empty($message)) { 
        echo "<p class='error'>  $message </p>";
    } ?>
</form>

    </div>
</div>
</body>
</html>