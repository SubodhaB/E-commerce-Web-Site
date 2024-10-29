<!-- contact.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toy Store - Home</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .contact-container {
    padding: 20px;
    max-width: 600px;
    margin: auto;
}
.contact-details p, .contact-form label {
    margin: 10px 0;
}
.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
}
.contact-form button {
    padding: 10px 20px;
    background-color: #333;
    color: white;
    border: none;
    cursor: pointer;
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
            <a href="about.php">About us</a>
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

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>If you have any questions, feel free to reach out to us.</p>
    
    <!-- Contact Details -->
    <div class="contact-details">
        <p><strong>Email:</strong> support@toysite.com</p>
        <p><strong>Phone:</strong> +123-456-7890</p>
        <p><strong>Address:</strong> 123 Toy Street, Toy City, Country</p>
    </div>

    <!-- Contact Form -->
    <form action="process_contact.php" method="post" class="contact-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
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
