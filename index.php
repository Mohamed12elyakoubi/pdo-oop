<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="navbar.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            background-color: #021027;
        }

        .container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .background {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            width: 100%;
            height: 100%;
            mask-image: radial-gradient(white 0%, white 30%, transparent 80%, transparent);
        }

        .circle-container {
            position: absolute;
            transform: translateY(-10vh);
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        .circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            mix-blend-mode: screen;
            background-image: radial-gradient(hsl(180, 100%, 80%), hsl(180, 100%, 80%) 10%, hsla(180, 100%, 80%, 0) 56%);
            animation: fade-frames 200ms infinite, scale-frames 2s infinite;
        }

        @keyframes fade-frames {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes scale-frames {
            0% {
                transform: scale3d(0.4, 0.4, 1);
            }

            50% {
                transform: scale3d(2.2, 2.2, 1);
            }

            100% {
                transform: scale3d(0.4, 0.4, 1);
            }
        }

        .message {
            position: absolute;
            right: 20px;
            bottom: 10px;
            color: white;
            font-family: "Josefin Slab", serif;
            line-height: 27px;
            font-size: 18px;
            text-align: right;
            pointer-events: none;
            animation: message-frames 1.5s ease 5s forwards;
            opacity: 0;
        }

        @keyframes message-frames {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<nav>
"<ul class='nav nav-pills nav-justified'>" +
        "<li class='nav-item'><a class='nav-link' href='./klant/klant-overzicht.php'>klanten</a></li>" 
        "<li class='nav-item'><a class='nav-link' href='./product/product-overzicht.php'>producten</a></li>" 
        "<li class='nav-item'><a class='nav-link' href='./reservering/reservering-overzicht.php'>reserveringen</a></li>" 
        "<li class='nav-item'><a class='nav-link' href='./restaurant/tafel-overzicht.php'>tafels</a></li>" 
        "<li class='nav-item'><a class='nav-link' href='./rekening/bestelling-overzicht.php'>Bestellingen</a></li>" 
        "</ul>";
</nav>
<div class="container">
    <img class="background" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/221808/sky.jpg" />
    <p class="message">all your dreams can come true<br>if you have the courage to pursue them</p>
</div>

<script>
    // Generate circle containers with circles
    const container = document.querySelector('.container');
    const numContainers = 50; // Define the number of circle containers

    for (let i = 0; i < numContainers; i++) {
        const circleContainer = document.createElement('div');
        circleContainer.classList.add('circle-container');

        const circle = document.createElement('div');
        circle.classList.add('circle');

        circleContainer.appendChild(circle);
        container.appendChild(circleContainer);
    }
</script>

</body>
</html>
