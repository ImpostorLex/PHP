<!DOCTYPE html>
<html>

<head>
    <title>Responsive Pop-up Example</title>
    <script src="js/cart.js"></script>

    <style>
        .popup-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            text-align: center;
            width: 400px;
            border-radius: 8px;
            font-family: "Helvetica", sans-serif;
            line-height: 1.5;

        }

        .popup-container button {
            border-radius: 4px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }


        .popup-container.active {
            display: block;
        }

        .container {
            width: 100%;
            background-color: lightgray;
            padding: 20px;
            box-sizing: border-box;
        }

        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
        }

        /* code for cards */
        .card {
            width: 300px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 20px;
            box-sizing: border-box;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-description {
            font-size: 14px;
            color: #888;
            margin-bottom: 20px;
        }

        .buy-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Show pop-up error message design  */
        .popup-container2 {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            text-align: center;
            width: 400px;
            filter: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            text-align: center;
            width: 400px;
        }


        .popup-container2.active {
            display: block;
        }
    </style>

</head>

<body>
    <button class="icon-button" onclick="showCart()">
        <i class="fa-solid fa-cart-shopping"> Your Cart</i>
    </button>

    <div class="container">
        <h1>Full Width Container</h1>
        <p>This container spans the entire width of the screen.</p>
    </div>

    <div class="container">
        <h1>Full Width Container</h1>
        <p>This container spans the entire width of the screen.</p>
    </div>


    <div class="container">
        <h1>Full Width Container</h1>
        <p>This container spans the entire width of the screen.</p>
    </div>


    <div class="container">
        <h1>Full Width Container</h1>
        <p>This container spans the entire width of the screen.</p>
    </div>


    <!-- Probably this will be populated by Jinja or static adding of cards -->
    <div class="card">
        <h2 class="card-title">Product 1</h2>
        <img src="img/robber.png" style="width:25%">
        <p class=" card-description">This is a sample description for Product 1.</p>
        <button class="buy-button" onclick="addItem('Product1', 'img/robber.png')">Buy</button>
    </div>

    <div class="card">
        <h2 class="card-title">Product 2</h2>
        <img src="img/text.png" style="width:25%">
        <p class="card-description">This is a sample description for Product 2.</p>
        <button class="buy-button" onclick="addItem('Product2', 'img/text.png')">Buy</button>
    </div>

    <div class="card">
        <h2 class="card-title">Product 3</h2>
        <img src="img/text.png" style="width:25%">
        <p class="card-description">This is a sample description for Product 3.</p>
        <button class="buy-button" onclick="addItem('Product3', 'img/text.png')">Buy</button>
    </div>

    <div id="cart" class="popup-container">
        <table id="cartTable">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </table>
        <button onclick="closePopupCart()">Close</button>
    </div>


    <!-- Need implement when pop-up appears it is unclickable. -->
    <div id="cart-status" class="popup-container2">
        <p id="show-status"></p>
        <button onclick="closePopup()">Close</button>
    </div>



</body>

</html>