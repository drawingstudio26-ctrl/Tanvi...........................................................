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
/* Cart Notification Container */
.cart-notification {
  position: absolute; /* Changed from fixed to absolute */
  bottom: 100%; /* Position above the cart icon */
  right: 0; /* Align with right edge of cart icon */
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
  white-space: nowrap; /* Prevent text wrapping */
  margin-bottom: 10px; /* Space between notification and cart icon */
}

/* Arrow to connect notification to cart icon */
.cart-notification::after {
  content: '';
  position: absolute;
  bottom: -10px;
  right: 20px;
  border-width: 10px 10px 0;
  border-style: solid;
  border-color: #4c774a transparent transparent;
}

/* Container for cart icon - add this to your cart icon wrapper */
.cart-icon-container {
  position: relative;
  display: inline-block; /* Or whatever your cart icon uses */
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
/* Cart Notification Wrapper */
.cart-notification-wrapper {
  display: inline-block; /* Makes it fit around cart icon */
}

/* Cart Notification */
.cart-notification {
  position: absolute;
  bottom: 100%;
  right: 0;
  background-color: #4c774a;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  z-index: 9999;
  opacity: 0;
  transform: translateY(10px);
  transition: all 0.3s ease;
  white-space: nowrap;
  margin-bottom: 8px;
  pointer-events: none;
}

/* Arrow pointing to cart icon */
.cart-notification::after {
  content: '';
  position: absolute;
  bottom: -8px;
  right: 15px;
  border-width: 8px 8px 0;
  border-style: solid;
  border-color: #4c774a transparent transparent;
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
    /* Add this to your existing CSS */
.page-section {
    display: none; /* Hide all sections by default */
    padding-top: 80px; /* Account for fixed header */
    min-height: calc(100vh - 80px); /* Full viewport minus header */
}

/* Make sure these specific sections are visible when active */
#gallery-section,
#shop-section,
#offers-section,
#contact-section {
    display: block;
    opacity: 1;
    visibility: visible;
}

/* Fix for fixed header overlapping content */
main {
    padding-top: 80px; /* Match header height */
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
    /* Admin Panel Styles */
.admin-tab {
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.list-group-item.active {
  background-color: #4c774a;
  border-color: #4c774a;
}

#admin-section {
  display: none; /* Hidden by default, show only for admins */
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
    .page-section {
  display: none;
  padding-top: 80px; /* Account for fixed header */
  min-height: calc(100vh - 80px); /* Full viewport minus header */
}

/* Make sure these specific sections are visible when active */
#home-page,
#about-section,
#products-section,
#gallery-section,
#shop-section,
#offers-section,
#contact-section,
#admin-section {
  display: block;
  opacity: 1;
  visibility: visible;
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
    /* Ensure this is in your CSS */
.page-section {
    padding-top: 80px; /* Match your header height */
    min-height: calc(100vh - 80px); /* Full viewport height minus header */
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

<!-- Cart Notification (Add this near your cart icon in header) -->
<div class="cart-notification-wrapper position-relative">
  <div class="cart-notification">
    Item added to cart!
  </div>
  <!-- Your existing cart icon goes here -->
  <span class="cart-count-badge">0</span>
</div>
<!-- Enquiry Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 rounded-3">
      
      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="modal-header justify-content-center border-0 pt-4">
        <h3 id="enquiryModalLabel" class="modal-title fw-bold text-center">Customer Enquiry</h3>
      </div>

      <div class="modal-body px-4 pb-4">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs nav-fill border-bottom mb-4" id="enquiryTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active fw-medium" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-tab-pane" type="button" role="tab">New Inquiry</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-medium" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-tab-pane" type="button" role="tab">View Inquiries</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-medium" id="deleted-tab" data-bs-toggle="tab" data-bs-target="#deleted-tab-pane" type="button" role="tab">Deleted Inquiries</button>
          </li>
        </ul>

        <div class="tab-content" id="enquiryTabContent">
          <!-- New Inquiry Tab -->
          <div class="tab-pane fade show active" id="new-tab-pane" role="tabpanel" tabindex="0">
            <form id="enquiryForm">
              <div class="mb-3">
                <label for="enquiryName" class="form-label text-dark">Full Name</label>
                <input type="text" class="form-control border-1 border-secondary rounded-1" id="enquiryName" required>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="enquiryEmail" class="form-label text-dark">Email Address</label>
                  <input type="email" class="form-control border-1 border-secondary rounded-1" id="enquiryEmail" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="enquiryPhone" class="form-label text-dark">Phone Number</label>
                  <input type="tel" class="form-control border-1 border-secondary rounded-1" id="enquiryPhone">
                </div>
              </div>
              <div class="mb-3">
                <label for="enquirySubject" class="form-label text-dark">Subject</label>
                <input type="text" class="form-control border-1 border-secondary rounded-1" id="enquirySubject" required>
              </div>
              <div class="mb-3">
                <label for="enquiryMsg" class="form-label text-dark">Your Message</label>
                <textarea class="form-control border-1 border-secondary rounded-1" id="enquiryMsg" rows="4" required></textarea>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-dark py-2 fw-medium">Submit Inquiry</button>
              </div>
            </form>
          </div>
          
          <!-- View Inquiries Tab -->
          <div class="tab-pane fade" id="view-tab-pane" role="tabpanel" tabindex="0">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="m-0">Recent Inquiries</h5>
              <div class="d-flex">
                <input type="text" class="form-control form-control-sm me-2" placeholder="Search..." id="searchInquiries">
                <select class="form-select form-select-sm" id="filterStatus">
                  <option value="all">All Statuses</option>
                  <option value="new">New</option>
                  <option value="in-progress">In Progress</option>
                  <option value="resolved">Resolved</option>
                </select>
              </div>
            </div>
            
            <div class="table-responsive border rounded-2">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                  <tr>
                    <th class="py-3 ps-4">Name</th>
                    <th class="py-3">Subject</th>
                    <th class="py-3">Date</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 pe-4 text-end">Actions</th>
                  </tr>
                </thead>
                <tbody id="inquiryList">
                  <!-- Active inquiries will be dynamically inserted here -->
                </tbody>
              </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
              <div class="text-muted small">Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> inquiries</div>
              <div class="d-flex">
                <button class="btn btn-sm btn-outline-secondary me-2" id="prevPage">Previous</button>
                <button class="btn btn-sm btn-outline-secondary" id="nextPage">Next</button>
              </div>
            </div>
          </div>
          
          <!-- Deleted Inquiries Tab -->
          <div class="tab-pane fade" id="deleted-tab-pane" role="tabpanel" tabindex="0">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="m-0">Deleted Inquiries</h5>
              <div class="d-flex">
                <input type="text" class="form-control form-control-sm me-2" placeholder="Search..." id="searchDeletedInquiries">
              </div>
            </div>
            
            <div class="table-responsive border rounded-2">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                  <tr>
                    <th class="py-3 ps-4">Name</th>
                    <th class="py-3">Subject</th>
                    <th class="py-3">Date</th>
                    <th class="py-3">Deleted On</th>
                    <th class="py-3 pe-4 text-end">Actions</th>
                  </tr>
                </thead>
                <tbody id="deletedInquiryList">
                  <!-- Deleted inquiries will be dynamically inserted here -->
                </tbody>
              </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
              <div class="text-muted small">Showing <span id="deletedShowingCount">0</span> deleted inquiries</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Purchase Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="purchaseModalLabel">Complete Your Purchase</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="purchaseForm" action="index1.php" method="post">
          <input type="hidden" name="action" value="purchase">
          <input type="hidden" name="product_name" id="purchaseProductName">
          <input type="hidden" name="product_price" id="purchaseProductPrice">
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="first_name" required>
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="last_name" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
          </div>
          
          <div class="mb-3">
            <label for="address" class="form-label">Shipping Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="col-md-4">
              <label for="zip" class="form-label">ZIP Code</label>
              <input type="text" class="form-control" id="zip" name="zip" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="paymentMethod" class="form-label">Payment Method</label>
            <select class="form-select" id="paymentMethod" name="payment_method" required>
              <option value="">Select payment method</option>
              <option value="credit_card">Credit Card</option>
              <option value="debit_card">Debit Card</option>
              <option value="upi">UPI</option>
              <option value="net_banking">Net Banking</option>
              <option value="cod">Cash on Delivery</option>
            </select>
          </div>
          
          <div id="cardDetails" class="mb-3" style="display: none;">
            <div class="row">
              <div class="col-md-6">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="card_number">
              </div>
              <div class="col-md-3">
                <label for="expiryDate" class="form-label">Expiry Date</label>
                <input type="text" class="form-control" id="expiryDate" name="expiry_date" placeholder="MM/YY">
              </div>
              <div class="col-md-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv">
              </div>
            </div>
          </div>
          
          <div id="upiDetails" class="mb-3" style="display: none;">
            <label for="upiId" class="form-label">UPI ID</label>
            <input type="text" class="form-control" id="upiId" name="upi_id">
          </div>
          
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="termsCheck" required>
            <label class="form-check-label" for="termsCheck">
              I agree to the terms and conditions
            </label>
          </div>
          
          <button type="submit" class="btn btn-success w-100">Complete Purchase</button>
        </form>
      </div>
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
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Bananas', 49, 'Img/bananas.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Bananas', 49)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
        <div class="badge bg-warning mt-2">Best Seller</div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Apples.webp" alt="Shimla Apples" class="gallery-img">
        <h3>Shimla Apples</h3>
        <p>Crisp Himalayan apples with natural sweetness</p>
        <div class="price-tag">₹199/kg</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Shimla Apples', 199, 'Img/Apples.webp')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Shimla Apples', 199)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Papaya.jpg" alt="Red Lady Papaya" class="gallery-img">
        <h3>Papaya</h3>
        <p>Digestive-friendly tropical fruit</p>
        <div class="price-tag">₹59/kg</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Papaya', 59, 'Img/Papaya.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Papaya', 59)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
      </div>
    </div>

    <!-- Row 2 -->
    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Brocolli.jpg" alt="Fresh Broccoli" class="gallery-img">
        <h3>Fresh Broccoli</h3>
        <p>Nutrient-dense florets packed with vitamins</p>
        <div class="price-tag">₹79/head</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Fresh Broccoli', 79, 'Img/Brocolli.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Fresh Broccoli', 79)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Avocado.webp" alt="Hass Avocados" class="gallery-img">
        <h3>Hass Avocados</h3>
        <p>Creamy, nutrient-rich superfood packed with healthy fats</p>
        <div class="price-tag">₹179/piece</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Hass Avocados', 179, 'Img/Avocado.webp')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Hass Avocados', 179)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
        <div class="badge bg-primary mt-2">Superfood</div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Sweet Potato.jpg" alt="Sweet Potatoes" class="gallery-img">
        <h3>Sweet Potatoes</h3>
        <p>Orange-fleshed, rich in Vitamin A</p>
        <div class="price-tag">₹65/kg</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Sweet Potatoes', 65, 'Img/Sweet Potato.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Sweet Potatoes', 65)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
      </div>
    </div>
    <!-- Row 3: Grocery Staples -->
    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Almonds.jpg" alt="California Almonds" class="gallery-img">
        <h3>California Almonds</h3>
        <p>Raw, unpeeled - perfect for badam milk</p>
        <div class="price-tag">₹599/kg</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('California Almonds', 599, 'Img/Almonds.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('California Almonds', 599)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Honey.jpg" alt="Organic Honey" class="gallery-img">
        <h3>Organic Honey</h3>
        <p>100% pure forest honey from Nilgiris</p>
        <div class="price-tag">₹399/500g</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Honey', 399, 'Img/Honey.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Honey', 399)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
        <div class="badge bg-warning mt-2">Immunity Booster</div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="product-card">
        <img src="Img/Moong dal.jpg" alt="Organic Moong Dal" class="gallery-img">
        <h3>Organic Moong Dal</h3>
        <p>Hulled split green gram for khichdi/dosa</p>
        <div class="price-tag">₹129/kg</div>
        <div class="d-flex justify-content-between mt-2">
          <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Moong Dal', 129, 'Img/Moong dal.jpg')">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Moong Dal', 129)">
            <i class="bi bi-bag-check"></i> Buy Now
          </button>
        </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Alphonso Mangoes', 399, 'Img/Alphonso.webp')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Alphonso Mangoes', 399)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Pomegranates', 199, 'Img/Pomogranate.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Pomegranates', 199)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Sweet Corn', 49, 'Img/Corn.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Sweet Corn', 49)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Chikoo', 129, 'Img/Chikoo.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Chikoo', 129)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Lychees', 249, 'Img/Lychee.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Lychees', 249)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Jackfruit', 179, 'Img/Jackfruit.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Jackfruit', 179)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Muskmelon', 99, 'Img/Muskmelon.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Muskmelon', 99)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Watermelon', 49, 'Img/Watermelon.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Watermelon', 49)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Bitter Gourd', 69, 'Img/B.jpg')">
                <i class="bi bi-cart-plus"></i> Add to Cart
              </button>
              <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Bitter Gourd', 69)">
                <i class="bi bi-bag-check"></i> Buy Now
              </button>
            </div>
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
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Apples', 199, 'Img/Apples.webp')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Apples', 199)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
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
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Bananas', 49, 'Img/Bananas.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Bananas', 49)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 3 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Oran.jpg" alt="Nagpur Oranges" class="gallery-img">
          <h3>Nagpur Oranges</h3>
          <p>Juicy and vitamin C rich</p>
          <div class="price-tag">₹129/kg</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Nagpur Oranges', 129, 'Img/Oran.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Nagpur Oranges', 129)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 4 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Guav.webp" alt="Pink Guava" class="gallery-img">
          <h3>Pink Guava</h3>
          <p>Antioxidant-rich tropical fruit</p>
          <div class="price-tag">₹79/kg</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Pink Guava', 79, 'Img/Guav.webp')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Pink Guava', 79)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 5 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Pomogranate.jpg" alt="Pomegranate" class="gallery-img">
          <h3>Pomegranate</h3>
          <p>Ruby-red arils packed with antioxidants</p>
          <div class="price-tag">₹199/kg</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Pomegranate', 199, 'Img/Pomogranate.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Pomegranate', 199)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 6 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Gr.jpg" alt="Grapes" class="gallery-img">
          <h3>Grapes</h3>
          <p>Seedless, sweet and juicy</p>
          <div class="price-tag">₹149/kg</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Grapes', 149, 'Img/Gr.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Grapes', 149)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
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
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Mixed Nuts', 299, 'Img/Nuts.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Mixed Nuts', 299)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 2 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Granola.jpg" alt="Homemade Granola" class="gallery-img">
          <h3>Homemade Granola</h3>
          <p>With jaggery and dried fruits</p>
          <div class="price-tag">₹199/500g</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Homemade Granola', 199, 'Img/Granola.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Homemade Granola', 199)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 3 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Prot.jpg" alt="Protein Bars" class="gallery-img">
          <h3>Protein Bars</h3>
          <p>Plant-based, no added sugar</p>
          <div class="price-tag">₹99 each</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Protein Bars', 99, 'Img/Prot.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Protein Bars', 99)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 4 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Makh.jpg" alt="Roasted Makhana" class="gallery-img">
          <h3>Roasted Makhana</h3>
          <p>Lightly salted fox nuts</p>
          <div class="price-tag">₹149/200g</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Roasted Makhana', 149, 'Img/Makh.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Roasted Makhana', 149)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 5 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Mix.jpg" alt="Dry Fruit Mix" class="gallery-img">
          <h3>Dry Fruit Mix</h3>
          <p>Premium selection of 7 dry fruits</p>
          <div class="price-tag">₹399/500g</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Dry Fruit Mix', 399, 'Img/Mix.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Dry Fruit Mix', 399)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 6 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Energy.jpg" alt="Energy Balls" class="gallery-img">
          <h3>Energy Balls</h3>
          <p>Dates, nuts and cocoa power bites</p>
          <div class="price-tag">₹249/dozen</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Energy Balls', 249, 'Img/Energy.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Energy Balls', 249)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
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
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Tomatoes', 49, 'Img/Tomato.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Tomatoes', 49)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 2 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Carrot.webp" alt="Fresh Carrots" class="gallery-img">
          <h3>Fresh Carrots</h3>
          <p>Sweet and crunchy</p>
          <div class="price-tag">₹65/kg</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Fresh Carrots', 65, 'Img/Carrot.webp')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Fresh Carrots', 65)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
      <!-- Product 3 -->
      <div class="col-md-4 mb-4">
        <div class="product-card">
          <img src="Img/Ba.jpg" alt="Baby Spinach" class="gallery-img">
          <h3>Baby Spinach</h3>
          <p>Tender and nutrient-packed</p>
          <div class="price-tag">₹89/bunch</div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Baby Spinach', 89, 'Img/Ba.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Baby Spinach', 89)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/BellPeppers.avif" alt="Colored Capsicum" class="gallery-img">
            <h3>Colored Capsicum</h3>
            <p>Red, yellow and green mix</p>
            <div class="price-tag">₹199/kg</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Colored Capsicum', 199, 'Img/BellPeppers.avif')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Colored Capsicum', 199)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
      
            
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Brocolli.jpg" alt="Fresh Broccoli" class="gallery-img">
            <h3>Fresh Broccoli</h3>
            <p>Nutrient-dense florets</p>
            <div class="price-tag">₹79/head</div>
            <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Fresh Broccoli', 79, 'Img/Brocolli.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Fresh Broccoli', 79)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Bean.jpg" alt="French Beans" class="gallery-img">
            <h3>French Beans</h3>
            <p>Tender and stringless</p>
            <div class="price-tag">₹89/kg</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('French Beans', 89, 'Img/Bean.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('French Beans', 89)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
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
            <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Dried Mango', 249/200, 'Img/DrMa.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Dried Mango', 249/200)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
           
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/DrTo.jpg" alt="Sun-Dried Tomatoes" class="gallery-img">
            <h3>Sun-Dried Tomatoes</h3>
            <p>Intense flavor, perfect for pastas</p>
            <div class="price-tag">₹299/150g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Sun-Dried Tomatoes', 299/150, 'Img/DrTo.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Sun-Dried Tomatoes', 299/150)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Mushr.jpg" alt="Dried Mushrooms" class="gallery-img">
            <h3>Dried Mushrooms</h3>
            <p>Porcini and shiitake mix</p>
            <div class="price-tag">₹349/100g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Dried Mushrooms', 349/100, 'Img/Mushr.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Dried Mushrooms', 349/100)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/cran.webp" alt="Dried Cranberries" class="gallery-img">
            <h3>Dried Cranberries</h3>
            <p>Tart and sweet, great for baking</p>
            <div class="price-tag">₹199/200g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Dried Cranberries', 199/200, 'Img/cran.webp')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Dried Cranberries', 199/200)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Apri.jpg" alt="Dried Apricots" class="gallery-img">
            <h3>Dried Apricots</h3>
            <p>Soft and naturally sweet</p>
            <div class="price-tag">₹229/250g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Dried Apricots', 299/250, 'Img/Apri.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Dried Apricots', 299/250)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/DrCo.jpg" alt="Dried Coconut" class="gallery-img">
            <h3>Dried Coconut Chips</h3>
            <p>Crunchy and lightly salted</p>
            <div class="price-tag">₹149/150g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Dried Coconut', 149/150, 'Img/DrCo.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Dried Coconut', 149/150">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
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
           <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Quinoa', 499, 'Img/Quinoa.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Quinoa', 499)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/BaRi.jpeg" alt="Basmati Rice" class="gallery-img">
            <h3>Basmati Rice</h3>
            <p>Aged, long grain premium quality</p>
            <div class="price-tag">₹129/kg</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Basmati Rice', 129, 'Img/BaRi.jpeg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Basmati Rice', 129)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Oats.webp" alt="Rolled Oats" class="gallery-img">
            <h3>Rolled Oats</h3>
            <p>100% whole grain, perfect for porridge</p>
            <div class="price-tag">₹450/kg</div>
            <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Rolled Oats', 450, 'Img/Oats.webp')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Rolled Oats', 450)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/MiFl.jpg" alt="Millet Flour" class="gallery-img">
            <h3>Millet Flour</h3>
            <p>Gluten-free alternative for rotis</p>
            <div class="price-tag">₹89/kg</div>
            <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Millet Flour', 89, 'Img/MiFl.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Millet Flour', 89)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/WhWe.jpg" alt="Whole Wheat Flour" class="gallery-img">
            <h3>Whole Wheat Flour</h3>
            <p>Stone-ground, unbleached</p>
            <div class="price-tag">₹59/kg</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Whole Wheat Flour', 59, 'Img/WhWe.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Whole Wheat Flour', 59)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Mues.webp" alt="Sugar-Free Muesli" class="gallery-img">
            <h3>Sugar-Free Muesli</h3>
            <p>With nuts and dried fruits</p>
            <div class="price-tag">₹299/750g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Sugar-Free Muesli', 299/750, 'Img/Mues.webp')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Sugar-Free Muesli', 299/750)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
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
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Milk', 65, 'Img/Milk.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Milk', 65)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Paneer.jpg" alt="Fresh Paneer" class="gallery-img">
            <h3>Fresh Paneer</h3>
            <p>Homemade, soft and crumbly</p>
            <div class="price-tag">₹199/500g</div>
            <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Fresh Paneer', 199/500, 'Img/Paneer.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Fresh Paneer', 199/500)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Yogurt.avif" alt="Greek Yogurt" class="gallery-img">
            <h3>Greek Yogurt</h3>
            <p>High protein, creamy texture</p>
            <div class="price-tag">₹149/500g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Greek Yogurt', 149/500, 'Img/Yogurt.avif')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Greek Yogurt', 149/500)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 4 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Moze.jpg" alt="Mozzarella Cheese" class="gallery-img">
            <h3>Mozzarella Cheese</h3>
            <p>Perfect for pizzas and pastas</p>
            <div class="price-tag">₹249/200g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Mozzarella Cheese', 249/200, 'Img/Moze.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Mozzarella Cheese', 249/200)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        <!-- Product 5 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Butter.jpg" alt="White Butter" class="gallery-img">
            <h3>White Butter</h3>
            <p>Traditional homemade makhan</p>
            <div class="price-tag">₹299/500g</div>
             <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('White Butter', 299/500, 'Img/Butter.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('White Butter', 299/500)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
        </div>
      </div>
        
        <!-- Product 6 -->
        <div class="col-md-4 mb-4">
          <div class="product-card">
            <img src="Img/Ghee.jpg" alt="Pure Ghee" class="gallery-img">
            <h3>Pure Ghee</h3>
            <p>A2 Bilona method, rich aroma</p>
            <div class="price-tag">₹499/500g</div>
            <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Pure Ghee', 499/500, 'Img/Ghee.jpg')">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Pure Ghee', 499/500)">
              <i class="bi bi-bag-check"></i> Buy Now
            </button>
          </div>
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

<!-- View Offers Section -->
<div id="offers-section" class="page-section" style="display: none;">
  <div class="container py-5">
    <h1 class="display-4">Special Offers</h1>
    <p class="lead">Check out our latest discounts and exclusive deals!</p>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
          <img src="Img/offer1.jpg" class="card-img-top" alt="Offer 1">
          <div class="card-body">
            <h5 class="card-title">Buy 1 Get 1 Free</h5>
            <p class="card-text">Valid on selected fruits and snacks this week.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
          <img src="Img/offer2.jpg" class="card-img-top" alt="Offer 2">
          <div class="card-body">
            <h5 class="card-title">Flat 30% Off</h5>
            <p class="card-text">On organic dry fruits & nuts. Limited time only!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
        <input type="tel" class="form-control" id="contactPhone" name="phone">
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

<!-- Success Message Alert -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<script>
  alert("Thank you for your Submission!");
  if (window.history.replaceState) {
    const url = new URL(window.location);
    url.searchParams.delete('success');
    window.history.replaceState({}, document.title, url.pathname);
  }
</script>
<?php endif; ?>

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
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Mixed Fruits', 299, 'Img/Org.webp')">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                      </button>
                      <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Mixed Fruits', 299)">
                        <i class="bi bi-bag-check"></i> Buy Now
                      </button>
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
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Fresh Vegetable Box', 199, 'Img/V.jpg')">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                      </button>
                      <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Fresh Vegetable Box', 199)">
                        <i class="bi bi-bag-check"></i> Buy Now
                      </button>
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
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('California Almonds', 599, 'Img/Almonds.jpg')">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                      </button>
                      <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('California Almonds', 599)">
                        <i class="bi bi-bag-check"></i> Buy Now
                      </button>
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
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <button class="btn btn-success flex-grow-1 me-2" onclick="addToCart('Organic Forest Honey', 399, 'Img/Honey.jpg')">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                      </button>
                      <button class="btn btn-primary flex-grow-1" onclick="showPurchaseModal('Organic Forest Honey', 399)">
                        <i class="bi bi-bag-check"></i> Buy Now
                      </button>
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
    <!-- Admin Panel Section (only visible to admins) -->
<div id="admin-section" class="page-section">
  <div class="page-banner">
    <div class="page-banner-content">
      <h1 class="display-4">Admin Panel</h1>
      <p class="lead">Manage orders and products</p>
    </div>
  </div>

  <div class="container py-5">
    <div class="row">
      <div class="col-md-3">
        <div class="list-group mb-4">
          <a href="#" class="list-group-item list-group-item-action active" onclick="showAdminTab('orders')">Orders</a>
          <a href="#" class="list-group-item list-group-item-action" onclick="showAdminTab('products')">Products</a>
          <a href="#" class="list-group-item list-group-item-action" onclick="showAdminTab('customers')">Customers</a>
        </div>
      </div>
      
      <div class="col-md-9">
        <!-- Orders Tab -->
        <div id="orders-tab" class="admin-tab">
          <h2>Recent Orders</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Product</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="orders-table-body">
                <!-- Orders will be loaded here -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Products Tab -->
        <div id="products-tab" class="admin-tab" style="display: none;">
          <h2>Product Management</h2>
          <button class="btn btn-success mb-3" onclick="showAddProductModal()">Add New Product</button>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="products-table-body">
                <!-- Products will be loaded here -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Customers Tab -->
        <div id="customers-tab" class="admin-tab" style="display: none;">
          <h2>Customer List</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Orders</th>
                </tr>
              </thead>
              <tbody id="customers-table-body">
                <!-- Customers will be loaded here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addProductForm" action="index1.php" method="post">
          <input type="hidden" name="action" value="add_product">
          <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="product_name" required>
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="productPrice" name="product_price" required>
          </div>
          <div class="mb-3">
            <label for="productCategory" class="form-label">Category</label>
            <select class="form-select" id="productCategory" name="product_category" required>
              <option value="fruits">Fruits</option>
              <option value="vegetables">Vegetables</option>
              <option value="dairy">Dairy</option>
              <option value="snacks">Snacks</option>
              <option value="cereals">Cereals</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="productImage" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="productImage" name="product_image" required>
          </div>
          <div class="mb-3">
            <label for="productDescription" class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" name="product_description" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Save Product</button>
        </form>
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
// Global variables
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let currentPage = 1;
const itemsPerPage = 5;

// ===== PAGE NAVIGATION SYSTEM =====
function showSection(sectionId) {
  // Hide all page sections
  document.querySelectorAll('.page-section').forEach(section => {
    section.style.display = 'none';
  });
  
  // Show the requested section
  const activeSection = document.getElementById(sectionId);
  if (activeSection) {
    activeSection.style.display = 'block';
    
    // Special handling for products page
    if (sectionId === 'products-section') {
      resetProductDisplay();
    }
    
    // Special handling for admin section (hidden by default)
    if (sectionId === 'admin-section') {
      // Only show if admin (you can add your admin check logic here)
      // For now, we'll just show it when navigated to
      document.getElementById('admin-section').style.display = 'block';
    }
    
    // Scroll to section with offset for fixed header
    setTimeout(() => {
      window.scrollTo({
        top: activeSection.offsetTop - 80,
        behavior: 'smooth'
      });
    }, 50);
  }
}

// Initialize the page to show home section by default
document.addEventListener('DOMContentLoaded', function() {
  showSection('home-page');
  updateCartCount();
  
  // Set up event listeners for navigation links
  document.querySelectorAll('[onclick^="showSection"]').forEach(link => {
    link.addEventListener('click', function(e) {
      // Extract the section ID from the onclick attribute
      const sectionId = this.getAttribute('onclick').match(/showSection\('([^']+)'/)[1];
      showSection(sectionId);
      e.preventDefault();
    });
  });
});

// ===== PRODUCTS & GALLERY SYSTEM =====
function resetProductDisplay() {
  // Hide all category subsections
  document.querySelectorAll('.category-subsection').forEach(section => {
    section.style.display = 'none';
  });
}

function showCategory(category) {
  showSection('products-section');
  
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

// ===== CART FUNCTIONALITY =====
function updateCartCount() {
  const cartCount = document.getElementById('cart-count');
  if (cartCount) {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
  }
}

function addToCart(productName, price, image) {
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
  
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCount();
  showCartNotification(productName);
}

function showCartNotification(productName) {
  const notification = document.querySelector('.cart-notification');
  if (notification) {
    notification.textContent = `${productName} added to cart!`;
    
    // Animation
    notification.style.opacity = '1';
    notification.style.transform = 'translateY(0)';
    
    // Remove after delay
    setTimeout(() => {
      notification.style.opacity = '0';
      notification.style.transform = 'translateY(20px)';
    }, 3000);
  }
}

function showCartModal() {
  const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
  renderCartItems();
  cartModal.show();
}

function renderCartItems() {
  const container = document.getElementById('cart-items-container');
  const totalElement = document.getElementById('cart-total');
  
  if (!container || !totalElement) return;
  
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
  alert('Proceeding to checkout!');
}

// ===== PURCHASE FUNCTIONALITY =====
function showPurchaseModal(productName, productPrice) {
  const purchaseProductName = document.getElementById('purchaseProductName');
  const purchaseProductPrice = document.getElementById('purchaseProductPrice');
  
  if (purchaseProductName && purchaseProductPrice) {
    purchaseProductName.value = productName;
    purchaseProductPrice.value = productPrice;
    
    const purchaseModal = new bootstrap.Modal(document.getElementById('purchaseModal'));
    purchaseModal.show();
  }
}

// Initialize payment method visibility
document.addEventListener('DOMContentLoaded', function() {
  const paymentMethod = document.getElementById('paymentMethod');
  if (paymentMethod) {
    paymentMethod.addEventListener('change', function() {
      const paymentMethodValue = this.value;
      const cardDetails = document.getElementById('cardDetails');
      const upiDetails = document.getElementById('upiDetails');
      
      if (cardDetails) {
        cardDetails.style.display = 
          (paymentMethodValue === 'credit_card' || paymentMethodValue === 'debit_card') ? 'block' : 'none';
      }
      
      if (upiDetails) {
        upiDetails.style.display = 
          paymentMethodValue === 'upi' ? 'block' : 'none';
      }
    });
  }
  
  // Initialize purchase form submission
  const purchaseForm = document.getElementById('purchaseForm');
  if (purchaseForm) {
    purchaseForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const purchaseModal = bootstrap.Modal.getInstance(document.getElementById('purchaseModal'));
      if (purchaseModal) {
        purchaseModal.hide();
      }
      alert('Thank you for your purchase! Your order has been placed.');
      this.submit();
    });
  }
});

// ===== ENQUIRY SYSTEM =====
if (!localStorage.getItem('enquiries')) {
  localStorage.setItem('enquiries', JSON.stringify([]));
}
if (!localStorage.getItem('deletedEnquiries')) {
  localStorage.setItem('deletedEnquiries', JSON.stringify([]));
}

document.addEventListener('DOMContentLoaded', function() {
  const enquiryForm = document.getElementById('enquiryForm');
  if (enquiryForm) {
    enquiryForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const newEnquiry = {
        id: Date.now(),
        name: document.getElementById('enquiryName').value,
        email: document.getElementById('enquiryEmail').value,
        phone: document.getElementById('enquiryPhone').value || 'N/A',
        subject: document.getElementById('enquirySubject').value,
        message: document.getElementById('enquiryMsg').value,
        date: new Date().toISOString().split('T')[0],
        status: 'new'
      };
      
      const enquiries = JSON.parse(localStorage.getItem('enquiries'));
      enquiries.push(newEnquiry);
      localStorage.setItem('enquiries', JSON.stringify(enquiries));
      
      this.reset();
      alert('Your inquiry has been submitted successfully!');
      
      // Switch to view tab and refresh
      const viewTab = document.getElementById('view-tab');
      if (viewTab) {
        viewTab.click();
      }
      loadInquiries();
    });
  }

  // Initialize enquiry modal events
  const enquiryModal = document.getElementById('enquiryModal');
  if (enquiryModal) {
    enquiryModal.addEventListener('shown.bs.modal', function() {
      loadInquiries();
      loadDeletedInquiries();
    });
  }

  // Initialize search/filter events
  const searchInquiries = document.getElementById('searchInquiries');
  if (searchInquiries) {
    searchInquiries.addEventListener('input', function() {
      currentPage = 1;
      loadInquiries();
    });
  }

  const filterStatus = document.getElementById('filterStatus');
  if (filterStatus) {
    filterStatus.addEventListener('change', function() {
      currentPage = 1;
      loadInquiries();
    });
  }

  const searchDeletedInquiries = document.getElementById('searchDeletedInquiries');
  if (searchDeletedInquiries) {
    searchDeletedInquiries.addEventListener('input', loadDeletedInquiries);
  }

  // Initialize pagination
  const prevPage = document.getElementById('prevPage');
  const nextPage = document.getElementById('nextPage');
  
  if (prevPage) {
    prevPage.addEventListener('click', function() {
      if (currentPage > 1) {
        currentPage--;
        loadInquiries();
      }
    });
  }
  
  if (nextPage) {
    nextPage.addEventListener('click', function() {
      currentPage++;
      loadInquiries();
    });
  }
});

function loadInquiries() {
  const inquiryList = document.getElementById('inquiryList');
  if (!inquiryList) return;

  const enquiries = JSON.parse(localStorage.getItem('enquiries')) || [];
  const searchTerm = document.getElementById('searchInquiries')?.value.toLowerCase() || '';
  const filterStatus = document.getElementById('filterStatus')?.value || 'all';
  
  let filtered = enquiries.filter(enquiry => {
    const matchesSearch = enquiry.name.toLowerCase().includes(searchTerm) || 
                         enquiry.subject.toLowerCase().includes(searchTerm) ||
                         enquiry.message.toLowerCase().includes(searchTerm);
    const matchesStatus = filterStatus === 'all' || enquiry.status === filterStatus;
    return matchesSearch && matchesStatus;
  });

  const totalPages = Math.ceil(filtered.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const paginatedItems = filtered.slice(startIndex, startIndex + itemsPerPage);
  
  const showingCount = document.getElementById('showingCount');
  const totalCount = document.getElementById('totalCount');
  
  if (showingCount && totalCount) {
    showingCount.textContent = `${startIndex + 1}-${Math.min(startIndex + itemsPerPage, filtered.length)}`;
    totalCount.textContent = filtered.length;
  }
  
  inquiryList.innerHTML = '';
  
  if (paginatedItems.length === 0) {
    inquiryList.innerHTML = `
      <tr>
        <td colspan="5" class="text-center py-4 text-muted">
          <i class="fas fa-inbox fs-4"></i>
          <p class="mt-2 mb-0">No inquiries found</p>
        </td>
      </tr>
    `;
    return;
  }
  
  paginatedItems.forEach(enquiry => {
    const row = document.createElement('tr');
    let statusClass = '';
    if (enquiry.status === 'new') statusClass = 'bg-primary';
    else if (enquiry.status === 'in-progress') statusClass = 'bg-warning text-dark';
    else if (enquiry.status === 'resolved') statusClass = 'bg-success';
    
    row.innerHTML = `
      <td class="ps-4">
        <div class="fw-medium">${enquiry.name}</div>
        <div class="small text-muted">${enquiry.email}</div>
      </td>
      <td>
        <div class="fw-medium">${enquiry.subject}</div>
        <div class="small text-truncate" style="max-width: 200px;">${enquiry.message}</div>
      </td>
      <td class="small">${enquiry.date}</td>
      <td>
        <span class="badge ${statusClass} rounded-pill">${enquiry.status}</span>
      </td>
      <td class="pe-4 text-end">
        <button class="btn btn-sm btn-outline-dark me-2 view-btn" data-id="${enquiry.id}">
          <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${enquiry.id}">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    inquiryList.appendChild(row);
  });
  
  const prevPageBtn = document.getElementById('prevPage');
  const nextPageBtn = document.getElementById('nextPage');
  
  if (prevPageBtn) {
    prevPageBtn.disabled = currentPage === 1;
  }
  if (nextPageBtn) {
    nextPageBtn.disabled = currentPage === totalPages || totalPages === 0;
  }
  
  document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      viewInquiry(this.getAttribute('data-id'));
    });
  });
  
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      if (confirm('Are you sure you want to delete this inquiry?')) {
        deleteInquiry(this.getAttribute('data-id'));
      }
    });
  });
}

function loadDeletedInquiries() {
  const deletedInquiryList = document.getElementById('deletedInquiryList');
  if (!deletedInquiryList) return;

  const deletedEnquiries = JSON.parse(localStorage.getItem('deletedEnquiries')) || [];
  const searchTerm = document.getElementById('searchDeletedInquiries')?.value.toLowerCase() || '';
  
  const filtered = deletedEnquiries.filter(enquiry => {
    return enquiry.name.toLowerCase().includes(searchTerm) || 
           enquiry.subject.toLowerCase().includes(searchTerm) ||
           enquiry.message.toLowerCase().includes(searchTerm);
  });
  
  const deletedShowingCount = document.getElementById('deletedShowingCount');
  if (deletedShowingCount) {
    deletedShowingCount.textContent = filtered.length;
  }
  
  deletedInquiryList.innerHTML = '';
  
  if (filtered.length === 0) {
    deletedInquiryList.innerHTML = `
      <tr>
        <td colspan="5" class="text-center py-4 text-muted">
          <i class="fas fa-trash fs-4"></i>
          <p class="mt-2 mb-0">No deleted inquiries found</p>
        </td>
      </tr>
    `;
    return;
  }
  
  filtered.forEach(enquiry => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td class="ps-4">
        <div class="fw-medium">${enquiry.name}</div>
        <div class="small text-muted">${enquiry.email}</div>
      </td>
      <td>
        <div class="fw-medium">${enquiry.subject}</div>
        <div class="small text-truncate" style="max-width: 200px;">${enquiry.message}</div>
      </td>
      <td class="small">${enquiry.date}</td>
      <td class="small">${enquiry.deletedDate || 'N/A'}</td>
      <td class="pe-4 text-end">
        <button class="btn btn-sm btn-outline-success me-2 restore-btn" data-id="${enquiry.id}">
          <i class="fas fa-undo"></i> Restore
        </button>
        <button class="btn btn-sm btn-outline-danger permanent-delete-btn" data-id="${enquiry.id}">
          <i class="fas fa-trash"></i> Delete
        </button>
      </td>
    `;
    deletedInquiryList.appendChild(row);
  });
  
  document.querySelectorAll('.restore-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      restoreInquiry(this.getAttribute('data-id'));
    });
  });
  
  document.querySelectorAll('.permanent-delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      if (confirm('Permanently delete this inquiry?')) {
        permanentDeleteInquiry(this.getAttribute('data-id'));
      }
    });
  });
}

function viewInquiry(id) {
  const enquiries = JSON.parse(localStorage.getItem('enquiries')) || [];
  const enquiry = enquiries.find(e => e.id == id);
  
  if (enquiry) {
    alert(`Inquiry Details:\nName: ${enquiry.name}\nEmail: ${enquiry.email}\nPhone: ${enquiry.phone}\nSubject: ${enquiry.subject}\nMessage: ${enquiry.message}\nDate: ${enquiry.date}\nStatus: ${enquiry.status}`);
  }
}

function deleteInquiry(id) {
  let enquiries = JSON.parse(localStorage.getItem('enquiries')) || [];
  let deletedEnquiries = JSON.parse(localStorage.getItem('deletedEnquiries')) || [];
  
  const enquiryIndex = enquiries.findIndex(e => e.id == id);
  if (enquiryIndex !== -1) {
    const deletedEnquiry = enquiries[enquiryIndex];
    deletedEnquiry.deletedDate = new Date().toISOString().split('T')[0];
    deletedEnquiries.push(deletedEnquiry);
    
    enquiries.splice(enquiryIndex, 1);
    localStorage.setItem('enquiries', JSON.stringify(enquiries));
    localStorage.setItem('deletedEnquiries', JSON.stringify(deletedEnquiries));
    
    loadInquiries();
    loadDeletedInquiries();
  }
}

function restoreInquiry(id) {
  let enquiries = JSON.parse(localStorage.getItem('enquiries')) || [];
  let deletedEnquiries = JSON.parse(localStorage.getItem('deletedEnquiries')) || [];
  
  const enquiryIndex = deletedEnquiries.findIndex(e => e.id == id);
  if (enquiryIndex !== -1) {
    const restoredEnquiry = deletedEnquiries[enquiryIndex];
    delete restoredEnquiry.deletedDate;
    enquiries.push(restoredEnquiry);
    
    deletedEnquiries.splice(enquiryIndex, 1);
    localStorage.setItem('enquiries', JSON.stringify(enquiries));
    localStorage.setItem('deletedEnquiries', JSON.stringify(deletedEnquiries));
    
    loadInquiries();
    loadDeletedInquiries();
  }
}

function permanentDeleteInquiry(id) {
  let deletedEnquiries = JSON.parse(localStorage.getItem('deletedEnquiries')) || [];
  deletedEnquiries = deletedEnquiries.filter(e => e.id != id);
  localStorage.setItem('deletedEnquiries', JSON.stringify(deletedEnquiries));
  loadDeletedInquiries();
}

// ===== ADMIN PANEL =====
function showAdminTab(tabName) {
  document.querySelectorAll('.admin-tab').forEach(tab => {
    tab.style.display = 'none';
  });
  
  const tabElement = document.getElementById(`${tabName}-tab`);
  if (tabElement) {
    tabElement.style.display = 'block';
  }
  
  document.querySelectorAll('.list-group-item').forEach(item => {
    item.classList.remove('active');
  });
  
  if (event && event.target) {
    event.target.classList.add('active');
  }
  
  if (tabName === 'orders') loadOrders();
  else if (tabName === 'products') loadProducts();
  else if (tabName === 'customers') loadCustomers();
}

function loadOrders() {
  const tableBody = document.getElementById('orders-table-body');
  if (!tableBody) return;
  
  const orders = [
    { id: 1001, customer: 'John Doe', product: 'Organic Bananas', amount: '₹49', status: 'Processing' },
    { id: 1002, customer: 'Jane Smith', product: 'Shimla Apples', amount: '₹199', status: 'Shipped' },
    { id: 1003, customer: 'Bob Johnson', product: 'Fresh Broccoli', amount: '₹79', status: 'Delivered' }
  ];
  
  tableBody.innerHTML = '';
  
  orders.forEach(order => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${order.id}</td>
      <td>${order.customer}</td>
      <td>${order.product}</td>
      <td>${order.amount}</td>
      <td>${order.status}</td>
      <td>
        <button class="btn btn-sm btn-primary">View</button>
        <button class="btn btn-sm btn-success">Update</button>
      </td>
    `;
    tableBody.appendChild(row);
  });
}

function loadProducts() {
  const tableBody = document.getElementById('products-table-body');
  if (!tableBody) return;
  
  const products = [
    { id: 1, name: 'Organic Bananas', price: '₹49', category: 'fruits' },
    { id: 2, name: 'Shimla Apples', price: '₹199', category: 'fruits' },
    { id: 3, name: 'Fresh Broccoli', price: '₹79', category: 'vegetables' }
  ];
  
  tableBody.innerHTML = '';
  
  products.forEach(product => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${product.id}</td>
      <td>${product.name}</td>
      <td>${product.price}</td>
      <td>${product.category}</td>
      <td>
        <button class="btn btn-sm btn-primary">Edit</button>
        <button class="btn btn-sm btn-danger">Delete</button>
      </td>
    `;
    tableBody.appendChild(row);
  });
}

function loadCustomers() {
  const tableBody = document.getElementById('customers-table-body');
  if (!tableBody) return;
  
  const customers = [
    { id: 1, name: 'John Doe', email: 'john@example.com', phone: '9876543210', orders: 5 },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com', phone: '8765432109', orders: 3 },
    { id: 3, name: 'Bob Johnson', email: 'bob@example.com', phone: '7654321098', orders: 2 }
  ];
  
  tableBody.innerHTML = '';
  
  customers.forEach(customer => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${customer.id}</td>
      <td>${customer.name}</td>
      <td>${customer.email}</td>
      <td>${customer.phone}</td>
      <td>${customer.orders}</td>
    `;
    tableBody.appendChild(row);
  });
}

function showAddProductModal() {
  const modal = new bootstrap.Modal(document.getElementById('addProductModal'));
  modal.show();
}

// Initialize admin panel
document.addEventListener('DOMContentLoaded', function() {
  // Set up admin tab switching
  document.querySelectorAll('.list-group-item').forEach(item => {
    item.addEventListener('click', function() {
      const tabName = this.textContent.trim().toLowerCase().replace(' ', '-');
      showAdminTab(tabName);
    });
  });
  
  // Initialize the first tab
  showAdminTab('orders');
  
  // Set up add product form
  const addProductForm = document.getElementById('addProductForm');
  if (addProductForm) {
    addProductForm.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Product added successfully!');
      const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
      if (modal) {
        modal.hide();
      }
      loadProducts();
    });
  }
});
</script>

<script>
  function showSection(sectionId) {
    const sections = document.querySelectorAll('.page-section');
    sections.forEach(section => {
      section.style.display = (section.id === sectionId) ? 'block' : 'none';
    });
    window.scrollTo(0, 0);
  }
  document.addEventListener("DOMContentLoaded", () => {
    showSection('home-section'); // Show default
  });
</script>
</body>
</html>