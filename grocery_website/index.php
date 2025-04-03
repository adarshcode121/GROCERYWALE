<?php
session_start();
include "./Nav/Manu.php";
include "config.php"; // Ensure database connection is included

// Check if the user is logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_address = "";
// header('Location:index.php?alert=Please login First !');


// Fetch user address if logged in
if ($user_id) {
    $user_query = mysqli_query($conn, "SELECT address FROM users WHERE id = '$user_id'");
    if ($user_data = mysqli_fetch_assoc($user_query)) {
        $user_address = $user_data['address'];
    }
}

// Fetch parent categories
$categories = $conn->query("SELECT * FROM parent_categories");
// Fetch all products
$items = $conn->query("SELECT * FROM items ORDER BY RAND() LIMIT 10");

// Handle Add to Cart (only for logged-in users)
if ($user_id && isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_weight = $_POST['product_weight'];
    $product_offer = $_POST['product_offer'];
    $product_old_price = $_POST['product_old_price'];
    $product_quantity = 1;
    $total_price = $product_price * $product_quantity;

    // Check if the product is already in the cart
    $check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE u_id = '$user_id' AND name = '$product_name'");

    if (mysqli_num_rows($check_cart) > 0) {
        echo "<script>alert('Product is already in your cart.');</script>";
    } else {
        $insert_cart = mysqli_query($conn, "INSERT INTO cart (u_id, image, offer, name, weight, price, old_price, total_price, quantity, address) 
            VALUES ('$user_id', '$product_image', '$product_offer', '$product_name', '$product_weight', '$product_price', '$product_old_price', '$total_price', '$product_quantity', '$user_address')");

        if ($insert_cart) {
            echo "<script>alert('Product added to cart.');</script>";
        } else {
            echo "<script>alert('Failed to add product to cart!');</script>";
        }
    }
}
?>
<style>
    /* .category-section{
        border: 2px solid grey ;
        border-radius: 20px;
    } */

    /* .category-item{
        display: flex;
        gap: 200px;
    } */
    /* body{
        background-color: rgb(233, 227, 227);
    } */

    .category-section {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        /* Adjust this value as needed */
        justify-content: center;
        /* Center align items */
        padding-right: 20px;
    }

    .category-item {
        text-align: center;
        padding: 8px;
        /* Optional for spacing around items */
    }


    .product-container {
        border: 2px solid  rgb(241, 245, 235);
        border-radius: 20px;
    }



    /* css for product container  */

    .product-container {
        background-color: rgb(241, 245, 235);
        display: flex;
        flex-wrap: wrap;
        /* Ensure products wrap correctly */
        gap: 20px;
        /* Space between products */
        justify-content: flex-start;
        /* Align products from the start */
    }

    .product-card {
        width: calc(20% - 20px);
        /* Ensure exactly 5 products per row */
        min-width: 200px;
        /* Maintain minimum width */
        box-sizing: border-box;
        /* Include padding and border in width */
        text-align: center;
        /* Center align content */
        flex-grow: 1;
        /* Ensures alignment when fewer than 5 products are present */
        max-width: 20%;
        /* Prevents stretching */
    }

    @media (max-width: 1024px) {
        .product-card {
            width: calc(20% - 20px);
            /* Still maintain 5 products per row */
            max-width: 20%;
        }
    }

    @media (max-width: 768px) {
        .product-card {
            width: calc(20% - 20px);
            /* Ensure 5 products per row */
            max-width: 20%;
        }
    }

    @media (max-width: 480px) {
        .product-card {
            width: calc(20% - 20px);
            /* Even on small screens, keep 5 per row */
            max-width: 20%;
        }
    }

    .category-image{
        border-radius: 20px;
        /* border: 2px solid black ; */
        overflow: hidden;
    }

      /* Chatbot Icon Styling */
      .chatbot-icon {
        position: fixed;
        right: 20px;
        bottom: 20px;
        width: 60px;
        height: 60px;
        background-color:rgb(0, 98, 255);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
    .chatbot-icon img {
        width: 40px;
        height: 40px;
    }
   
</style>

<!-- Category Section -->
<div class="container">
    <div class="category full-width">
        <!-- <a href="product.php"><img src="./img/Group-33704.webp" alt="Paan Corner" class="category-image"></a> -->
        <a href="product.php"><img src="./Ad_img/bnr1.png" alt="Fruit & Vegitable" class="category-image"></a>
        <a href="product.php"><img src="./Ad_img/bnr2.png" alt="Paan Corner" class="category-image"></a>
    </div>
</div>
<!-- 
<div class="parent-div">
    <div class="child-div">
        <a href="product.php"><img src="./img/Pet-Care_WEB.avif" alt="Pet-Care"></a>
    </div>
    <div class="child-div">
        <a href="product.php"><img src="./img/pharmacy-WEB.avif" alt="pharmacy"></a>
    </div>
    <div class="child-div">
        <a href="product.php"><img src="./img/babycare-WEB.avif" alt="babycare"></a>
    </div>
</div> -->

<!-- Category Section -->
<div class="category-section">
    

    <?php while ($parent = $categories->fetch_assoc()) : ?>
        <div class="category-item">
            <a href="Child_products.php?parent_id=<?= $parent['id'] ?>">
                <img src="./C-items/<?= $parent['image'] ?>" alt="<?= $parent['name'] ?>">
            </a>
        </div>

    <?php endwhile; ?>
</div>

<!-- Products Section -->
<div class="product-container">
    <?php if ($items->num_rows > 0) : ?>
        <?php while ($item = $items->fetch_assoc()) : ?>
            <div class="product-card">
                <?php if (!empty($item['offer'])) : ?>
                    <div class="offer-label"><?= $item['offer'] ?></div>
                <?php endif; ?>
                <img src="./p-item/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <h3><?= $item['name'] ?></h3>
                <p class="weight">
                    <?= !empty($item['weight']) ? str_replace(',', ' | ', $item['weight']) : 'N/A' ?>
                </p>
                <div class="price-container">
                    <p class="price">₹<?= $item['price'] ?></p>
                    <?php if (!empty($item['old_price'])) : ?>
                        <p class="old-price">₹<?= $item['old_price'] ?></p>
                    <?php endif; ?>
                </div>
                <!-- Add to Cart Form -->
                <form action="" method="post">
                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="product_name" value="<?= $item['name'] ?>">
                    <input type="hidden" name="product_price" value="<?= $item['price'] ?>">
                    <input type="hidden" name="product_image" value="<?= $item['image'] ?>">
                    <input type="hidden" name="product_weight" value="<?= $item['weight'] ?>">
                    <input type="hidden" name="product_offer" value="<?= $item['offer'] ?>">
                    <input type="hidden" name="product_old_price" value="<?= $item['old_price'] ?>">
                    <input type="hidden" name="user_address" value="<?= htmlspecialchars($user_address) ?>">
                    <input type="submit" name="submit" value="Add to Cart" class="add-btn">
                </form>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

<!-- Chatbot Icon -->
<div class="chatbot-icon" onclick="openChat()">
    <a href="../Chatbot/bot.php"><img src="../grocery_website/Ad_img/bot.png" alt="Chatbot"></a>

</div>


<?php include "./Nav/footer.php"; ?>