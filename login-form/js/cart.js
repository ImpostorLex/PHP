var cartItems = [];


// Add item to cart

function addItem(name, image) {

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

    var myArray = [name, image];
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

    // Populate the table with cart items
    for (var i = 0; i < cartItems.length; i++) {
        var item = cartItems[i];

        var row = cartTable.insertRow();

        var titleCell = row.insertCell();
        titleCell.textContent = item[0]; // Get the name from the first element

        var descriptionCell = row.insertCell();
        descriptionCell.textContent = ""; // If there is no description available, leave it empty

        var imageCell = row.insertCell();
        var image = document.createElement("img");
        image.src = item[1]; // Get the image path from the second element
        image.style.width = "100px"; // Set the desired width of the image
        image.style.height = "100px"; // Set the desired height of the image
        imageCell.appendChild(image);

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
    removeButton.textContent = "Remove";
    removeButton.onclick = function () {
        removeItemFromCart(item[0]);
    };
    return removeButton;
}

