<?php include "e-com.php";

$error = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $check = $conn->query("SELECT id FROM users WHERE email = '$email'");

    if ($check->num_rows > 0) {
        $error = "This email is already registered. Please use another email.";
    } else {
        $conn->query("INSERT INTO users (name, password, email)
                  VALUES ('$name', '$password', '$email')");
                  
        header("Location: login.php");
        exit();
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

<h2 class="mb-4"> REGISTER </h2> <br>

<form method="POST">
    <input placeholder="Name" type="text" class="form-control" name="name" required><br><br>
    <input placeholder="Password" type="password" class="form-control" name="password" required><br><br>
    <input placeholder="Email" type="email" class="form-control" name="email" required><br><br>

    <button class="btn btn-primary mb-3" type="submit" name="submit"> Sign up </button>

    <p class="error"><?php echo $error; ?></p>
</form>
    </div>
</div>

</body>
</html>