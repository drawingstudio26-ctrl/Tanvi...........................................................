<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GreenKart - Online Grocery Store</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* ===== YOUR EXISTING STYLES ===== */
    /* ===== CORE LAYOUT STRUCTURE ===== */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      position: relative;
    }
    /* Cart Notification */
.cart-notification {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #4c774a;
  color: white;
  padding: 15px 25px;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  z-index: 9999;
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
}

/* Cart Count Badge */
.cart-count-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background-color: #ff4d4d;
  color: white;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: bold;
  display: none;
}
    a.btn:not(.banner-shop-btn) {
      display: inline-block;
      width: auto;
      padding: 8px 20px;
      text-align: center;
    }
    .team-img {
      width: 150px;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .carousel-inner {
      text-align: center;
    }

    .carousel-item blockquote {
      font-size: 1rem;
      margin: 10px 0;
    }

    .carousel-item p {
      font-size: 0.9rem;
    }

    main {
      flex: 1 0 auto;
      padding-top: 0;
      padding-bottom: 80px;
    }

    /* ===== HEADER STYLES ===== */
    header {
      background-color: rgb(22, 22, 22);
      padding: 0.75rem 1rem;
      position: sticky;
      top: 0;
      width: 100%;
      z-index: 1000;
      margin-bottom: 0 !important;
    }

    header + main .page-section > *:first-child {
      margin-top: 0 !important;
    }

    header .nav-item .nav-link {
      background: rgb(66, 190, 66);
      color: #fff;
      margin: 0 0.5rem;
      padding: 0.5rem 1rem;
      border-radius: 30px;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    header .nav-item .nav-link:hover {
      background: rgb(62, 179, 91);
      transform: translateY(-3px);
    }

    header .nav-item:last-child .nav-link {
      background: #ffcb47;
      color: #fff;
      margin-left: auto;
    }

    header .nav-item:last-child .nav-link:hover {
      background: rgb(24, 23, 23);
    }

    header ul.nav {
      width: 100%;
      justify-content: center;
      gap: 20px;
      align-items: center;
    }

    header ul.nav .nav-item:last-child {
      margin-left: auto;
    }
    /* ===== UPDATED HEADER STYLES ===== */
    header .nav-item .nav-link {
      background: rgb(66, 190, 66);
      color: #fff;
      margin: 0 0.25rem; /* Reduced margin between buttons */
      padding: 0.5rem 1rem;
      border-radius: 30px;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    /* Container for the grouped navigation buttons */
    header .nav-group {
      display: flex;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 30px;
      padding: 0.25rem;
      margin: 0 1rem;
    }
    /* ===== ADDED SPACING FOR SECTION HEADINGS ===== */
    #gallery-section .gallery-container {
      padding-top: 40px; /* Increased from original */
    }

    #contact-section .container {
      padding-top: 60px; /* Added padding */
    }

    /* Ensure main content doesn't hide behind fixed header */
    main {
      padding-top: 80px; /* Add padding to account for fixed header */
    }

    /* ===== FOOTER STYLES ===== */
    footer {
      width: 100%;
      background-color: #212529;
      color: white;
      padding: 2rem 0;
      flex-shrink: 0;
      z-index: 100;
      position: relative;
    }

    /* ===== PAGE CONTENT STYLES ===== */
    .page-section {
      display: none;
      padding-top: 20px;
    }

    #about-section {
      background-color: orange;
      padding: 20px;
    }

    .section-content {
      padding: 50px;
      text-align: center;
    }

    .section-content h2 {
      color: #81b978;
      margin-bottom: 30px;
    }

    .section-divider {
      border-top: 1px solid #000;
      margin: 40px auto;
      width: 80%;
    }

    /* ===== CAROUSEL STYLES ===== */
    .carousel-item {
      position: relative;
      text-align: center;
    }

    .carousel-item img {
      width: 60%;
      height: 400px;
      object-fit: cover;
      margin: 0 auto;
      border-radius: 12px;
      box-shadow: 0 4px 14px rgb(0 0 0 / 0.5);
    }
    .modal-content {
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      font-family: 'Segoe UI', 'Roboto', sans-serif;
      position: relative;
    }

    .modal-header {
      border-bottom: 1px solid #eee;
      padding-bottom: 0.5rem;
      margin-bottom: 1rem;
    }

    .modal-close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      background: transparent;
      border: none;
      font-size: 1rem;
      color: #333;
      cursor: pointer;
    }

    .modal-close-btn:hover {
      color: #000;
    }

    .form-label {
      font-weight: 500;
    }

    .btn-primary {
      width: 100%;
    }

    .offer-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: #ff4d4d;
      color: #ffffff;
      padding: 14px 13px;
      font-size: 1.5rem;
      font-weight: bold;
      border-radius: 50px;
      box-shadow: 0 2px 5px rgb(0 0 0 / 0.5);
      transform: translateZ(1px);
    }

    .carousel-control-prev, .carousel-control-next {
      top: 50%;
      transform: translateY(-50%);
      width: 5%;
    }

    .carousel-control-prev {
      left: 10%;
    }

    .carousel-control-next {
      right: 10%;
    }

    .carousel-control-prev-icon, .carousel-control-next-icon {
      background-color: #ff4d4d;
      padding: 20px;
      border-radius: 50%;
    }

    /* ===== CARD STYLES ===== */
    .food-cards .card {
      border: none;
      box-shadow: 0 4px 14px rgb(0 0 0 / 0.5);
      border-radius: 12px;
      transition: transform 0.3s ease;
    }

    .food-cards .card:hover {
      transform: translateY(-5px);
    }

    .food-cards .card-img-top {
      border-radius: 12px 12px 0 0;
      height: 200px;
      object-fit: cover;
    }

    .product-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      height: 100%;
      transition: transform 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .price-tag {
      background: #4c774a;
      color: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: bold;
      display: inline-block;
    }

    /* ===== IMAGE STYLES ===== */
    .testimonial-img,
    .team-img {
      width: 275px;
      height: 183px;
      object-fit: cover;
      display: block;
      margin-bottom: 10px;
    }

    .about-img {
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .gallery-img {
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      height: 200px;
      object-fit: cover;
      width: 100%;
    }

    /* ===== ABOUT SECTION STYLES ===== */
    .about-card {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      height: 100%;
    }

    /* ===== GALLERY SECTION STYLES ===== */
    .gallery-container {
      padding: 40px 0;
    }

    .gallery-item {
      margin-bottom: 30px;
      transition: all 0.3s ease;
    }

    .gallery-item:hover {
      transform: translateY(-5px);
    }

    .gallery-item img {
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .gallery-item:hover img {
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    .gallery-item h4 {
      margin-top: 15px;
      color: #4c774a;
    }

    .gallery-item p {
      color: #666;
      font-size: 0.9rem;
    }
    .gallery-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      height: 100%;
    }

    .gallery-item:hover {
      transform: translateY(-5px);
    }

    .gallery-item img {
      width: 350px;
      height: 250px;
      object-fit: cover;
      border-radius: 8px;
    }

    .gallery-item h4 {
      margin-top: 10px;
      font-size: 1.3rem;
      font-weight: 600;
    }

    .gallery-item p {
      font-size: 1rem;
      color: #555;
      text-align: center;
      margin: 5px 0 0 0;
    }
    /* ===== HERO BANNER ===== */
    .hero-banner {
      margin-top: 20px;
    }

    /* ===== BUTTON STYLES ===== */
    .btn-warning {
      background-color: #ffcb47;
      color: #4c774a;
    }

    .btn-warning:hover {
      background-color: #ffb700;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
    /* ===== UPDATED HEADER STYLES ===== */
    header .nav {
      width: 100%;
      justify-content: center;
      align-items: center;
    }
    
    header .nav-item .nav-link {
      background: rgb(66, 190, 66);
      color: #fff;
      margin: 0 0.25rem; /* Reduced margin between buttons */
      padding: 0.5rem 1rem;
      border-radius: 30px;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    /* Container for the grouped navigation buttons */
    header .nav-group {
      display: flex;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 30px;
      padding: 0.25rem;
      margin: 0 auto; /* Center the group */
    }

    /* Enquiry button styles remain the same */
    header .nav-item:last-child .nav-link {
      background: #ffcb47;
      color: #fff;
      margin-left: 1rem; /* Add some space between group and enquiry button */
    }
    header {
      background-color: rgb(22, 22, 22);
      padding: 0.75rem 1rem;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      margin-bottom: 0 !important; /* This removes any space below header */
    }
    .hero-banner {
      margin-top: 0; /* Remove top margin */
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
      background-size: cover;
      background-position: center;
      height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      border-radius: 0 0 15px 15px; /* Only rounded bottom corners */
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      position: relative;
      overflow: hidden;
    }
    main {
      flex: 1 0 auto;
      padding-top: 0; /* Remove top padding */
      padding-bottom: 80px;
    }
    
    /* Banner styles for other pages */
    .page-banner {
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1583258292688-d0213dc5a3a8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
      background-size: cover;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      margin-bottom: 30px;
    }
    
    .page-banner-content {
      text-align: center;
      padding: 20px;
      background-color: rgba(76, 119, 74, 0.8);
      border-radius: 10px;
    }
    
    /* Category subsections styles */
    .category-subsection {
      display: none;
      padding: 30px 0;
    }
    
    .category-subsection h2 {
      color: #4c774a;
      margin-bottom: 30px;
    }
    
    .category-subsection .product-card {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
<header class="d-flex align-items-center" style="position: fixed;">
  <a href="#" class="d-flex align-items-center text-decoration-none" onclick="showSection('home-page'); return false;">
    <img src="Img/7.jpg" alt="Logo" width="60" height="60" class="rounded-circle me-2">
    <h1 class="text-white m-0" style="font-size: 1.5rem;">GreenKart</h1>
  </a>

  <nav class="flex-grow-1">
    <ul class="nav justify-content-center align-items-center">
      <div class="nav-group d-flex justify-content-center">
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('home-page'); return false;">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('about-section'); return false;">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('products-section'); return false;">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('gallery-section'); return false;">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('shop-section'); return false;">Shop Now</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('offers-section'); return false;">View Offers</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('contact-section'); return false;">Contact</a></li>
      </div>
      <!-- In your header section, add this near the enquiry button -->
<li class="nav-item">
  <a class="nav-link" href="#" onclick="showCartModal(); return false;">
    <i class="fas fa-shopping-cart"></i>
    <span id="cart-count" class="cart-count-badge"></span>
  </a>
</li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquiry</a></li>
    </ul>
  </nav>
</header>
<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Your Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="cart-items-container">
          <!-- Cart items will be dynamically inserted here -->
          <div class="empty-cart-message text-center py-5">
            <i class="fas fa-shopping-cart fa-4x mb-3" style="color: #ddd;"></i>
            <h5>Your cart is empty</h5>
            <p>Start shopping to add items to your cart</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="w-100 d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Total: ₹<span id="cart-total">0</span></h5>
          <div>
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Continue Shopping</button>
            <button type="button" class="btn btn-success" onclick="proceedToCheckout()">Proceed to Checkout</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-4">
      
      <!-- Close Button -->
      <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>

    <div class="modal-header justify-content-center">
      <h5 id="enquiryModalLabel" class="modal-title fw-bold text-center">Enquiry</h5>
    </div>


      <form>
        <div class="mb-3">
          <label for="enquiryName" class="form-label">Name</label>
          <input id="enquiryName" class="form-control" type="text" placeholder="Your name">
        </div>
        <div class="mb-3">
          <label for="enquiryEmail" class="form-label">Email</label>
          <input id="enquiryEmail" class="form-control" type="email" placeholder="you@example.com">
        </div>
        <div class="mb-3">
          <label for="enquiryMsg" class="form-label">Message</label>
          <textarea id="enquiryMsg" class="form-control" rows="4" placeholder="Your message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
</div>
  <!-- Main Content Area -->
  <main>
    <!-- Home Page Content -->
    <div id="home-page" class="page-section">
      <!-- Hero Banner Section -->
      <section class="hero-banner mb-5">
        <div class="hero-content">
          <h1 class="display-3 fw-bold mb-4">Welcome to <span style="color: #ffcb47;">GreenKart</span></h1>
          <p class="lead mb-5">Your trusted online grocery store for fresh, organic produce delivered to your doorstep</p>
          <button onclick="showSection('products-section')" class="btn btn-lg btn-warning px-5 py-3">
            <i class="fas fa-shopping-basket me-2"></i> Shop Now
          </button>
        </div>
      </section>

      <!-- Your Original Slider -->
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade mt-4" data-bs-ride="carousel" data-bs-interval="500">
        <ol class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></li>
        </ol>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="Img/Frui.avif" class="d-block" alt="First slide">
            <div class="offer-badge">10% OFF for 5 days</div>
          </div>
          <div class="carousel-item">
            <img src="Img/Veget.avif" class="d-block" alt="Second slide">
            <div class="offer-badge">30% OFF for 3 days</div>
          </div>
          <div class="carousel-item">
            <img src="Img/p.avif" class="d-block" alt="Third slide">
            <div class="offer-badge">15% OFF for 2 days</div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Your Original CTA Section -->
    <section class="text-center py-0.5">
      <h2>Shop Now and Experience Freshness</h2>
      <p>Discover the finest produce and highest quality food directly from our farm to your table.</p>
      <a href="#" class="btn btn-primary d-inline-block">Shop Now</a>
    </section>


      <!-- Your Original Content Section -->
      <section class="section-content">
        <h2 style="color: #4CAF50;">Shop Our Fresh Selections</h2>
        <div class="food-cards row">
  <!-- Card 1 - Fruits -->
  <div class="col-md-4">
    <div class="card" onclick="showCategory('fruits')">
              <img src="Img/Org.webp" class="card-img-top" alt="Fruits">
              <div class="card-body">
                <h5>Organic Fruits</h5>
                <p>Sweet, rich, and full of flavor.</p>
              </div>
            </div>
          </div>
          
          <!-- Card 2 - Snacks -->
          <div class="col-md-4">
            <div class="card" onclick="showCategory('snacks')">
              <img src="Img/Snacks.jpg" class="card-img-top" alt="Healthy Snacks">
              <div class="card-body">
                <h5>Healthy Snacks</h5>
                <p>Guilt-free treats for you and your family.</p>
              </div>
            </div>
          </div>
          
          <!-- Card 3 - Vegetables -->
          <div class="col-md-4">
            <div class="card" onclick="showCategory('vegetables')">
              <img src="Img/V.jpg" class="card-img-top" alt="Fresh Vegetables">
              <div class="card-body">
                <h5>Fresh Vegetables</h5>
                <p>Hand-picked for maximum flavor and nutrients.</p>
              </div>
            </div>
          </div>

          <!-- Card 4 - Dried Foods -->
          <div class="col-md-4">
            <div class="card" onclick="showCategory('dried')">
              <img src="Img/Dried.jpg" class="card-img-top" alt="Dried Foods">
              <div class="card-body">
                <h5>Dried Foods</h5>
                <p>Healthy, rich in fiber and texture.</p>
              </div>
            </div>
          </div>
          
          <!-- Card 5 - Cereals -->
          <div class="col-md-4">
            <div class="card" onclick="showCategory('cereals')">
              <img src="Img/Cere.jpg" class="card-img-top" alt="Cereals">
              <div class="card-body">
                <h5>Cereals & Grains</h5>
                <p>Start your day strong with these essentials.</p>
              </div>
            </div>
          </div>
          
          <!-- Card 6 - Dairy -->
          <div class="col-md-4">
            <div class="card" onclick="showCategory('dairy')">
              <img src="Img/Dairy.jpg" class="card-img-top" alt="Dairy">
              <div class="card-body">
                <h5>Dairy</h5>
                <p>Milk, yogurt, paneer — pure, rich and creamy.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Video Section -->
      <section class="video-section py-5 text-center" style="background-color: #f8f9fa;">
        <div class="container">
          <h2 class="mb-4" style="color: #4CAF50;">Our Simplest Selection Process</h2>
          <div class="ratio ratio-16x9 mx-auto" style="max-width: 800px; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <iframe 
              src="https://www.youtube.com/embed/usZUYRrYbG4?autoplay=0&mute=0&rel=0" 
              title="GreenKart Fresh Grocery Delivery" 
              frameborder="0" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen>
            </iframe>
          </div>
          <p class="mt-3" style="color: #555;">See how we maintain freshness from harvest to your home</p>
        </div>
      </section>
      
      <!-- Your Original Features Section -->
      <section class="section-services py-5 bg-white text-center">
        <div class="container">
          <h2 class="mb-4" style="color:#4c774a;">Features</h2>
          <div class="row gy-4">
            <div class="col-md-4">
              <img src="Img/Curat.jpg" alt="Curated Quality" class="mb-3">
              <h5>Curated Quality</h5>
              <p>We handpick the finest, farm-fresh produce and specialty foods — delivering rich, pure flavor you can trust.</p>
            </div>
            <div class="col-md-4">
              <img src="Img/G.jpg" alt="Gourmet Variety" class="mb-3">
              <h5>Gourmet Variety</h5>
              <p>Discover a world of cuisines, ingredients, and unique food finds — from healthy grains to international delights.</p>
            </div>
            <div class="col-md-4">
              <img src="Img/Secure.jpg" alt="Safe & Sustainable Packaging" class="mb-3">
              <h5>Safe & Sustainable Packaging</h5>
              <p>We care for the environment just as much as your health, using sustainable packaging and eco-conscious delivery methods.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Divider Line -->
      <div class="section-divider"></div>

      <!-- Your Original Services Section -->
      <section class="section-services py-5 bg-light text-center">
        <div class="container">
          <h2 class="mb-4" style="color:#4c774a;">Services</h2>
          <div class="row gy-4">
            <div class="col-md-4">
              <img src="Img/Deli.jpg" alt="Fast Delivery" class="mb-3">
              <h5>Fast Delivery</h5>
              <p>On‑time delivery with every order. Free delivery for orders above ₹500.</p>
            </div>
            <div class="col-md-4">
              <img src="Img/Gift.jpg" alt="Gift Hampers" class="mb-3">
              <h5>Gift Hampers</h5>
              <p>Curate thoughtful gift hampers for your friends and family with our wide range of premium products.</p>
            </div>
            <div class="col-md-4">
              <img src="Img/Personal.jpg" alt="Personal Assistance" class="mb-3">
              <h5>Personal Assistance</h5>
              <p>Friendly, expert customer service — we're here to make your shopping convenient and enjoyable.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Divider Line -->
      <div class="section-divider"></div>

<!-- Testimonials Slider Section -->
<section id="testimonials" class="py-5 text-center">
  <div class="container">
    <h2>Testimonials</h2>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <img src="Img/Sanya.jpg" class="testimonial-img d-block mx-auto mb-3">
          <blockquote>"GreenKart is a game-changer! So convenient, healthy, and reliable!"</blockquote>
          <p>- Sanya, Mumbai</p>
        </div>

        <div class="carousel-item">
          <img src="Img/An.webp" class="testimonial-img d-block mx-auto mb-3">
          <blockquote>"Excellent service and high-caliber products, directly from the farm!"</blockquote>
          <p>- Anil, Pune</p>
        </div>

        <div class="carousel-item">
          <img src="Img/i.jpg" class="testimonial-img d-block mx-auto mb-3">
          <blockquote>"Affordable pricing without compromising on quality — that's what we love!"</blockquote>
          <p>- Priya, Delhi</p>
        </div>

        <div class="carousel-item">
          <img src="Img/R.jpg" class="testimonial-img d-block mx-auto mb-3">
          <blockquote>"Always fresh, always reliable — my go-to for groceries!"</blockquote>
          <p>- Rahul, Bengaluru</p>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>

<!-- Divider Line -->
<div class="section-divider"></div>

<!-- Team Slider Section -->
<section id="team" class="py-5 text-center">
  <div class="container">
    <h2>Meet Our Team</h2>
    <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <img src="Img/T11.jpg" alt="Tanya Gupta" class="img-fluid rounded-circle mb-3">
          <h5>Tanya Gupta</h5>
          <p>Founder</p>
        </div>

        <div class="carousel-item">
          <img src="Img/T22.jpg" alt="Anika Mehra" class="img-fluid rounded-circle mb-3">
          <h5>Anika Mehra</h5>
          <p>Operations Head</p>
        </div>

        <div class="carousel-item">
          <img src="Img/T33.webp" alt="Pooja Patel" class="img-fluid rounded-circle mb-3">
          <h5>Pooja Patel</h5>
          <p>Product Sourcing Specialist</p>
        </div>

        <div class="carousel-item">
          <img src="Img/Raje.avif" alt="Rajesh Kumar" class="img-fluid rounded-circle mb-3">
          <h5>Rajesh Kumar</h5>
          <p>Logistics Coordinator</p>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>

      <!-- Divider Line -->
      <div class="section-divider"></div>

      <!-- Your Original CTA Repeat -->
      <section class="text-center py-5">
        <h2>Shop Now and Experience Quality</h2>
        <p>Shop with us today and bring healthier food to your table.</p>
        <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
      </section>
    </div>

    <!-- About Section -->
    <div id="about-section" class="page-section">
      <!-- Added Banner -->
      <div class="page-banner">
        <div class="page-banner-content">
          <h1 class="display-4">About GreenKart</h1>
          <p class="lead">Farm-fresh since 2020</p>
        </div>
      </div>

      <!-- Your original about page content -->
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-md-6">
            <h1 class="display-4" style="color:4c774a;">Our Story</h1>
            <p class="lead">Born in 2020 from a simple idea: connect farmers directly to consumers while preserving nature's goodness.</p>
            <p>GreenKart began when our founder Tanya Gupta, an agriculture engineer, noticed the growing disconnect between farms and urban households. Today, we work with 150+ organic farms across India to bring you the purest produce.</p>
          </div>
          <div class="col-md-6">
            <img src="Img/F.webp" alt="Our Farm" class="img-fluid about-img">
          </div>
        </div>

        <div class="section-divider"></div>

        <div class="row mb-5">
          <div class="col-md-6 mb-4">
            <div class="about-card">
              <h3><img src="Img/Mission.webp" width="275" class="me-2">Our Mission</h3>
              <p>To make organic, farm-fresh food accessible to every Indian household while ensuring fair prices for farmers and sustainable practices for our planet.</p>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="about-card">
              <h3><img src="Img/Values.jpg" width="275" class="me-2">Our Values</h3>
              <ul>
                <li>Farm First: 75% of price goes directly to farmers</li>
                <li>Zero Compromise on Quality</li>
                <li>100% Plastic-Neutral Operations</li>
                <li>Transparent Sourcing</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="section-divider"></div>

        <div class="text-center mb-5">
          <h2 class="mb-4" style="color:#4c774a;">From Our Farms to Your Home</h2>
          <div class="row">
            <div class="col-md-3">
              <img src="Img/FS.jpg" class="about-img rounded-circle" style="width:150px;height:150px;object-fit:cover">
              <h4>FSSAI Certified</h4>
              <p>All our products meet FSSAI quality and safety standards</p>
            </div>
            <div class="col-md-3">
              <img src="Img/Curat.jpg" class="about-img rounded-circle" style="width:150px;height:150px;object-fit:cover">
              <h4>Organic Cultivation</h4>
              <p>Chemical-free farming across 150+ partner farms</p>
            </div>
            <div class="col-md-3">
              <img src="Img/Veget.avif" class="about-img rounded-circle" style="width:150px;height:150px;object-fit:cover">
              <h4>Hand Harvesting</h4>
              <p>Picked at perfect ripeness by skilled farmers</p>
            </div>
            <div class="col-md-3">
              <img src="Img/Quality.jpg" class="about-img rounded-circle" style="width:150px;height:150px;object-fit:cover">
              <h4>Quality Checks</h4>
              <p>3-stage inspection before packaging</p>
            </div>
          </div>
        </div>

        <div class="section-divider"></div>

        <div class="bg-white p-5 rounded mb-5 text-center">
          <h2 class="mb-4" style="color:#4c774a;">Our Impact</h2>
          <div class="row">
            <div class="col-md-3">
              <h3>150+</h3>
              <p>Partner Farms</p>
            </div>
            <div class="col-md-3">
              <h3>95%</h3>
              <p>Farmer Income Increase</p>
            </div>
            <div class="col-md-3">
              <h3>50K+</h3>
              <p>Happy Families</p>
            </div>
            <div class="col-md-3">
              <h3>100%</h3>
              <p>Plastic-Neutral</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Products Section -->
<div id="products-section" class="page-section">
  <!-- Added Banner -->
  <div class="page-banner">
    <div class="page-banner-content">
      <h1 class="display-4">Our Products</h1>
      <p class="lead">Farm-fresh goodness delivered to your doorstep</p>
    </div>
  </div>

  <!-- Your original products page content -->
  <div class="container">
    <p class="lead text-center">Explore our farm-fresh products and seasonal specials</p>
  </div>

  <div class="text-center mb-5">
    <h2 class="mb-4" style="color:#4c774a;">Pure Vegetarian Essentials</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/bananas.jpg" alt="Organic Bananas" class="gallery-img">
          <h3>Organic Bananas</h3>
          <p>Ripe, potassium-rich bananas from Kerala farms</p>
          <div class="price-tag">₹49/dozen</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Organic Bananas', 49, 'Img/bananas.jpg')">Add to Cart</button>
          <div class="badge bg-warning mt-2">Best Seller</div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Apples.webp" alt="Shimla Apples" class="gallery-img">
          <h3>Shimla Apples</h3>
          <p>Crisp Himalayan apples with natural sweetness</p>
          <div class="price-tag">₹199/kg</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Shimla Apples', 199, 'Img/Apples.webp')">Add to Cart</button>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Papaya.jpg" alt="Red Lady Papaya" class="gallery-img">
          <h3>Papaya</h3>
          <p>Digestive-friendly tropical fruit</p>
          <div class="price-tag">₹59/kg</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Papaya', 59, 'Img/Papaya.jpg')">Add to Cart</button>
        </div>
      </div>

      <!-- Row 2 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Brocolli.jpg" alt="Fresh Broccoli" class="gallery-img">
          <h3>Fresh Broccoli</h3>
          <p>Nutrient-dense florets packed with vitamins</p>
          <div class="price-tag">₹79/head</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Fresh Broccoli', 79, 'Img/Brocolli.jpg')">Add to Cart</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Avocado.webp" alt="Hass Avocados" class="gallery-img">
          <h3>Hass Avocados</h3>
          <p>Creamy, nutrient-rich superfood packed with healthy fats</p>
          <div class="price-tag">₹179/piece</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Hass Avocados', 179, 'Img/Avocado.webp')">Add to Cart</button>
          <div class="badge bg-primary mt-2">Superfood</div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Sweet Potato.jpg" alt="Sweet Potatoes" class="gallery-img">
          <h3>Sweet Potatoes</h3>
          <p>Orange-fleshed, rich in Vitamin A</p>
          <div class="price-tag">₹65/kg</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Sweet Potatoes', 65, 'Img/Sweet Potato.jpg')">Add to Cart</button>
        </div>
      </div>
      <!-- Row 3: Grocery Staples -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Almonds.jpg" alt="California Almonds" class="gallery-img">
          <h3>California Almonds</h3>
          <p>Raw, unpeeled - perfect for badam milk</p>
          <div class="price-tag">₹599/kg</div>
          <button class="btn btn-success mt-2" onclick="addToCart('California Almonds', 599, 'Img/Almonds.jpg')">Add to Cart</button>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Honey.jpg" alt="Organic Honey" class="gallery-img">
          <h3>Organic Honey</h3>
          <p>100% pure forest honey from Nilgiris</p>
          <div class="price-tag">₹399/500g</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Organic Honey', 399, 'Img/Honey.jpg')">Add to Cart</button>
          <div class="badge bg-warning mt-2">Immunity Booster</div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Moong dal.jpg" alt="Organic Moong Dal" class="gallery-img">
          <h3>Organic Moong Dal</h3>
          <p>Hulled split green gram for khichdi/dosa</p>
          <div class="price-tag">₹129/kg</div>
          <button class="btn btn-success mt-2" onclick="addToCart('Organic Moong Dal', 129, 'Img/Moong dal.jpg')">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Seasonal Specials Section -->
  <div class="text-center mb-5">
    <div style="background-color:rgb(56, 114, 206); padding: 3rem 0;">
      <div class="container">
        <h2 class="mb-4" style="color:black;">Seasonal Specials</h2>
        <div class="row">
          <!-- Alphonso Mangoes -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Alphonso.webp" alt="Alphonso Mangoes" class="gallery-img">
              <h3>Alphonso Mangoes</h3>
              <p>The king of fruits, available April-June</p>
              <div class="price-tag">₹399/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Alphonso Mangoes', 399, 'Img/Alphonso.webp')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Apr-Jun</div>
            </div>
          </div>

          <!-- Pomegranates -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Pomogranate.jpg" alt="Pomegranates" class="gallery-img">
              <h3>Pomegranates</h3>
              <p>Ruby-red arils packed with antioxidants</p>
              <div class="price-tag">₹199/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Pomegranates', 199, 'Img/Pomogranate.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Sep-Feb</div>
            </div>
          </div>

          <!-- Sweet Corn -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Corn.jpg" alt="Sweet Corn" class="gallery-img">
              <h3>Sweet Corn</h3>
              <p>Naturally sweet, perfect for summer</p>
              <div class="price-tag">₹49/each</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Sweet Corn', 49, 'Img/Corn.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Mar-Jun</div>
            </div>
          </div>

          <!-- Sapota (Chikoo) -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Chikoo.jpg" alt="Chikoo" class="gallery-img">
              <h3>Chikoo</h3>
              <p>Sweet, grainy winter fruit perfect for desserts</p>
              <div class="price-tag">₹129/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Chikoo', 129, 'Img/Chikoo.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Jan-Mar</div>
            </div>
          </div>

          <!-- Lychees -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Lychee.jpg" alt="Lychees" class="gallery-img">
              <h3>Lychees</h3>
              <p>Juicy, fragrant summer fruits from Muzaffarpur</p>
              <div class="price-tag">₹249/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Lychees', 249, 'Img/Lychee.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: May-Jul</div>
            </div>
          </div>

          <!-- Jackfruit -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Jackfruit.jpg" alt="Jackfruit" class="gallery-img">
              <h3>Jackfruit</h3>
              <p>Versatile summer fruit for curries or vegan "meat"</p>
              <div class="price-tag">₹179/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Jackfruit', 179, 'Img/Jackfruit.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Mar-Jun</div>
            </div>
          </div>

          <!-- Muskmelon -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Muskmelon.jpg" alt="Muskmelon" class="gallery-img">
              <h3>Muskmelon</h3>
              <p>Hydrating summer fruit with delicate aroma</p>
              <div class="price-tag">₹99/piece</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Muskmelon', 99, 'Img/Muskmelon.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Apr-Jul</div>
            </div>
          </div>

          <!-- Watermelon -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/Watermelon.jpg" alt="Watermelon" class="gallery-img">
              <h3>Watermelon</h3>
              <p>Juicy, refreshing summer essential</p>
              <div class="price-tag">₹49/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Watermelon', 49, 'Img/Watermelon.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Mar-Jul</div>
            </div>
          </div>

          <!-- Bitter Gourd -->
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="Img/B.jpg" alt="Bitter Gourd" class="gallery-img">
              <h3>Bitter Gourd</h3>
              <p>Monsoon vegetable for diabetic-friendly recipes</p>
              <div class="price-tag">₹69/kg</div>
              <button class="btn btn-success mt-2" onclick="addToCart('Bitter Gourd', 69, 'Img/B.jpg')">Add to Cart</button>
              <div class="badge bg-info mt-2">Seasonal: Jun-Sep</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Category Subsections -->
  <div id="category-subsections">
    <!-- Fruits Subsection -->
    <div id="fruits-subsection" class="category-subsection text-center">
      <h2 class="mb-4" style="color:#4c774a;">Premium Organic Fruits</h2>
      <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Apples.webp" alt="Organic Apples" class="gallery-img">
            <h3>Organic Apples</h3>
            <p>Crisp and juicy, straight from Himachal orchards</p>
            <div class="price-tag">₹199/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Organic Apples', 199, 'Img/Apples.webp')">Add to Cart</button>
            <div class="badge bg-warning mt-2">Best Seller</div>
          </div>
        </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Bananas.jpg" alt="Organic Bananas" class="gallery-img">
            <h3>Organic Bananas</h3>
            <p>Rich in potassium, naturally sweet</p>
            <div class="price-tag">₹49/dozen</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Organic Bananas', 49, 'Img/Bananas.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Oran.jpg" alt="Nagpur Oranges" class="gallery-img">
            <h3>Nagpur Oranges</h3>
            <p>Juicy and vitamin C rich</p>
            <div class="price-tag">₹129/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Nagpur Oranges', 129, 'Img/Oran.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Guav.webp" alt="Pink Guava" class="gallery-img">
            <h3>Pink Guava</h3>
            <p>Antioxidant-rich tropical fruit</p>
            <div class="price-tag">₹79/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Pink Guava', 79, 'Img/Guav.webp')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Pomogranate.jpg" alt="Pomegranate" class="gallery-img">
            <h3>Pomegranate</h3>
            <p>Ruby-red arils packed with antioxidants</p>
            <div class="price-tag">₹199/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Pomegranate', 199, 'Img/Pomogranate.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Gr.jpg" alt="Grapes" class="gallery-img">
            <h3>Grapes</h3>
            <p>Seedless, sweet and juicy</p>
            <div class="price-tag">₹149/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Grapes', 149, 'Img/Gr.jpg')">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Snacks Subsection -->
    <div id="snacks-subsection" class="category-subsection text-center">
      <h2 class="mb-4" style="color:#4c774a;">Healthy Snacks</h2>
      <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Nuts.jpg" alt="Mixed Nuts" class="gallery-img">
            <h3>Mixed Nuts</h3>
            <p>Almonds, walnuts, cashews and raisins</p>
            <div class="price-tag">₹299/250g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Mixed Nuts', 299, 'Img/Nuts.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Granola.jpg" alt="Homemade Granola" class="gallery-img">
            <h3>Homemade Granola</h3>
            <p>With jaggery and dried fruits</p>
            <div class="price-tag">₹199/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Homemade Granola', 199, 'Img/Granola.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Prot.jpg" alt="Protein Bars" class="gallery-img">
            <h3>Protein Bars</h3>
            <p>Plant-based, no added sugar</p>
            <div class="price-tag">₹99 each</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Protein Bars', 99, 'Img/Prot.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Makh.jpg" alt="Roasted Makhana" class="gallery-img">
            <h3>Roasted Makhana</h3>
            <p>Lightly salted fox nuts</p>
            <div class="price-tag">₹149/200g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Roasted Makhana', 149, 'Img/Makh.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Mix.jpg" alt="Dry Fruit Mix" class="gallery-img">
            <h3>Dry Fruit Mix</h3>
            <p>Premium selection of 7 dry fruits</p>
            <div class="price-tag">₹399/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Dry Fruit Mix', 399, 'Img/Mix.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Energy.jpg" alt="Energy Balls" class="gallery-img">
            <h3>Energy Balls</h3>
            <p>Dates, nuts and cocoa power bites</p>
            <div class="price-tag">₹249/dozen</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Energy Balls', 249, 'Img/Energy.jpg')">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Vegetables Subsection -->
    <div id="vegetables-subsection" class="category-subsection text-center">
      <h2 class="mb-4" style="color:#4c774a;">Farm Fresh Vegetables</h2>
      <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Tomato.jpg" alt="Organic Tomatoes" class="gallery-img">
            <h3>Organic Tomatoes</h3>
            <p>Juicy and flavorful</p>
            <div class="price-tag">₹49/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Organic Tomatoes', 49, 'Img/Tomato.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Carrot.webp" alt="Fresh Carrots" class="gallery-img">
            <h3>Fresh Carrots</h3>
            <p>Sweet and crunchy</p>
            <div class="price-tag">₹65/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Fresh Carrots', 65, 'Img/Carrot.webp')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Ba.jpg" alt="Baby Spinach" class="gallery-img">
            <h3>Baby Spinach</h3>
            <p>Tender and nutrient-packed</p>
            <div class="price-tag">₹89/bunch</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Baby Spinach', 89, 'Img/Ba.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/BellPeppers.avif" alt="Colored Capsicum" class="gallery-img">
            <h3>Colored Capsicum</h3>
            <p>Red, yellow and green mix</p>
            <div class="price-tag">₹199/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Colored Capsicum', 199, 'Img/BellPeppers.avif')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Brocolli.jpg" alt="Fresh Broccoli" class="gallery-img">
            <h3>Fresh Broccoli</h3>
            <p>Nutrient-dense florets</p>
            <div class="price-tag">₹79/head</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Fresh Broccoli', 79, 'Img/Brocolli.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Bean.jpg" alt="French Beans" class="gallery-img">
            <h3>French Beans</h3>
            <p>Tender and stringless</p>
            <div class="price-tag">₹89/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('French Beans', 89, 'Img/Bean.jpg')">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Dried Foods Subsection -->
    <div id="dried-subsection" class="category-subsection text-center">
      <h2 class="mb-4" style="color:#4c774a;">Premium Dried Foods</h2>
      <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/DrMa.jpg" alt="Dried Mango" class="gallery-img">
            <h3>Dried Mango</h3>
            <p>Sweet and chewy, no added sugar</p>
            <div class="price-tag">₹249/200g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Dried Mango', 249, 'Img/DrMa.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/DrTo.jpg" alt="Sun-Dried Tomatoes" class="gallery-img">
            <h3>Sun-Dried Tomatoes</h3>
            <p>Intense flavor, perfect for pastas</p>
            <div class="price-tag">₹299/150g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Sun-Dried Tomatoes', 299, 'Img/DrTo.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Mushr.jpg" alt="Dried Mushrooms" class="gallery-img">
            <h3>Dried Mushrooms</h3>
            <p>Porcini and shiitake mix</p>
            <div class="price-tag">₹349/100g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Dried Mushrooms', 349, 'Img/Mushr.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/cran.webp" alt="Dried Cranberries" class="gallery-img">
            <h3>Dried Cranberries</h3>
            <p>Tart and sweet, great for baking</p>
            <div class="price-tag">₹199/200g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Dried Cranberries', 199, 'Img/cran.webp')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Apri.jpg" alt="Dried Apricots" class="gallery-img">
            <h3>Dried Apricots</h3>
            <p>Soft and naturally sweet</p>
            <div class="price-tag">₹229/250g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Dried Apricots', 229, 'Img/Apri.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/DrCo.jpg" alt="Dried Coconut" class="gallery-img">
            <h3>Dried Coconut Chips</h3>
            <p>Crunchy and lightly salted</p>
            <div class="price-tag">₹149/150g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Dried Coconut Chips', 149, 'Img/DrCo.jpg')">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Cereals Subsection -->
    <div id="cereals-subsection" class="category-subsection text-center">
      <h2 class="mb-4" style="color:#4c774a;">Whole Grains & Cereals</h2>
      <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Quinoa.jpg" alt="Organic Quinoa" class="gallery-img">
            <h3>Organic Quinoa</h3>
            <p>Protein-rich ancient grain</p>
            <div class="price-tag">₹499/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Organic Quinoa', 499, 'Img/Quinoa.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/BaRi.jpeg" alt="Basmati Rice" class="gallery-img">
            <h3>Basmati Rice</h3>
            <p>Aged, long grain premium quality</p>
            <div class="price-tag">₹129/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Basmati Rice', 129, 'Img/BaRi.jpeg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Oats.webp" alt="Rolled Oats" class="gallery-img">
            <h3>Rolled Oats</h3>
            <p>100% whole grain, perfect for porridge</p>
            <div class="price-tag">₹99/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Rolled Oats', 99, 'Img/Oats.webp')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/MiFl.jpg" alt="Millet Flour" class="gallery-img">
            <h3>Millet Flour</h3>
            <p>Gluten-free alternative for rotis</p>
            <div class="price-tag">₹89/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Millet Flour', 89, 'Img/MiFl.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/WhWe.jpg" alt="Whole Wheat Flour" class="gallery-img">
            <h3>Whole Wheat Flour</h3>
            <p>Stone-ground, unbleached</p>
            <div class="price-tag">₹59/kg</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Whole Wheat Flour', 59, 'Img/WhWe.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Mues.webp" alt="Sugar-Free Muesli" class="gallery-img">
            <h3>Sugar-Free Muesli</h3>
            <p>With nuts and dried fruits</p>
            <div class="price-tag">₹299/750g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Sugar-Free Muesli', 299, 'Img/Mues.webp')">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Dairy Subsection -->
    <div id="dairy-subsection" class="category-subsection text-center">
      <h2 class="mb-4" style="color:#4c774a;">Fresh Dairy Products</h2>
      <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Milk.jpg" alt="Organic Milk" class="gallery-img">
            <h3>Organic Milk</h3>
            <p>Fresh from grass-fed cows</p>
            <div class="price-tag">₹65/liter</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Organic Milk', 65, 'Img/Milk.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Paneer.jpg" alt="Fresh Paneer" class="gallery-img">
            <h3>Fresh Paneer</h3>
            <p>Homemade, soft and crumbly</p>
            <div class="price-tag">₹199/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Fresh Paneer', 199, 'Img/Paneer.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Yogurt.avif" alt="Greek Yogurt" class="gallery-img">
            <h3>Greek Yogurt</h3>
            <p>High protein, creamy texture</p>
            <div class="price-tag">₹149/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Greek Yogurt', 149, 'Img/Yogurt.avif')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Moze.jpg" alt="Mozzarella Cheese" class="gallery-img">
            <h3>Mozzarella Cheese</h3>
            <p>Perfect for pizzas and pastas</p>
            <div class="price-tag">₹249/200g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Mozzarella Cheese', 249, 'Img/Moze.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Butter.jpg" alt="White Butter" class="gallery-img">
            <h3>White Butter</h3>
            <p>Traditional homemade makhan</p>
            <div class="price-tag">₹299/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('White Butter', 299, 'Img/Butter.jpg')">Add to Cart</button>
          </div>
        </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Ghee.jpg" alt="Pure Ghee" class="gallery-img">
            <h3>Pure Ghee</h3>
            <p>A2 Bilona method, rich aroma</p>
            <div class="price-tag">₹499/500g</div>
            <button class="btn btn-success mt-2" onclick="addToCart('Pure Ghee', 499, 'Img/Ghee.jpg')">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Gallery Section -->
<div id="gallery-section" class="page-section">
  <!-- Added Banner -->
  <div class="page-banner">
    <div class="page-banner-content">
      <h1 class="display-4">Product Gallery</h1>
      <p class="lead">Explore our premium selection of grocery products</p>
    </div>
  </div>

  <div class="container gallery-container">
    <div class="text-center mb-10">
      <h1 class="display-6" style="color:#4c774a;">Product Gallery</h1>
      <p class="lead">Explore our premium selection of grocery products</p>
    </div>

    <div class="row justify-content-center">
      <!-- Gallery Item 1 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Apples.webp" alt="Premium Apples">
          <h4>Premium Apples</h4>
          <p>Fresh and crisp, perfect for snacks and desserts</p>
        </div>
      </div>

      <!-- Gallery Item 2 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Bananas.jpg" alt="Organic Bananas">
          <h4>Organic Bananas</h4>
          <p>Rich in potassium, naturally sweet</p>
        </div>
      </div>

      <!-- Gallery Item 3 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Oran.jpg" alt="Fresh Oranges">
          <h4>Fresh Oranges</h4>
          <p>Juicy and vitamin C rich</p>
        </div>
      </div>

      <!-- Gallery Item 4 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Pomogranate.jpg" alt="Pomegranates">
          <h4>Pomegranates</h4>
          <p>Ruby-red arils packed with antioxidants</p>
        </div>
      </div>

      <!-- Gallery Item 5 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Gr.jpg" alt="Fresh Grapes">
          <h4>Fresh Grapes</h4>
          <p>Seedless, sweet and juicy</p>
        </div>
      </div>

      <!-- Gallery Item 6 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Mushr.jpg" alt="Mushrooms">
          <h4>Mushrooms</h4>
          <p>Nutrient-rich, immunity-boosting edible fungi.</p>
        </div>
      </div>

      <!-- Gallery Item 7 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Tomato.jpg" alt="Fresh Tomatoes">
          <h4>Fresh Tomatoes</h4>
          <p>Juicy and flavorful, perfect for salads</p>
        </div>
      </div>

      <!-- Gallery Item 8 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Carrot.webp" alt="Organic Carrots">
          <h4>Organic Carrots</h4>
          <p>Sweet and crunchy, rich in beta-carotene</p>
        </div>
      </div>

      <!-- Gallery Item 9 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Brocolli.jpg" alt="Fresh Broccoli">
          <h4>Fresh Broccoli</h4>
          <p>Nutrient-dense florets packed with vitamins</p>
        </div>
      </div>

      <!-- Gallery Item 10 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/BellPeppers.avif" alt="Bell Peppers">
          <h4>Bell Peppers</h4>
          <p>Colorful and crunchy, great for stir-fries</p>
        </div>
      </div>

      <!-- Gallery Item 11 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Ba.jpg" alt="Fresh Spinach">
          <h4>Fresh Spinach</h4>
          <p>Tender leaves packed with iron</p>
        </div>
      </div>

      <!-- Gallery Item 12 -->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="gallery-item text-center">
          <img src="Img/Potatoes.jpg" alt="Organic Potatoes">
          <h4>Organic Potatoes</h4>
          <p>Versatile and delicious, perfect for any dish</p>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- Contact Page Section -->
    <div id="contact-section" class="page-section">
      <!-- Added Banner -->
      <div class="page-banner">
        <div class="page-banner-content">
          <h1 class="display-4">Contact Us</h1>
          <p class="lead">We're here to help with any questions</p>
        </div>
      </div>

      <div class="container py-5">
        <!-- Contact Header -->
        <div class="text-center mb-5">
          <h1 class="display-4" style="color:#4c774a;">Get In Touch</h1>
          <p class="lead">We'd love to hear from you! Reach out for inquiries, feedback or just to say hello.</p>
        </div>

        <div class="row">
          <!-- Contact Info -->
          <div class="col-md-6 mb-5">
            <div class="about-card h-100">
              <h3 class="mb-4" style="color:#4c774a;">Contact Information</h3>
              <div class="d-flex align-items-start mb-4">
                <i class="fas fa-map-marker-alt fa-2x me-3" style="color:#81b978;"></i>
                <div>
                  <h5>Our Address</h5>
                  <p>GreenKart Headquarters<br>123 Organic Farm Road<br>Mumbai, Maharashtra 400001</p>
                </div>
              </div>
              
              <div class="d-flex align-items-start mb-4">
                <i class="fas fa-phone-alt fa-2x me-3" style="color:#81b978;"></i>
                <div>
                  <h5>Call Us</h5>
                  <p>Customer Care: +91 98765 43210<br>Wholesale Inquiries: +91 98765 43211</p>
                </div>
              </div>
              
              <div class="d-flex align-items-start mb-4">
                <i class="fas fa-envelope fa-2x me-3" style="color:#81b978;"></i>
                <div>
                  <h5>Email Us</h5>
                  <p>General: info@greenkart.com<br>Support: help@greenkart.com</p>
                </div>
              </div>
              
              <div class="d-flex align-items-start">
                <i class="fas fa-clock fa-2x me-3" style="color:#81b978;"></i>
                <div>
                  <h5>Working Hours</h5>
                  <p>Monday-Saturday: 8AM - 8PM<br>Sunday: 10AM - 4PM</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Contact Form -->
          <div class="col-md-6 mb-5">
            <div class="about-card h-100">
              <h3 class="mb-4" style="color:#4c774a;">Send Us a Message</h3>
              <form action="index1.php" method="post">
                <div class="mb-3">
                  <label for="contactName" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="contactName" required name="name">
                </div>
                <div class="mb-3">
                  <label for="contactEmail" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="contactEmail" required name="email">
                </div>
                <div class="mb-3">
                  <label for="contactPhone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" id="contactPhone" required name="phone">
                </div>
                <div class="mb-3">
                  <label for="contactSubject" class="form-label">Subject</label>
                  <select class="form-select" id="contactSubject" required name="subject">
                    <option>General Inquiry</option>
                    <option>Product Feedback</option>
                    <option>Wholesale Inquiry</option>
                    <option>Complaint</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="contactMessage" class="form-label">Your Message</label>
                  <textarea class="form-control" id="contactMessage" rows="4" required name="message"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">Send Message</button>
              </form>

            </div>
          </div>
        </div><?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<script>
    alert("Thank you for your Submission!");
    // Remove query parameter from URL without reloading
    if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('success');
        window.history.replaceState({}, document.title, url.pathname);
    }
</script>
<?php endif; ?>

        <!-- Divider Line -->
        <div class="section-divider"></div>
        
        <!-- Store Locations -->
        <div class="text-center mb-5">
          <h2 class="mb-4" style="color:#4c774a;">Our Store Locations</h2>
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="about-card h-100">
                <img src="Img/Mumb.jpg" alt="Mumbai Store" class="img-fluid rounded mb-3">
                <h4>Mumbai Flagship Store</h4>
                <p>Ground Floor, Organic Towers<br>Bandra West, Mumbai</p>
                <p><i class="fas fa-clock me-2"></i> 9AM - 9PM Daily</p>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="about-card h-100">
                <img src="Img/Bang.jpg" alt="Bangalore Store" class="img-fluid rounded mb-3">
                <h4>Bangalore Organic Hub</h4>
                <p>12th Main, 80 Feet Road<br>Indiranagar, Bangalore</p>
                <p><i class="fas fa-clock me-2"></i> 8AM - 8PM Daily</p>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="about-card h-100">
                <img src="Img/Delh.jpg" alt="Delhi Store" class="img-fluid rounded mb-3">
                <h4>Delhi Farm Fresh</h4>
                <p>Green Plaza, Connaught Place<br>New Delhi</p>
                <p><i class="fas fa-clock me-2"></i> 8AM - 8PM Daily</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   <!-- Shop Now Page Section -->
<div id="shop-section" class="page-section">
  <!-- Added Banner -->
  <div class="page-banner">
    <div class="page-banner-content">
      <h1 class="display-4">Shop Now</h1>
      <p class="lead">Browse our fresh grocery selections</p>
    </div>
  </div>

  <div style="background-color:rgb(245, 201, 119); padding: 3rem 0;">
    <div class="container">
      <div class="container py-5">
        <!-- Shop Header -->
        <div class="text-center mb-5">
          <h1 class="display-4" style="color:#4c774a;">Shop Fresh Groceries</h1>
          <p class="lead">Browse our wide selection of farm-fresh products</p>
        </div>
        
        <!-- Categories -->
        <div class="row mb-5">
          <div class="col-12">
            <h2 class="mb-4" style="color:#4c774a;">Shop by Category</h2>
            <div class="row">
              <div class="col-md-3 mb-4">
                <div class="category-card text-center p-4 rounded" style="background-color:#e8f5e9; cursor:pointer;">
                  <img src="Img/Frui.avif" alt="Fruits" class="img-fluid rounded mb-3" style="height:120px;width:100%;object-fit:cover;">
                  <h5>Fresh Fruits</h5>
                  <p class="mb-0">Seasonal & Organic</p>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="category-card text-center p-4 rounded" style="background-color:#e8f5e9; cursor:pointer;">
                  <img src="Img/Veget.avif" alt="Vegetables" class="img-fluid rounded mb-3" style="height:120px;width:100%;object-fit:cover;">
                  <h5>Fresh Vegetables</h5>
                  <p class="mb-0">Farm to Table</p>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="category-card text-center p-4 rounded" style="background-color:#e8f5e9; cursor:pointer;">
                  <img src="Img/Dairy.jpg" alt="Dairy" class="img-fluid rounded mb-3" style="height:120px;width:100%;object-fit:cover;">
                  <h5>Dairy & Eggs</h5>
                  <p class="mb-0">Pure & Natural</p>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="category-card text-center p-4 rounded" style="background-color:#e8f5e9; cursor:pointer;">
                  <img src="Img/Cere.jpg" alt="Grains" class="img-fluid rounded mb-3" style="height:120px;width:100%;object-fit:cover;">
                  <h5>Grains & Pulses</h5>
                  <p class="mb-0">Organic Staples</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Divider Line -->
        <div class="section-divider"></div>
        
        <!-- Featured Products -->
        <div class="row mb-5">
          <div class="col-12">
            <h2 class="mb-4" style="color:#4c774a;">Featured Products</h2>
            <div class="row">
              <!-- Product 1 -->
              <div class="col-md-3 mb-4">
                <div class="product-card">
                  <img src="Img/Org.webp" class="gallery-img" alt="Organic Fruits">
                  <div class="p-3">
                    <h5>Organic Mixed Fruits</h5>
                    <p class="text-muted small">Seasonal selection</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="price-tag">₹299/kg</span>
                      <button class="btn btn-sm btn-success" onclick="addToCart('Organic Mixed Fruits', 299, 'Img/Org.webp')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Product 2 -->
              <div class="col-md-3 mb-4">
                <div class="product-card">
                  <img src="Img/V.jpg" class="gallery-img" alt="Fresh Vegetables">
                  <div class="p-3">
                    <h5>Fresh Vegetable Box</h5>
                    <p class="text-muted small">Weekly essentials</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="price-tag">₹199/box</span>
                      <button class="btn btn-sm btn-success" onclick="addToCart('Fresh Vegetable Box', 199, 'Img/V.jpg')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Product 3 -->
              <div class="col-md-3 mb-4">
                <div class="product-card">
                  <img src="Img/Almonds.jpg" class="gallery-img" alt="California Almonds">
                  <div class="p-3">
                    <h5>California Almonds</h5>
                    <p class="text-muted small">Raw & unpeeled</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="price-tag">₹599/kg</span>
                      <button class="btn btn-sm btn-success" onclick="addToCart('California Almonds', 599, 'Img/Almonds.jpg')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Product 4 -->
              <div class="col-md-3 mb-4">
                <div class="product-card">
                  <img src="Img/Honey.jpg" class="gallery-img" alt="Organic Honey">
                  <div class="p-3">
                    <h5>Organic Forest Honey</h5>
                    <p class="text-muted small">500g bottle</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="price-tag">₹399</span>
                      <button class="btn btn-sm btn-success" onclick="addToCart('Organic Forest Honey', 399, 'Img/Honey.jpg')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Divider Line -->
        <div class="section-divider"></div>
        
        <!-- Subscription Box -->
        <div class="row mb-5">
          <div class="col-md-6 mb-4 mb-md-0">
            <img src="Img/Subs.jpg" alt="Subscription Box" class="img-fluid rounded">
          </div>
          <div class="col-md-6">
            <div class="about-card h-100">
              <h3 style="color:#4c774a;">Weekly Subscription Box</h3>
              <p class="lead">Never run out of essentials with our curated weekly boxes</p>
              <ul class="mb-4">
                <li>Fresh seasonal produce selected by our experts</li>
                <li>10-15% cheaper than buying individually</li>
                <li>Flexible - skip weeks or cancel anytime</li>
                <li>Customizable based on your preferences</li>
              </ul>
              <div class="d-flex align-items-center mb-3">
                <div class="me-4">
                  <h4 class="mb-0">₹999</h4>
                  <small>per week</small>
                </div>
                <button class="btn btn-success btn-lg">Subscribe Now</button>
              </div>
              <small class="text-muted">First box ships within 2 business days</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Offers Page Section -->
    <div id="offers-section" class="page-section">
      <!-- Added Banner -->
      <div class="page-banner">
        <div class="page-banner-content">
          <h1 class="display-4">Special Offers</h1>
          <p class="lead">Save more with these exclusive deals</p>
        </div>
      </div>

      <div style="background-color:rgb(221, 238, 162); padding: 3rem 0;">
        <div class="container">
          <div class="container py-5">
            <!-- Offers Header -->
            <!-- Current Offers -->
              <div class="col-12">
                <div class="text-center mb-5">
                <h1 class="display-4" style="color:#4c774a;">Current Offers</h2>
                <div class="row mb-5">
                <div class="row">
                  <!-- Offer 1 -->
                  <div class="col-md-4 mb-4">
                    <div class="offer-card position-relative overflow-hidden rounded" style="height:100%;">
                      <img src="Img/Frui.avif" class="img-fluid w-100" style="height:200px;object-fit:cover;" alt="Fruits Offer">
                      <div class="p-4" style="background-color:#e8f5e9;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                          <h5 class="mb-0">Fruits Festival</h5>
                          <span class="badge bg-danger">30% OFF</span>
                        </div>
                        <p class="small">On all seasonal fruits this week</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <small class="text-muted">Valid until: 30 Jun 2024</small>
                          <button class="btn btn-sm btn-success">Shop Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Offer 2 -->
                  <div class="col-md-4 mb-4">
                    <div class="offer-card position-relative overflow-hidden rounded" style="height:100%;">
                      <img src="Img/Veget.avif" class="img-fluid w-100" style="height:200px;object-fit:cover;" alt="Vegetables Offer">
                      <div class="p-4" style="background-color:#e8f5e9;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                          <h5 class="mb-0">Vegetable Bonanza</h5>
                          <span class="badge bg-danger">Buy 1 Get 1</span>
                        </div>
                        <p class="small">On selected leafy vegetables</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <small class="text-muted">Valid until: 25 Jun 2024</small>
                          <button class="btn btn-sm btn-success">Shop Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Offer 3 -->
                  <div class="col-md-4 mb-4">
                    <div class="offer-card position-relative overflow-hidden rounded" style="height:100%;">
                      <img src="Img/Dairy.jpg" class="img-fluid w-100" style="height:200px;object-fit:cover;" alt="Dairy Offer">
                      <div class="p-4" style="background-color:#e8f5e9;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                          <h5 class="mb-0">Dairy Delight</h5>
                          <span class="badge bg-danger">15% OFF</span>
                        </div>
                        <p class="small">On all dairy products this weekend</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <small class="text-muted">Valid until: 23 Jun 2024</small>
                          <button class="btn btn-sm btn-success">Shop Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Divider Line -->
            <div class="section-divider"></div>
            
            <!-- Membership Offers -->
            <div class="row mb-5">
              <div class="col-12">
                <h2 class="mb-4" style="color:#4c774a;">Membership Benefits</h2>
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="about-card h-100">
                      <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-crown fa-3x me-4" style="color:#ffcb47;"></i>
                        <div>
                          <h3 class="mb-1">GreenKart Premium</h3>
                          <p class="mb-0">₹999/year (₹83/month)</p>
                        </div>
                      </div>
                      <ul class="mb-4">
                        <li class="mb-2">10% discount on all orders</li>
                        <li class="mb-2">Free delivery on all orders</li>
                        <li class="mb-2">Early access to sales</li>
                        <li class="mb-2">Exclusive member-only products</li>
                        <li class="mb-2">Priority customer support</li>
                      </ul>
                      <button class="btn btn-warning w-100">Join Premium</button>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="about-card h-100">
                      <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-leaf fa-3x me-4" style="color:#4c774a;"></i>
                        <div>
                          <h3 class="mb-1">GreenKart Basic</h3>
                          <p class="mb-0">FREE Forever</p>
                        </div>
                      </div>
                      <ul class="mb-4">
                        <li class="mb-2">5% discount on orders above ₹1000</li>
                        <li class="mb-2">Free delivery on orders above ₹500</li>
                        <li class="mb-2">Weekly special offers</li>
                        <li class="mb-2">Personalized recommendations</li>
                        <li class="mb-2">Regular customer support</li>
                      </ul>
                      <button class="btn btn-success w-100">Sign Up Free</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Divider Line -->
            <div class="section-divider"></div>
            
            <!-- Coupon Codes -->
            <div class="row mb-5">
              <div class="col-12">
                <h2 class="mb-4" style="color:#4c774a;">Coupon Codes</h2>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="about-card text-center p-4">
                      <h4 class="mb-3">NEWUSER20</h4>
                      <p>20% off on first order</p>
                      <button class="btn btn-outline-success w-100">Copy Code</button>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-card text-center p-4">
                      <h4 class="mb-3">FREESHIP50</h4>
                      <p>Free shipping on orders above ₹500</p>
                      <button class="btn btn-outline-success w-100">Copy Code</button>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-card text-center p-4">
                      <h4 class="mb-3">WEEKEND15</h4>
                      <p>15% off on weekends</p>
                      <button class="btn btn-outline-success w-100">Copy Code</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="pt-5 pb-4 bg-dark text-white">
    <div class="container">
      <div class="row">
        <!-- Column 1: Quick Links -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4" style="color: #81b978;">Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('home-page'); return false;">Home</a></li>
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('about-section'); return false;">About Us</a></li>
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('products-section'); return false;">Products</a></li>
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('gallery-section'); return false;">Gallery</a></li>
            <li class="mb-2"><a href="#" class="text-white">Recipes</a></li>
            <li class="mb-2"><a href="#" class="text-white">Blog</a></li>
          </ul>
        </div>

        <!-- Column 2: Contact Info -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4" style="color: #81b978;">Contact Us</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Farm Fresh Lane, Organic City</li>
            <li class="mb-2"><i class="fas fa-phone me-2"></i> +91 9876543210</li>
            <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@greenkart.com</li>
            <li class="mb-2"><i class="fas fa-clock me-2"></i> Mon-Sat: 8AM - 8PM</li>
          </ul>
        </div>

        <!-- Column 3: Newsletter -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4" style="color: #81b978;">Newsletter</h5>
          <p>Subscribe for fresh updates and offers!</p>
          <form>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Your Email" aria-label="Your Email">
              <button class="btn btn-success" type="submit">Subscribe</button>
            </div>
          </form>
        </div>

        <!-- Column 4: Social Media -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4" style="color: #81b978;">Follow Us</h5>
          <div class="social-icons mb-4">
            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
          </div>
          <h6 class="text-uppercase mb-3" style="color: #81b978;">Payment Methods</h6>
          <div class="payment-methods">
            <i class="fab fa-cc-visa fa-2x me-2"></i>
            <i class="fab fa-cc-mastercard fa-2x me-2"></i>
            <i class="fab fa-cc-paypal fa-2x me-2"></i>
            <i class="fab fa-cc-amazon-pay fa-2x"></i>
          </div>
        </div>
      </div>

      <hr class="mb-4" style="border-color: rgba(255,255,255,0.1);">

      <!-- Copyright Row -->
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <p class="mb-0">&copy; 2024 GreenKart. All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="#" class="text-white">Privacy Policy</a></li>
            <li class="list-inline-item mx-2">•</li>
            <li class="list-inline-item"><a href="#" class="text-white">Terms of Service</a></li>
            <li class="list-inline-item mx-2">•</li>
            <li class="list-inline-item"><a href="#" class="text-white">Shipping Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
// ===== PAGE NAVIGATION =====
function showSection(sectionId) {
  // Hide all page sections
  document.querySelectorAll('.page-section').forEach(section => {
    section.style.display = 'none';
  });
  
  // Hide all gallery subsections when not in gallery
  if (sectionId !== 'gallery-section') {
    document.querySelectorAll('[id$="-subsection"]').forEach(section => {
      section.style.display = 'none';
    });
  }
  
  // Show the requested section
  const activeSection = document.getElementById(sectionId);
  if (activeSection) {
    activeSection.style.display = 'block';
    
    // Special handling for products page
    if (sectionId === 'products-section') {
      // Reset to default view when coming to products page
      resetProductDisplay();
    }
  }
  
  // Scroll to top
  window.scrollTo(0, 0);
}

// ===== GALLERY & PRODUCTS SYSTEM =====
function resetProductDisplay() {
  // Hide all product containers
  document.querySelectorAll('[id$="-products"]').forEach(container => {
    container.style.display = 'none';
  });
  
  // Hide all gallery subsections
  document.querySelectorAll('[id$="-subsection"]').forEach(section => {
    section.style.display = 'none';
  });
  
  // Show default products if needed (optional)
  // document.getElementById('default-products').style.display = 'block';
}

function showGallerySection(section) {
  // First ensure we're on products page
  showSection('products-section');
  
  // Then handle the gallery and products display
  handleGalleryAndProducts(section);
}

function handleGalleryAndProducts(section) {
  // 1. Hide ALL gallery subsections
  document.querySelectorAll('[id$="-subsection"]').forEach(el => {
    el.style.display = 'none';
  });
  
  // 2. Show CURRENT gallery subsection
  const currentGallery = document.getElementById(`${section}-subsection`);
  if (currentGallery) {
    currentGallery.style.display = 'block';
  }
  
  // 3. Hide ALL product containers
  document.querySelectorAll('[id$="-products"]').forEach(el => {
    el.style.display = 'none';
  });
  
  // 4. Show RELATED products with multiple fallbacks
  const productsContainer = document.getElementById(`${section}-products`);
  if (productsContainer) {
    // First try standard display
    productsContainer.style.display = 'grid';
    
    // Fallback 1: Check after render
    setTimeout(() => {
      if (window.getComputedStyle(productsContainer).display === 'none') {
        // Fallback 2: Try block display
        productsContainer.style.display = 'block';
        
        // Fallback 3: Force with important
        setTimeout(() => {
          if (window.getComputedStyle(productsContainer).display === 'none') {
            productsContainer.style.styleSheet = 'display: block !important';
          }
        }, 100);
      }
    }, 50);
  }
  
  // 5. Scroll to products section with smooth animation
  setTimeout(() => {
    const productsSection = document.getElementById('products-section');
    if (productsSection) {
      productsSection.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  }, 100);
}
function showCartModal() {
  const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
  renderCartItems();
  cartModal.show();
}

function renderCartItems() {
  const container = document.getElementById('cart-items-container');
  const totalElement = document.getElementById('cart-total');
  
  if (cart.length === 0) {
    container.innerHTML = `
      <div class="empty-cart-message text-center py-5">
        <i class="fas fa-shopping-cart fa-4x mb-3" style="color: #ddd;"></i>
        <h5>Your cart is empty</h5>
        <p>Start shopping to add items to your cart</p>
      </div>
    `;
    totalElement.textContent = '0';
    return;
  }
  
  let html = '';
  let total = 0;
  
  cart.forEach((item, index) => {
    const itemTotal = item.price * item.quantity;
    total += itemTotal;
    
    html += `
      <div class="cart-item row align-items-center mb-3">
        <div class="col-md-2">
          <img src="${item.image}" alt="${item.name}" class="img-fluid rounded" style="max-height: 80px;">
        </div>
        <div class="col-md-4">
          <h6 class="mb-1">${item.name}</h6>
          <p class="mb-0 text-muted">₹${item.price}</p>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, -1)">-</button>
            <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, 1)">+</button>
          </div>
        </div>
        <div class="col-md-2 text-end">
          <h6 class="mb-0">₹${itemTotal}</h6>
        </div>
        <div class="col-md-1 text-end">
          <button class="btn btn-link text-danger" onclick="removeFromCart(${index})">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
      <hr class="my-2">
    `;
  });
  
  container.innerHTML = html;
  totalElement.textContent = total;
}

function updateQuantity(index, change) {
  const newQuantity = cart[index].quantity + change;
  
  if (newQuantity < 1) {
    removeFromCart(index);
    return;
  }
  
  cart[index].quantity = newQuantity;
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCount();
  renderCartItems();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCount();
  renderCartItems();
}

function proceedToCheckout() {
  if (cart.length === 0) {
    alert('Your cart is empty!');
    return;
  }
  alert('Proceeding to checkout!'); // Replace with actual checkout page redirection
  // window.location.href = 'checkout.php';
}
// ===== BUTTON HANDLER SETUP =====
function setupGalleryButtons() {
  // Handle both onclick and data-attribute buttons
  document.querySelectorAll('[onclick*="showGallerySection"], [data-gallery-section]').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      
      let section;
      if (this.hasAttribute('onclick')) {
        const match = this.getAttribute('onclick').match(/showGallerySection\('(.+?)'\)/);
        if (match) section = match[1];
      } else {
        section = this.getAttribute('data-gallery-section');
      }
      
      if (section) {
        showGallerySection(section);
      }
    });
  });
}
// ===== CATEGORY NAVIGATION =====
function showCategory(category) {
  // First show the products section
  showSection('products-section');
  
  // Then show the specific category subsection
  setTimeout(() => {
    // Hide all category subsections first
    document.querySelectorAll('.category-subsection').forEach(section => {
      section.style.display = 'none';
    });
    
    // Show the selected category
    const categorySection = document.getElementById(`${category}-subsection`);
    if (categorySection) {
      categorySection.style.display = 'block';
      
      // Smooth scroll to the category section
      setTimeout(() => {
        categorySection.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }, 100);
    }
  }, 50);
}

// Update your existing showSection function to ensure it works with categories
function showSection(sectionId) {
  // Hide all page sections
  document.querySelectorAll('.page-section').forEach(section => {
    section.style.display = 'none';
  });
  
  // Show the requested section
  const activeSection = document.getElementById(sectionId);
  if (activeSection) {
    activeSection.style.display = 'block';
  }
  
  // Scroll to top
  window.scrollTo(0, 0);
}
// Cart functionality
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function updateCartCount() {
  const cartCount = document.getElementById('cart-count');
  if (cartCount) {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
  }
}

function addToCart(productName, price, image) {
  // Check if product already exists in cart
  const existingItem = cart.find(item => item.name === productName);
  
  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({
      name: productName,
      price: price,
      image: image,
      quantity: 1
    });
  }
  
  // Save to localStorage
  localStorage.setItem('cart', JSON.stringify(cart));
  
  // Update cart count
  updateCartCount();
  
  // Show added notification
  showCartNotification(productName);
}

function showCartNotification(productName) {
  const notification = document.createElement('div');
  notification.className = 'cart-notification';
  notification.innerHTML = `
    <span>${productName} added to cart!</span>
  `;
  document.body.appendChild(notification);
  
  // Animation
  setTimeout(() => {
    notification.style.opacity = '1';
    notification.style.transform = 'translateY(0)';
  }, 10);
  
  // Remove after delay
  setTimeout(() => {
    notification.style.opacity = '0';
    notification.style.transform = 'translateY(20px)';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', updateCartCount);

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
  showSection('home-page');
});
// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
  // Initialize page
  showSection('home-page');
  
  // Setup gallery buttons
  setupGalleryButtons();
  
  // Initialize product displays
  resetProductDisplay();
});
</script>
</body>
</html>