<?php
session_start(); // Start the session
include 'config.php';
include './Nav/Manu.php';

$user_id = $_SESSION['user_id'] ?? null; // Check if user is logged in

// Fetch user's address only if logged in
$user_address = '';
if ($user_id) {
    $user_query = mysqli_query($conn, "SELECT address FROM users WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($user_query);
    $user_address = $user_data['address'] ?? '';
}

// Fetch all products in random order
$items = $conn->query("SELECT * FROM items ORDER BY RAND()");

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


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./old/style.css">
    <style>
        .product-container {
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
    </style>
</head>

<body>
    <div class="container_aside">
        <main class="content">
            <header>
                <h1>All Products</h1>
                <div class="sort-dropdown">
                    <label for="sort">Sort By:</label>
                    <select id="sort">
                        <option value="relevance">Relevance</option>
                        <option value="price-low">Price (Low to High)</option>
                        <option value="price-high">Price (High to Low)</option>
                        <option value="discount">Discount (High to Low)</option>
                        <option value="name">Name (A to Z)</option>
                    </select>
                </div>
            </header>

            <div class="product-container" id="productContainer1">
                <?php if ($items->num_rows > 0) : ?>
                    <?php while ($item = $items->fetch_assoc()) : ?>
                        <div class="product-card" 
                            data-price="<?= $item['price'] ?>" 
                            data-old-price="<?= $item['old_price'] ?>" 
                            data-discount="<?= !empty($item['old_price']) ? ($item['old_price'] - $item['price']) : 0 ?>" 
                            data-name="<?= strtolower($item['name']) ?>">

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
                                <input type="hidden" name="user_address" value="<?= $user_address ?>">
                                <input type="submit" name="submit" value="Add to Cart" class="add-btn">
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('sort').addEventListener('change', function () {
            let sortBy = this.value;
            let productContainer = document.getElementById('productContainer1');
            let products = Array.from(document.querySelectorAll('.product-card'));

            products.sort((a, b) => {
                let priceA = parseFloat(a.getAttribute('data-price')) || 0;
                let priceB = parseFloat(b.getAttribute('data-price')) || 0;
                let oldPriceA = parseFloat(a.getAttribute('data-old-price')) || 0;
                let oldPriceB = parseFloat(b.getAttribute('data-old-price')) || 0;
                let discountA = parseFloat(a.getAttribute('data-discount')) || 0;
                let discountB = parseFloat(b.getAttribute('data-discount')) || 0;
                let nameA = a.getAttribute('data-name');
                let nameB = b.getAttribute('data-name');

                if (sortBy === "price-low") {
                    return priceA - priceB;
                } 
                else if (sortBy === "price-high") {
                    return priceB - priceA;
                } 
                else if (sortBy === "discount") {
                    return discountB - discountA;
                } 
                else if (sortBy === "name") {
                    return nameA.localeCompare(nameB);
                } 
                else {
                    return 0;
                }
            });

            productContainer.innerHTML = "";
            products.forEach(product => productContainer.appendChild(product));
        });
    </script>

    <?php include "./Nav/footer.php"; ?>
</body>

</html>
