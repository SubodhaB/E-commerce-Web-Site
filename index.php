<?php
include 'connection.php';  
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toy Store - Home</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Style for the pop-up ad */
        .popup-ad {
            position: fixed;
            right: 50px;
            bottom: 450px; /* Adjust this value to position it from the bottom */
            width: 250px; /* Width of the ad */
            background-color: #f9f9f9;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            padding: 15px;
            z-index: 1000; /* Ensure it appears on top */
            display: none; /* Initially hidden */
        }

        .popup-ad img {
            width: 100%;
            height: auto;
        }

        .popup-ad .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
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
/* Admin button styles */
.admin-btn {
    display: inline-block;
    background-color: #27ae60;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.admin-btn:hover {
    background-color: #2ecc71;
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
            <a href="contact.php">Contact us</a>
            <a href="about.php">About us</a>
            <?php if (isset($_SESSION['username'])): ?>
                <div class="user-info" style="float: right;">
                    <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <a href="logout.php">Logout</a>
                </div>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                
                <a href="admin_login.php" class="admin-btn">Admin</a>
            <?php endif; ?>
            
            <a href="cart.php" class="cart-btn">
    <img src="images/addcart1.png" alt="Cart Icon">
</a>

        </nav>
        
    </header>

    <!-- Main Section -->
    <section>
        <h2>Featured Toys</h2>
        <div class="product-grid">
    <?php
    $query = "SELECT * FROM products ORDER BY created_at DESC"; 
    $result = $conn->query($query);

    if ($result->num_rows > 0):
        $index = 0; // Initialize index
        while ($row = $result->fetch_assoc()):
    ?>
        <div class="product-item" style="--item-index: <?php echo $index++; ?>;">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="product-img">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><?php echo number_format($row['price'], 2); ?> USD</p>
            <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
        </div>
    <?php
        endwhile;
    else:
        echo "<p>No products available.</p>";
    endif;
    ?>
</div>

    </section>

    <!-- Pop-up Ad Section -->
    <div class="popup-ad" id="popupAd">
        <span class="close-btn" id="closeAd">&times;</span>
        <img src="images/ad.jpg" alt="Advertisement">
        <p>Check out our special offers!</p>
        <a href="special-offers.php" class="btn">See Offers</a>
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

    <!-- JavaScript for Pop-up Ad -->
    <script>
        // Display the pop-up ad after a delay
        setTimeout(function() {
            document.getElementById('popupAd').style.display = 'block';
        }, 5000); // 3-second delay

        // Close the pop-up ad when the close button is clicked
        document.getElementById('closeAd').onclick = function() {
            document.getElementById('popupAd').style.display = 'none';
        };

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
