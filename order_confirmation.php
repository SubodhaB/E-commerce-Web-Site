<!-- order_confirmation.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Prevent scrollbar */
            background-color: #ddebfc; /* background to highlight stars */
        }

        .star {
            position: absolute;
            top: -50px; /* Start above the screen */
            width: 20px;
            height: 20px;
            background-color: #c2140c;
            clip-path: polygon(
                50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 
                50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%
            ); /* Star shape */
            animation: drop 5s linear infinite;
            opacity: 0.8;
        }

        @keyframes drop {
            0% {
                top: -50px;
                transform: rotate(0deg);
            }
            100% {
                top: 100vh; /* Drop to the bottom of the screen */
                transform: rotate(360deg); /* Full rotation */
            }
        }

        /* Generating multiple stars with different sizes and timings */
        .star:nth-child(1) { left: 10%; width: 15px; height: 15px; animation-delay: 0s; }
        .star:nth-child(2) { left: 25%; width: 25px; height: 25px; animation-delay: 1s; }
        .star:nth-child(3) { left: 40%; width: 20px; height: 20px; animation-delay: 2s; }
        .star:nth-child(4) { left: 60%; width: 30px; height: 30px; animation-delay: 3s; }
        .star:nth-child(5) { left: 80%; width: 18px; height: 18px; animation-delay: 4s; }

        .order-confirmation {
            text-align: center; /* Centers the text and link */
            margin-top: 50px; /* Adds some space from the top */
        }

        .order-confirmation h2,
        .order-confirmation p {
            margin-bottom: 20px; /* Adds spacing between the elements */
        }

        .order-confirmation a {
            display: inline-block; /* Ensures padding works well on the link */
            text-decoration: none; /* Removes underline from the link */
        }


    </style>
</head>
<body>
     <!-- Falling Stars -->
     <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <header>
        <h1>Order Confirmation</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <section>
    <div class="order-confirmation">
    <h1>Thank you for your order!</h1>
    <p>Your order has been placed successfully. You will receive a confirmation email shortly.</p>
    <a href="track_order.php" style="color: white; background-color: green; padding: 10px; border-radius: 5px;">Track Your Order</a>
    <a href="profile.php">View Purchase History</a></p>

</div>


    </section>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    <!-- Footer Section -->
    <footer>
        <div class="footer-copyright">
            <p>&copy; 2024 Wonder Land. All rights reserved | Bringing Joy to Every Child | BY SUBODHA BANDARA</p>
        </div>
        <div class="footer-social">
            <a href="https://web.facebook.com/subodha.bandara.1/" target="_blank">
                <img src="images/fb.png" alt="Facebook">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="images/Insta.png" alt="Instagram">
            </a>
            <a href="number.html" target="_blank">
                <img src="images/wp.png" alt="WhatsApp">
    
</body>
</html>
