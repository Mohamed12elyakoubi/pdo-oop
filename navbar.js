document.addEventListener("DOMContentLoaded", function () {
    let nav =
        "<ul class='nav nav-pills nav-justified'>" +
        "<li class='nav-item'><a class='nav-link' href='../klant/klant-overzicht.php'>klanten</a></li>" +
        "<li class='nav-item'><a class='nav-link' href='../product/product-overzicht.php'>producten</a></li>" +
        "<li class='nav-item'><a class='nav-link' href='../reservering/reservering-overzicht.php'>reserveringen</a></li>" +
        "<li class='nav-item'><a class='nav-link' href='../restaurant/tafel-overzicht.php'>tafels</a></li>" +
        "<li class='nav-item'><a class='nav-link' href='../rekening/bestelling-overzicht.php'>Bestellingen</a></li>" +
        "</ul>";
    document.getElementById("navbar").innerHTML = nav;

    var messageElement = document.querySelector('.alert');
    if (messageElement) {
        setTimeout(function () {
            messageElement.style.display = 'none';
        }, 4000);
    }
    
    });
    
