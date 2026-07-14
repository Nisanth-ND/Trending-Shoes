<?php
include "e-com.php";
session_start();

if (isset($_POST['add'])) {

    $user_id = $_SESSION['id'];

    $product_id = $_POST['product_id'];

    $check = $conn->query("SELECT * FROM cart
                       WHERE user_id = '$user_id'
                       AND product_id = '$product_id'");

    if ($check->num_rows > 0) {
    $conn->query("UPDATE cart
              SET quantity = quantity + 1
              WHERE user_id = '$user_id'
              AND product_id = '$product_id'");
    } else {
      $conn->query("INSERT INTO cart (user_id, product_id, quantity)
                    VALUES ('$user_id', '$product_id', 1)");
    }

    header("Location: product.php#products");
    exit();

}
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <title> Trending Shoes   </title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body class="main-body">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">

    <!-- Logo + Website Name -->
    <a class="navbar-brand d-flex align-items-center" href="product.php">
      <i class="fa-solid fa-shoe-prints fa-xl me-2" style="color: rgb(255, 155, 59);"></i>
      <span class="fw-bold fs-4">Trending Shoes</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Right Side -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

      <ul class="navbar-nav align-items-center">

        <li class="nav-item">
          <a class="nav-link active" href="product.php"> Home </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#aboutModal">
            About
          </a>
        </li>

        <li class="nav-item ms-3">
          <a class="nav-link" href="cart.php">
            <i class="fa-solid fa-cart-shopping fa-xl" style="color: rgb(255, 155, 59);"></i>
          </a>
        </li>

      </ul>

    </div>

  </div>
</nav>


<div class="modal fade" id="aboutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"> About Trending Shoes </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p>
          Welcome to <b>Trending Shoes</b>! We offer stylish and comfortable
          footwear including Sports, Formal, Casual, Boots, Loafers, and
          Sneakers at affordable prices.
        </p>
      </div>

    </div>
  </div>
</div>


<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="shoe-1-ban.png" class="d-block w-100" alt="shoe banner">
    </div>

    <div class="carousel-item">
      <img src="shoe-2-ban.png" class="d-block w-100" alt="shoe banner">
    </div>

    <div class="carousel-item">
      <img src="shoe-3-ban.png" class="d-block w-100" alt="shoe banner">
    </div>

    <div class="carousel-item">
      <img src="shoe-4-ban.png" class="d-block w-100" alt="shoe banner">
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
    <span class="visually-hidden"> Previous </span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"> Next </span>
  </button>

</div>


<div class="container mt-5" id="products">
  <div class="row">

    <div class="col-md-4">
      <div class="card product-card">
        <img src="sports-shoe.png" class="card-img-top" alt="product-1">

        <div class="card-body text-center">
          <h5 class="card-title"> Sports </h5>
          <p class="card-text">
            Experience unmatched comfort and performance with our premium Sports Shoe.
            Designed for running, gym workouts, and daily activities with lightweight cushioning.
            Its breathable mesh upper keeps your feet cool, while the durable sole
            provides excellent grip and stability on every step.
          </p>

          <h5 class="text-success fw-bold"> ₹2,999 </h5>

          <form method="POST">
            <input type="hidden" name="product_id" value="1">

          <button type="submit" name="add" class="btn btn-primary">
            <i class="fa-solid fa-cart-shopping fa-xs" style="color: rgb(255, 155, 59);"></i>
              Add to Cart
          </button>
          </form>

        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card product-card">
        <img src="formals-shoe.png" class="card-img-top" alt="product-2">

        <div class="card-body text-center">
          <h5 class="card-title"> Formals </h5>
          <p class="card-text">
            Crafted from premium-quality leather for a sophisticated and elegant look.
            Perfect for office meetings, business events, and special occasions.
            The soft cushioned insole offers all-day comfort, while the durable outsole
            ensures long-lasting performance with timeless style.
          </p>

          <h5 class="text-success fw-bold"> ₹3,499 </h5>

          <form method="POST">
            <input type="hidden" name="product_id" value="2">

          <button type="submit" name="add" class="btn btn-primary">
            <i class="fa-solid fa-cart-shopping fa-xs" style="color: rgb(255, 155, 59);"></i>
              Add to Cart
          </button>
          </form>

        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card product-card">
        <img src="casuals-shoe.png" class="card-img-top" alt="product-3">

        <div class="card-body text-center">
          <h5 class="card-title"> Casuals </h5>
          <p class="card-text">
            Upgrade your everyday style with these trendy Casual Shoes.
            Designed for maximum comfort and effortless fashion, they pair perfectly
            with jeans, joggers, or shorts. Lightweight construction and a flexible sole
            make them ideal for daily wear and weekend outings.
          </p>

          <h5 class="text-success fw-bold"> ₹2,499 </h5>

          <form method="POST">
            <input type="hidden" name="product_id" value="3">

          <button type="submit" name="add" class="btn btn-primary">
            <i class="fa-solid fa-cart-shopping fa-xs" style="color: rgb(255, 155, 59);"></i>
              Add to Cart
          </button>
          </form>

        </div>
      </div>
    </div>

  </div>
</div>


<div class="container mt-5">
  <div class="row">

    <div class="col-md-4">
      <div class="card product-card">
        <img src="boots-shoe.png" class="card-img-top" alt="product-4">

        <div class="card-body text-center">
          <h5 class="card-title"> Boots </h5>
          <p class="card-text">
            Built for adventure, these premium Boots offer exceptional durability and comfort.
            while the high-quality material provides excellent ankle support and protection for
            outdoor activities and all-weather performance.
          </p>

          <h5 class="text-success fw-bold"> ₹4,599 </h5>

          <form method="POST">
            <input type="hidden" name="product_id" value="4">

          <button type="submit" name="add" class="btn btn-primary">
            <i class="fa-solid fa-cart-shopping fa-xs" style="color: rgb(255, 155, 59);"></i>
              Add to Cart
          </button>
          </form>

        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card product-card">
        <img src="loafers-shoe.png" class="card-img-top" alt="product-5">

        <div class="card-body text-center">
          <h5 class="card-title"> Loafers </h5>
          <p class="card-text">
            Step into effortless elegance with our stylish Loafers.
            Featuring a slip-on design, premium finish, and soft cushioned footbed,
            they provide outstanding comfort for office wear, casual meetings,
            and everyday sophistication without compromising on style.
          </p>

          <h5 class="text-success fw-bold"> ₹2,799 </h5>

          <form method="POST">
            <input type="hidden" name="product_id" value="5">

          <button type="submit" name="add" class="btn btn-primary">
            <i class="fa-solid fa-cart-shopping fa-xs" style="color: rgb(255, 155, 59);"></i>
              Add to Cart
          </button>
          </form>

        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card product-card">
        <img src="sneakers-shoe.png" class="card-img-top" alt="product-6">

        <div class="card-body text-center">
          <h5 class="card-title"> Sneakers </h5>
          <p class="card-text">
            Stay ahead of the trend with these modern Sneakers designed for everyday comfort.
            The lightweight build, breathable material, and stylish design make them
            perfect for college, travel, and casual outings while delivering
            excellent support throughout the day.
          </p>

          <h5 class="text-success fw-bold"> ₹3,299 </h5>

          <form method="POST">
            <input type="hidden" name="product_id" value="6">

          <button type="submit" name="add" class="btn btn-primary">
            <i class="fa-solid fa-cart-shopping fa-xs" style="color: rgb(255, 155, 59);"></i>
              Add to Cart
          </button>
          </form>

        </div>
      </div>
    </div>

  </div>
</div>

</body>
</html>