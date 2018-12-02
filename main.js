/* cart processing scripts */
var cart = [];
var cartName = [];
//add item to cart function
function cartAdd(itemID) {
    //push itemID retrieved from button into array
    cart.push(itemID);
    if (itemID == 3) {
        cartName.push('Double Cheeseburger');
    } else if (itemID == 4) {
        cartName.push('Premium Salad');
    } else if (itemID == 5) {
        cartName.push('Chicken McNuggets');
    } else if (itemID == 6) {
        cartName.push('Apple Pie');
    } else if (itemID == 7) {
        cartName.push('Egg McMuffin');
    } else if (itemID == 8) {
        cartName.push('Happy Meal');
    } else { cartName.push('Invalid Item'); }
}

//remove last item from cart
function cartRemove() {
    cart.pop();
    cartName.pop();
}

//display cart items in a label and store to localStorage
function cartDisplay() {
    //convert array into JSON and insert into localStorage
    localStorage["cart"] = JSON.stringify(cart);
    localStorage["cartName"] = JSON.stringify(cartName);
    //convert cartName array to string
    var list = cartName.join('<br>');
    //display it to customer in cart log
    document.getElementById("cart-item").innerHTML = list;
}

/* main page slides processing scripts */
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
    } else { document.getElementById("delet").innerHTML = ''; }
}