<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b5d820a994.js" crossorigin="anonymous"></script>
    <script src="js/cart.js"></script>
</head>

<body>


    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">KantoFoods</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <button class="borderless-button" onclick="showCart()">
                            <i class="fa-solid fa-cart-shopping"> Cart</i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class=" mx-2" href="#section2"><i class="fas fa-bell pe-2"></i>About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class=" mx-2" href="#section3"><i class="fa-solid fa-utensils"></i>&nbsp; Products</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" style="background-color:#cdc4bc" href="#!">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pb-3">
        <div class="row">
            <div class="col-12">
                <img src="imgs/main-bg.png" class="img-fluid mx-auto d-block" alt="Your Image">
            </div>
        </div>
    </div>

    <div class="container-md" id="section2" style="background-color: ;">
        <h1 class="text-center pb-5">Why choose KantoFoods</h1>

        <div class="row justify-content-center">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mx-auto card-bg" style="width: 20rem; height:22rem;">
                    <img src="imgs/truck.png" style="width: 7rem;" class="mx-auto pt-2" alt="truck-kun">
                    <div class="card-body">
                        <h5 class="card-title text-center">Fast Delivery</h5>
                        <p class="card-text text-center">Our commitment to swift delivery ensures that your orders reach
                            you promptly, so you can enjoy your products without delay.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mx-auto card-bg" style="width: 20rem; height:22rem;">
                    <img src="imgs/leaf.png" style="width: 7rem;" class="mx-auto pt-2" alt="truck-kun">
                    <div class="card-body">
                        <h5 class="card-title text-center">Always Fresh</h5>
                        <p class="card-text text-center">We take pride in offering only the freshest products, sourced
                            with care and delivered to your doorstep, guaranteeing a delightful experience with each
                            purchase.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mx-auto card-bg" style="width: 20rem; height:22rem;">
                    <img src="imgs/customer-service.png" style="width: 7rem;" class="mx-auto pt-2" alt="truck-kun">
                    <div class="card-body">
                        <h5 class="card-title text-center">Best Customer Support</h5>
                        <p class="card-text text-center">Our dedicated customer support team is here to assist you every
                            step of the way, providing exceptional service and ensuring your satisfaction is our top
                            priority.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-md mt-5 text-center" id="section3" style="background-color:#cdc4bc; border-radius: 15px;">
            <h1 class="card-title pt-5" style="color:black;font-weight:900">Our Products</h1>
            <div class="row mt-3">

                <div class="col-lg-4 mb-4">
                    <div class="card card-bg">
                        <img src="imgs/main-bg.png" class="card-img-top" style="width: 22rem;" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Product 1</h5>
                            <p class="card-text">Price: $9.99</p>
                            <div class="row">
                                <div class="col">
                                    <input type="number" min="1" value="1" class="form-control">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 mb-4">
                    <div class="card card-bg">
                        <img src="imgs/main-bg.png" class="card-img-top" style="width: 22rem;" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Product 2</h5>
                            <p class="card-text">Price: $19.99</p>
                            <div class="row">
                                <div class="col">
                                    <input type="number" min="1" value="1" class="form-control">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 mb-4">
                    <div class="card card-bg">
                        <img src="imgs/main-bg.png" class="card-img-top" style="width: 22rem;" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Product 3</h5>
                            <p class="card-text">Price: $29.99</p>
                            <div class="row">
                                <div class="col">
                                    <input type="number" min="1" value="1" class="form-control">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="card-title pt-5" style="color:black;font-weight:900">Our Products</h1>


            </div>
        </div>

        <div class="container my- pb-5">

            <footer class="text-center text-lg-start mt-xl-5 pt-4" style="background-color:black; border-radius: 15px;">

                <div class="container p-4">

                    <div class="row">

                        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                            <h5 class="text-uppercase text-white mb-4">Social Media</h5>

                            <ul class="list-unstyled mb-4">
                                <li>
                                    <a href="#!" class="text-white">Facebook</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Instagram</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Twitter</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Youtube</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                            <h5 class="text-uppercase mb-4">Page Links</h5>

                            <ul class="list-unstyled">
                                <li>
                                    <a href="#!" class="text-white">Why Us!</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Products</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                            <h5 class="text-uppercase mb-4 text-white text-bold">Sign up to our newsletter</h5>


                            <form method="POST" action="backend.php" class="needs-validation">
                                <input type="hidden" name="formIdentifier" value="form10">

                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="form5Example2" id="form5Example2" class="form-control" />
                                    <label class="form-label text-light" for="form5Example2">Email address</label>
                                </div>

                                <button type="submit" class="btn btn-block"
                                    style="background-color:#cdc4bc">Subscribe</button>
                            </form>
                        </div>

                    </div>

                </div>

            </footer>

        </div>


        <!-- Pop-up design -->
        <div id="cart" class="popup-container">
            <table id="cartTable">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>

                </tr>
            </table>
            <button onclick="closePopupCart()">Close</button>
        </div>


        <?php
        if (isset($_GET['i_e'])) {
            $msg = $_GET['i_e'];
            if ($msg == 'ss') {
                echo "<script type='text/javascript'>
            $(document).ready(function(){
$('#successModal').modal('show');
});
            </script>";
            } else if ($msg == 'alreadyS') {
                echo "<script type='text/javascript'>
            $(document).ready(function(){
$('#failureModal2').modal('show');
});
            </script>";
            } else if ($msg == 'e_f') {
                echo "<script type='text/javascript'>
            $(document).ready(function(){
$('#failureModal1').modal('show');
});
            </script>";
            }
        }
        ?>

        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Subscription....</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-success">is successful!</strong>, from now on keep watch on your email
                        inbox.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="failureModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Subscription....</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-warning">is unsuccessful!</strong>, because you are already subscribed!

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="failureModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Subscription....</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-warning">is unsuccessful!</strong> server error probably.
                        inbox.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>
</body>

</html>