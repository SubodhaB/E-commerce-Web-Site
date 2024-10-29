
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toy Store - Home</title>
    <link rel="stylesheet" href="styles.css">
    <style>
 .about-container {
    padding: 20px;
    max-width: 700px;
    margin: auto;
}
.about-container h3 {
    margin-top: 20px;
}


      /* Define the slide-in keyframes */
      @keyframes slideIn {
    from {
        transform: translateX(-100%); /* Start off-screen to the left */
    }
    to {
        transform: translateX(0); /* End at its original position */
    }
}

/* Apply the slide-in animation to the logo */
.logo {
    animation: slideIn 2s ease-out forwards; /* Slide in over 2 seconds */
}

/* Define the fade-in keyframes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px); /* Optional: adds a slight upward motion */
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply the fade-in animation to each product-item */
.product-item {
    opacity: 0; /* Start invisible */
    animation: fadeIn 1s ease forwards; /* Fade in over 1 second */
    animation-delay: calc(0.2s * var(--item-index)); /* Delay each item */
}

/* Center the h2 element */
h2 {
    text-align: center;
    font-size: 2.5rem; /* Adjust size as needed */
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif; /* Use a modern font or custom web font */
    color: #333;
}

/* Define the animation keyframes */
@keyframes slideScale {
    0% {
        opacity: 0;
        transform: translateY(30px) scale(0.9); /* Start below and slightly smaller */
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1); /* End at normal size and position */
    }
}

/* Apply the animation */
h2 {
    animation: slideScale 1.2s ease-out forwards; /* Animate on load */
}

/* Cart button styles */
.cart-btn {
    display: inline-block;
    background-color: transparent; /* No background */
    border: none; /* Remove default link styling */
    padding: 5px; /* Adjust padding as needed */
    cursor: pointer; /* Pointer cursor */
}

.cart-btn img {
    width: 45px; /* Adjust size of cart icon */
    height: auto;
    transition: transform 0.2s ease;
}

.cart-btn:hover img {
    transform: scale(1.1); /* Slightly enlarge on hover */
}

.about-container {
    padding: 20px;
    max-width: 800px;
    margin: auto;
    text-align: center;
}

.photo-container {
    position: relative;
    overflow: hidden;
}

.big-photo {
    width: 100%;
    max-width: 100%;
    height: auto;
    opacity: 0;
    animation: fadeIn 2s forwards;
}

.small-photos {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}

.small-photo {
    width: 45%;
    max-width: 45%;
    height: auto;
    opacity: 0;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.slide-left {
    animation: slideInLeft 2s forwards;
}

.slide-right {
    animation: slideInRight 2s forwards;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

</style>
</head>
<body>
    <!-- Header Section -->
    <header style="padding: 20px;"> 
        <div class="logo">
            <img src="images/logo2.png" alt="Toy Store Logo">
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="contact.php">Contact us</a>
            <?php if (isset($_SESSION['username'])): ?>
                <div class="user-info" style="float: right;">
                    <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <a href="logout.php">Logout</a>

                </div>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                
                
            <?php endif; ?>
            
            <a href="cart.php" class="cart-btn">
    <img src="images/addcart1.png" alt="Cart Icon">
</a>

        </nav>
        
    </header>

    <div class="about-container">
    <h2>About Us</h2>
    <p>Welcome to Wonder Land! We are dedicated to providing high-quality toys that inspire creativity and bring joy to children of all ages.</p>

    <!-- Big Photo with Fade-In Animation -->
    <div class="photo-container">
        <img src="images/about1.jpg" alt="Our Team" class="big-photo fade-in">
    </div>

    <!-- Two Smaller Photos with Slide Animations -->
    <div class="small-photos">
        <img src="images/about2.jpg" alt="Our Workshop" class="small-photo slide-left">
        <img src="images/about3.jpg" alt="Our Products" class="small-photo slide-right">
    </div>
    
    <h3>Our Mission</h3>
    <p>To be the top choice for parents and guardians looking for safe, educational, and entertaining toys.</p>

    <h3>Our Story</h3>
    <p>Founded in 2024, we started as a small local store and have grown into an online platform serving families worldwide.</p>
</div>
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
            </a>
        </div>
    </footer>

    
    <script>
        //header scroller
 let lastScrollTop = 0;
        const header = document.querySelector('header');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Scroll Down
                header.style.top = '-100px'; 
            } else {
                // Scroll Up
                header.style.top = '0';
            }

            lastScrollTop = scrollTop;
        });
    </script>
</body>
</html>
