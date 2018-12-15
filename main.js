/* CART SCRIPTS */
//var cart = cart || [];
//var cartName = cartName || [];
var cart = new Array();
var cartName = new Array();

//add item to cart function
function cartAdd(itemID) {
    cart.push(itemID);
    if (itemID == 1) {
        cartName.push('Double Cheeseburger');
    } else if (itemID == 2) {
        cartName.push('Premium Salad');
    } else if (itemID == 3) {
        cartName.push('Chicken McNuggets');
    } else if (itemID == 4) {
        cartName.push('Apple Pie');
    } else if (itemID == 5) {
        cartName.push('Egg McMuffin');
    } else if (itemID == 6) {
        cartName.push('Happy Meal');
    } else {
        cartName.push('NotInDatabase Item');
    }
    updateLabel();
    updateStorage();
    var itemName = cartName.slice(-1)[0];
    alert(itemName + ' was added to cart.');
}

//remove last item from array
function removeLast() {
    cart.pop();
    cartName.pop();
    updateLabel();
    updateStorage();
}

//clear all item in cart
function removeAll() {
    if (confirm('WE DOING THIS?!')) {
        cart = [];
        cartName = [];
        updateLabel();
        updateStorage();
        alert('Cart emptied.');
    } else {
        alert("Good boy!");
    }
}

//update the label
function updateLabel() {
    var x = cartName.join('<br>');
    document.getElementById("cart-item").innerHTML = x;
}

//update information to localstorage: called by store page
function updateStorage() {
    localStorage.setItem("cart", JSON.stringify(cart));
    localStorage.setItem("cartName", JSON.stringify(cartName));
}

//retrieve cart info from localstorage: called by cart page
function retrieveStorage() {
    cart = JSON.parse(localStorage.getItem("cart"));
    cartName = JSON.parse(localStorage.getItem("cartName"));
}

/* PASS JS CART TO PHP */
function buyCart() {
    var r = confirm("Proceed to buy all items currently in cart?");
    if (r == true) {
        retrieveStorage();
        $.ajax({
            type: "POST",
            url: "purchase.php",
            data: {
                "id": 1,
                "cart": JSON.stringify(cart)
            },
            success: function (data) {
                output = JSON.stringify(data);
                $('#output').html(output);
            }
        });
        alert("Thanks for your patronage!");
    }
}

/* HOMEPAGE SLIDESHOW SCRIPTS */
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

/* w3school's include html function */
function includeHTML() {
    var z, i, elmnt, file, xhttp;
    //loop through a collection of all HTML elements:
    z = document.getElementsByTagName("*");
    for (i = 0; i < z.length; i++) {
        elmnt = z[i];
        //search for elements with a certain atrribute:
        file = elmnt.getAttribute("w3-include-html");
        if (file) {
            //make an HTTP request using the attribute value as the file name:
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        elmnt.innerHTML = this.responseText;
                    }
                    if (this.status == 404) {
                        elmnt.innerHTML = "Page not found.";
                    }
                    //remove the attribute, and call this function once more:
                    elmnt.removeAttribute("w3-include-html");
                    includeHTML();
                }
            }
            xhttp.open("GET", file, true);
            xhttp.send();
            //exit the function:
            return;
        }
    }
}

/* account deletion button troll */
function delet() {
    if (document.getElementById("delet").innerHTML == '') {
        document.getElementById("delet").innerHTML = 'no account deletion for now';
    } else if (document.getElementById("delet").innerHTML == 'no account deletion for now') {
        document.getElementById("delet").innerHTML = 'omg didn\'t you read';
    } else if (document.getElementById("delet").innerHTML == 'omg didn\'t you read') {
        document.getElementById("delet").innerHTML = 'ok whatever';
    } else {
        document.getElementById("delet").innerHTML = '';
    }
}

/* account deletion button troll */
function comingSoon() {
    alert('that store is coming soon™️');
}