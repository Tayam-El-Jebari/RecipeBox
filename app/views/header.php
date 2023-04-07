<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    Recipe Box
    <?php
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/main.css" rel="stylesheet">
  <link href="/css/footer.css" rel="stylesheet">
  <link href="/css/products/products.css" rel="stylesheet">
  <link href="/css/account/account.css" rel="stylesheet">
  <link href="/css/account/overview.css" rel="stylesheet">
  <link href="/css/cart/cart.css" rel="stylesheet">
  <link href="/css/home.css" rel="stylesheet">


</head>

<header>
  <nav class="navbar navbar-expand-lg navbar-light shadow p-3 mb-5 " id="navigation">
    <div class="container-fluid">
      <img src="/img/logo.png" alt="Recipe Box Logo" class="fill">

      <div class="navbar-collapse">

        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
        </ul>
        <div class="user-options ml-auto">
        <div class="option"><a href="/account"><i class="fa fa-user fa-2x"></i></a></div>
          <div class="option"><a href="/cart"><i class="fa fa-shopping-cart fa-2x"></i></a></div>
          <?php if (isset($_SESSION['userID']) ) { ?>
            <div class="option"><a onClick="logout()"><i class="fa fa-right-from-bracket fa-2x"></i></a></div><?php }  ?>
        </div>


      </div>
    </div>
  </nav>
  <div class="container-fluid" id="main-Content">
</header>