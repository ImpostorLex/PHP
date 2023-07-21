var cartItems = [];


// Add item to cart

function addItem(name, price, image) {

    var popupContainer = document.getElementById("cart-status");
    var statusElement = document.getElementById("show-stat");
    for (var i = 0; i < cartItems.length; i++) {
        var isItemExists = cartItems[i];
        if (isItemExists[0] === name) {
            var statusElement = document.getElementById("show-status");
            statusElement.innerHTML = "Item already exists in cart!";

            popupContainer.classList.add("active");
            return;
        }
    }

    var myArray = [name, price, image];
    cartItems.push(myArray);
    console.log(name);
    var statusElement = document.getElementById("show-status");
    statusElement.innerHTML = "Item successfully added!";

    popupContainer.classList.add("active");


}

function showCart() {
    var popup = document.getElementById("cart");
    popup.classList.toggle("active");

    var cartTable = document.getElementById("cartTable");

    // Clear existing rows from the table
    while (cartTable.rows.length > 1) {
        cartTable.deleteRow(1);
    }


    // Check if cart is empty
    if (cartItems.length <= 0) {
        var row = cartTable.insertRow();
        var emptyCell = row.insertCell();
        emptyCell.colSpan = 4; // Set the column span to cover all columns
        emptyCell.textContent = "Cart is currently empty";
        popup.classList.add("w-25");
        return;
    }

    // Populate the table with cart items
    for (var i = 0; i < cartItems.length; i++) {
        var item = cartItems[i];
        popup.classList.remove("w-25");

        var row = cartTable.insertRow();

        var titleCell = row.insertCell();
        titleCell.textContent = item[0]; // Get the name from the first element


        var priceCell = row.insertCell();
        priceCell.textContent = item[1];


        var imageCell = row.insertCell();
        var image = document.createElement("img");
        image.src = item[2]; // Get the image path from the third element
        image.style.width = "200px";
        image.style.height = "200px";
        imageCell.appendChild(image);


        var quantityCell = row.insertCell();
        var numberField2 = createNumberField(item);
        numberField2.style.width = "80px";
        numberField2.value = 1;
        quantityCell.appendChild(numberField2);

        var removeButtonCell = row.insertCell();
        var removeButton = createRemoveButton(item);

        // var removeButton = document.createElement("button");
        // removeButton.textContent = "Remove";
        // removeButton.onclick = function () {
        //     // Call the removeItemFromCart() function passing the necessary arguments
        //     removeItemFromCart(item[0]);
        // };
        removeButtonCell.appendChild(removeButton);
    }

}


function buyCart() {

    closePopup();
    closePopupCart();
    // Check if cart is empty
    if (cartItems.length > 0) {

        $(document).ready(function () {
            $('#successBuyModal').modal('show');
        });
        // Create a copy of the cart items 
        var itemsToRemove = cartItems.slice();

        // Clear the cart items array all at once
        // instead of calling the removeItemFromCart Function
        // one by one per loop
        cartItems = [];

        // Remove all items from the cart
        // cartItem duplicate is used instead to avoid clicking x
        // times the remove button per item in the cart.
        for (var i = 0; i < itemsToRemove.length; i++) {
            var item = itemsToRemove[i];
            removeItemFromCart(item[0]);
        }
    }
    else {
        $(document).ready(function () {
            $('#failBuyModal').modal('show');
        });
    }
}




function closePopup() {
    var popupContainer = document.getElementById("cart-status");
    popupContainer.classList.remove("active");

}


function closePopupCart() {
    var popupContainer = document.getElementById("cart");
    popupContainer.classList.remove("active");
}

function removeItemFromCart(name) {

    // Start at the end of the list of an array
    for (var i = 0; i < cartItems.length; i++) {

        // indexOf returns -1 if it can't find the match here we use not equals to -1
        // if it is true it means it found the value
        if (cartItems[i][0] === name) {
            console.log(cartItems[i][0]);
            console.log(name);
            console.log(i);
            cartItems = cartItems.filter(item => item[0] !== name);
            closePopupCart();
            showCart();
            return;
        }
    }

}
function createRemoveButton(item) {
    var removeButton = document.createElement("button");
    removeButton.classList.add('fa', 'fa-trash');
    removeButton.style.backgroundColor = "red";
    removeButton.onclick = function () {
        removeItemFromCart(item[0]);
    };
    return removeButton;
}

function createNumberField(item) {
    // Create a new number field element
    var numberField = document.createElement('input');
    numberField.type = 'number';

    // Set the minimum and maximum values for the number field
    numberField.min = 0; // Adjust this as per your requirements
    numberField.max = 999; // Adjust this as per your requirements

    // Set the minimum length of the number field
    numberField.minLength = 3;

    return numberField;

}




