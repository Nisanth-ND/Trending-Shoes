<?php
include "e-com.php";
session_start();

$user_id = $_SESSION['id'];

if (isset($_POST['buy'])) {

    $product_id = $_POST['product_id'];

    $conn->query("DELETE FROM cart
                  WHERE user_id = '$user_id'
                  AND product_id = '$product_id'");

    header("Location: cart.php?success=1");
    exit();

}

if (isset($_POST['remove'])) {

    $product_id = $_POST['product_id'];

    $conn->query("DELETE FROM cart
                  WHERE user_id = '$user_id'
                  AND product_id = '$product_id'");

    header("Location: cart.php");
    exit();
}

if (isset($_POST['increase'])) {

    $product_id = $_POST['product_id'];

    $conn->query("UPDATE cart
                  SET quantity = quantity + 1
                  WHERE user_id = '$user_id'
                  AND product_id = '$product_id'");

    header("Location: cart.php");
    exit();
}

if (isset($_POST['decrease'])) {

    $product_id = $_POST['product_id'];

    $check = $conn->query("SELECT quantity
                           FROM cart
                           WHERE user_id = '$user_id'
                           AND product_id = '$product_id'");

    $cart = $check->fetch_assoc();

    if ($cart['quantity'] > 1) {

        $conn->query("UPDATE cart
                      SET quantity = quantity - 1
                      WHERE user_id = '$user_id'
                      AND product_id = '$product_id'");

    } else {

        $conn->query("DELETE FROM cart
                      WHERE user_id = '$user_id'
                      AND product_id = '$product_id'");

    }

    header("Location: cart.php");
    exit();
}

$result = $conn->query("SELECT cart.*, products.*
                        FROM cart
                        JOIN products
                        ON cart.product_id = products.id
                        WHERE cart.user_id = '$user_id'");        
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Trending Shoes </title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="main-body">

<?php
if(isset($_GET['success'])){
?>
<script>

alert("Purchase Successfully!");

// URL-la irukkura ?success=1 remove pannum
window.history.replaceState({}, document.title, "cart.php");

</script>

<?php
}
?>


<div class="container mt-5">

    <h2 class="text-center mb-5" style="color:white;">
        <i class="fa-solid fa-cart-shopping fa-sm " style="color: rgb(255, 155, 59);"></i>
        My Cart
    </h2>


    <?php
    $total = 0;
    ?>


    <div class="row">

        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card mb-4 shadow-sm">

    <div class="row g-0 align-items-center">

        <!-- Image -->
        <div class="col-md-3 text-center p-3">

            <img src="<?php echo $row['image']; ?>"
                 class="img-fluid"
                 style="height:180px; object-fit:contain;">

        </div>

        <!-- Product Details -->
        <div class="col-md-6">

            <div class="card-body">

                <h4><?php echo $row['title']; ?></h4>

                <p><?php echo $row['description']; ?></p>

    
<?php
$subtotal = $row['price'] * $row['quantity'];

$total += $subtotal;
?>

<p class="mb-1">
    <strong>Price :</strong>
    <span class="text-success">
        ₹<?php echo $row['price']; ?>
    </span>
</p>

<p class="mb-3">
    <strong>Subtotal :</strong>
    <span style="color: orange;">
        ₹<?php echo $subtotal; ?>
    </span>
</p>



    <div class="d-flex align-items-center gap-2">

    <!-- Minus -->
    <form method="POST">

        <input type="hidden"
               name="product_id"
               value="<?php echo $row['product_id']; ?>">

        <button
            type="submit"
            name="decrease"
            class="btn btn-danger"
            onclick="return confirmDecrease(<?php echo $row['quantity']; ?>)">
        
            -

        </button>

    </form>

    <!-- Quantity -->
    <strong style="font-size:20px;">
        <?php echo $row['quantity']; ?>
    </strong>

    <!-- Plus -->
    <form method="POST">

        <input type="hidden"
               name="product_id"
               value="<?php echo $row['product_id']; ?>">

        <button
            type="submit"
            name="increase"
            class="btn btn-success">

            +

        </button>

    </form>

</div>


</div>
    </div>
    <!-- Right Side -->
        <div class="col-md-3 text-center">

    <form method="POST" class="mb-2">

    <input
        type="hidden"
        name="product_id"
        value="<?php echo $row['product_id']; ?>">

    <button
        type="submit"
        name="buy"
        class="btn btn-success w-50"
        onclick="return confirmBuy()">
        Buy
    </button>

   </form>
            
    <form method="POST">
        <input type="hidden"
            name="product_id"
            value="<?php echo $row['product_id']; ?>">
            
        <button
           type="submit"
           name="remove"
           class="btn btn-danger w-50"
           onclick="return confirm('Are you sure you want to remove this product from your cart?')">
            Remove
        </button>
    </form>

        </div>
    </div>
</div>
    <?php } ?>


    <div class="card shadow-lg p-4 mt-4">

    <div class="d-flex justify-content-between align-items-center">

        <h4>Grand Total</h4>

        <h3 class="text-success">
            ₹<?php echo $total; ?>
        </h3>

    </div>

</div>


<div class="text-center mt-4 mb-5">

    <a href="product.php" class="btn btn-primary btn-lg">
        <i class="fa-solid fa-arrow-left"></i>
        Continue Shopping
    </a>

</div>  


    </div>
</div>


<script>
function confirmDecrease(quantity){

    if(quantity == 1){

        return confirm("Quantity is 1.\nDo you want to remove this product from your cart?");

    }

    return true;

}
function confirmBuy(){

    return confirm("Do you want to buy this product?");

}
</script>

</body>
</html>