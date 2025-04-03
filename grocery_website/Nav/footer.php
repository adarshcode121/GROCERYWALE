<style>
  footer {
    /* background-color: #2C3E50; */
    background-color: #2C5F2D;
    color: white;
    padding: 40px 0;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: auto;
    padding: 0 20px;
}

.footer-section {
    width: 20%;
    padding: 10px;
}

.footer-section h2 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #F39C12;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    text-decoration: none;
    color: white;
    transition: 0.3s;
}

.footer-section ul li a:hover {
    color: #F39C12;
}

.footer-section p {
    font-size: 14px;
    line-height: 1.5;
}

.footer-section .social a {
    display: inline-block;
    margin-right: 10px;
    
}

.bi {

    font-size: 25px;
    margin: 10px;
}

.footer-bottom {
    text-align: center;
    justify-content: center;
    padding: 10px;
    background-color: #2C5F2D;
    font-size: 14px;
    
}
.footer-bottom p{
   margin-top: 20px; 
}
.footer-bottom a {
    color: #F39C12;
    text-decoration: none;
}

.footer-bottom a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .footer-section {
        width: 50%;
        margin-bottom: 20px;
    }
}

@media (max-width: 480px) {
    .footer-section {
        width: 100%;
    }
}

</style>
<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <h2>About Us</h2>
            <p>Your one-stop destination for fresh groceries at unbeatable prices. Shop with us and experience convenience like never before!</p>
        </div>

        <div class="footer-section customer-service">
            <h2>Customer Service</h2>
            <ul>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Shipping & Delivery</a></li>
                <li><a href="#">Returns & Refunds</a></li>
                <li><a href="#">Payment Methods</a></li>
            </ul>
        </div>

        <div class="footer-section quick-links">
            <h2>Quick Links</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Deals</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-section contact">
            <h2>Contact Us</h2>
            <p><strong>Phone:</strong> +91 9428070438</p>
            <p><strong>Email:</strong> grocerywale@gmail.com</p>
            <p><strong>Address:</strong> &nbsp;Amli Char Rasta Silvassa </p>
        </div>

        <div class="footer-section social">
            <h2>Follow Us</h2>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 GroceryWale. All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>

</html>