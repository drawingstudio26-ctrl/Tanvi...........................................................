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
    header {
      background-color: #c2e7b0;
      padding: 0.75rem 1rem;
    }
    header .nav-item .nav-link {
      background: #a3d39c;
      color: #fff;
      margin: 0 0.5rem;
      padding: 0.5rem 1rem;
      border-radius: 30px;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    header .nav-item .nav-link:hover {
      background: #81b978;
      transform: translateY(-3px);
    }
    header .nav-item:last-child .nav-link {
      background: #ffcb47;
      color: #fff;
      margin-left: auto;
    }
    header .nav-item:last-child .nav-link:hover {
      background: #ffb700;
    }
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
    .section-content {
      padding: 50px;
      text-align: center;
    }
    .section-content h2 {
      color: #81b978;
      margin-bottom: 30px;
    }
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
    header ul.nav {
      width: 100%;
      justify-content: center;
      gap: 20px;
      align-items: center;
    }
    header ul.nav .nav-item:last-child {
      margin-left: auto;
    }
    .testimonial-img {
      width: 275px;
      height: 183px;
      object-fit: cover;
      display: block;
      margin-bottom: 10px;
    }
    .team-img {
      width: 275px;
      height: 183px;
      object-fit: cover;
      display: block;
      margin-bottom: 10px;
    }
    /* About Section */
    .about-img {
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .about-card {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      height: 100%;
    }
    .section-divider {
      border-top: 1px solid #000;
      margin: 40px auto;
      width: 80%;
    }
    /* Gallery Section */
    .gallery-img {
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      height: 200px;
      object-fit: cover;
      width: 100%;
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

    /* ===== NEW ADDITIONS FOR PAGE SYSTEM ===== */
    /* Core layout structure */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    main {
      flex: 1;
      padding-bottom: 80px;
    }
    
    /* Page transition system */
    .page-section {
      display: none; /* Hidden by default */
      padding-top: 20px;
    }
    #about-section {
  background-color: orange;
  padding: 20px; /* Optional: Adds spacing inside the orange background */
}
    
    /* Footer styling */
    footer {
      width: 100%;
      background-color: #212529;
      color: white;
      padding: 2rem 0;
      margin-top: auto; /* Pushes footer to bottom */
      z-index: 100;
    }
  /* Product Modal Styles */
  .product-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    overflow: auto;
  }
  
  .modal-content {
    background: white;
    margin: 5% auto;
    padding: 20px;
    border-radius: 10px;
    max-width: 800px;
    width: 90%;
    animation: modalopen 0.5s;
  }
  
  @keyframes modalopen {
    from {opacity: 0; transform: translateY(-50px)}
    to {opacity: 1; transform: translateY(0)}
  }
  
  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    margin-bottom: 15px;
  }
  
  .close-modal {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
  }
  
  .modal-body {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .modal-image {
    flex: 1;
    min-width: 300px;
  }
  
  .modal-image img {
    width: 100%;
    border-radius: 8px;
  }
  
  .modal-details {
    flex: 1;
    min-width: 300px;
  }
  
  .quantity-selector {
    display: flex;
    align-items: center;
    margin: 15px 0;
  }
  
  .quantity-btn {
    width: 30px;
    height: 30px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .quantity-input {
    width: 50px;
    text-align: center;
    margin: 0 10px;
  }
  
  .add-to-cart-btn {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    width: 100%;
  }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="d-flex align-items-center">
    <a href="#" class="d-flex align-items-center text-decoration-none" onclick="showSection('home-page'); return false;">
      <img src="Img/7.jpg" alt="Logo" width="80" height="80" class="rounded-circle me-3">
      <h1 class="text-dark m-0">GreenKart</h1>
    </a>

    <nav class="flex-grow-1">
      <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('home-page'); return false;">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('about-section'); return false;">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('gallery-section'); return false;">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="">Contact</a></li>
        <li class="nav-item"><a class="nav-link">Shop Now</a></li>
        <li class="nav-item"><a class="nav-link">View Offers</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquiry</a></li>
      </ul>
    </nav>
  </header>

  <!-- Modal -->
  <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-4">
        <h5 id="enquiryModalLabel">Enquiry</h5>
        <form>
          <div class="mb-3">
            <label for="enquiryName" class="form-label">Name</label>
            <input id="enquiryName" class="form-control" type="text">
          </div>
          <div class="mb-3">
            <label for="enquiryEmail" class="form-label">Email</label>
            <input id="enquiryEmail" class="form-control" type="email">
          </div>
          <div class="mb-3">
            <label for="enquiryMsg" class="form-label">Message</label>
            <textarea id="enquiryMsg" class="form-control" rows="4"></textarea>
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
        <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
      </section>

      <!-- Your Original Content Section -->
      <section class="section-content">
        <h2 style="color: #4CAF50;">Shop Our Fresh Selections</h2>
        <div class="food-cards row">
          <div class="col-md-4">
            <div class="card">
              <img src="Img/Org.webp" class="card-img-top" alt="Fruits">
              <div class="card-body">
                <h5>Organic Fruits</h5>
                <p>Sweet, rich, and full of flavor.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <img src="Img/Snacks.jpg" class="card-img-top" alt="Healthy Snacks">
              <div class="card-body">
                <h5>Healthy Snacks</h5>
                <p>Guilt-free treats for you and your family.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <img src="Img/V.jpg" class="card-img-top" alt="Fresh Vegetables">
              <div class="card-body">
                <h5>Fresh Vegetables</h5>
                <p>Hand-picked for maximum flavor and nutrients.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <img src="Img/Dried.jpg" class="card-img-top" alt="Dried Foods">
              <div class="card-body">
                <h5>Dried Foods</h5>
                <p>Healthy, rich in fiber and texture.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <img src="Img/Cere.jpg" class="card-img-top" alt="Cereals">
              <div class="card-body">
                <h5>Cereals & Grains</h5>
                <p>Start your day strong with these essentials.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
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
<!-- GreenKart Grocery Delivery Video Section -->
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

      <!-- Your Original Testimonials Section -->
      <section id="testimonials" class="py-5 text-center bg-warning">
        <div class="container">
          <h2>Testimonials</h2>
          <div class="row gy-4">
            <div class="col-md-4">
              <img src="Img/Sanya.jpg" class="testimonial-img">
              <blockquote>"GreenKart is a game-changer! So convenient, healthy, and reliable!"</blockquote>
              <p>- Sanya, Mumbai</p>
            </div>
            <div class="col-md-4">
              <img src="Img/An.webp" class="testimonial-img">
              <blockquote>"Excellent service and high-caliber products, directly from the farm!"</blockquote>
              <p>- Anil, Pune</p>
            </div>
            <div class="col-md-4">
              <img src="Img/i.jpg" class="testimonial-img">
              <blockquote>"Affordable pricing without compromising on quality — that's what we love!"</blockquote>
              <p>- Priya, Delhi</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Divider Line -->
      <div class="section-divider"></div>

      <!-- Your Original Team Section -->
      <section id="team" class="py-5 text-center bg-warning">
        <div class="container">
          <h2>Meet Our Team</h2>
          <div class="row gy-4">
            <div class="col-md-4">
              <img src="Img/T11.jpg" alt="Team Member 1" class="img-fluid rounded-circle mb-3">
              <h5>Tanya Gupta</h5>
              <p>Founder</p>
            </div>
            <div class="col-md-4">
              <img src="Img/T22.jpg" alt="Team Member 2" class="img-fluid rounded-circle mb-3">
              <h5>Anika Mehra</h5>
              <p>Operations Head</p>
            </div>
            <div class="col-md-4">
              <img src="Img/T33.webp" alt="Team Member 3" class="img-fluid rounded-circle mb-3">
              <h5>Pooja Patel</h5>
              <p>Product Sourcing Specialist</p>
            </div>
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
      <div class="container">
        <!-- Hero Section -->
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
        <!-- Divider Line -->
        <div class="section-divider"></div>

        <!-- Mission & Values -->
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
        <!-- Divider Line -->
        <div class="section-divider"></div>

        <!-- Farm to Fork Process -->
        <div class="text-center mb-5">
          <h2 class="mb-4" style="color:#4c774a;">From Our Farms to Your Home</h2>
          <div class="row">
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
            <div class="col-md-3">
              <img src="Img/Eco.png" class="about-img rounded-circle" style="width:150px;height:150px;object-fit:cover">
              <h4>Eco Delivery</h4>
              <p>Carbon-neutral shipping to your doorstep</p>
            </div>
          </div>
        </div>
        <!-- Divider Line -->
        <div class="section-divider"></div>
        <!-- Impact Stats -->
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
        <!-- Divider Line -->
        <div class="section-divider"></div>
        <!-- Divider Line -->
        <div class="section-divider"></div>
      </div>
    </div>

    <!-- Gallery Section -->
    <div id="gallery-section" class="page-section">
  <div style="background-color:rgb(135, 171, 228); padding: 3rem 0;">
      <div class="container">
        <!-- Gallery Header -->
        <div class="text-center mb-5">
          <h1 class="display-4" style="color:black;">Our Product Gallery</h1>
          <p class="lead">Explore our farm-fresh products and seasonal specials</p>
        </div>

        <!-- Product Showcase -->
        <!-- Vegetarian Products Showcase -->
        <div class="text-center mb-5">
          <h2 class="mb-4" style="color:#4c774a;">Pure Vegetarian Essentials</h2>
          <div class="row">
            <!-- Row 1: Fruits -->
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/bananas.jpg" alt="Organic Bananas" class="gallery-img">
                <h3>Organic Bananas</h3>
                <p>Ripe, potassium-rich bananas from Kerala farms</p>
                <div class="price-tag">₹49/dozen</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
                <div class="badge bg-warning mt-2">Best Seller</div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Apples.webp" alt="Shimla Apples" class="gallery-img">
                <h3>Shimla Apples</h3>
                <p>Crisp Himalayan apples with natural sweetness</p>
                <div class="price-tag">₹199/kg</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Papaya.jpg" alt="Red Lady Papaya" class="gallery-img">
                <h3>Papaya</h3>
                <p>Digestive-friendly tropical fruit</p>
                <div class="price-tag">₹59/kg</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
              </div>
            </div>

            <!-- Row 2 -->
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Brocolli.jpg" alt="Fresh Broccoli" class="gallery-img">
                <h3>Fresh Broccoli</h3>
                <p>Nutrient-dense florets packed with vitamins</p>
                <div class="price-tag">₹79/head</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Avocado.webp" alt="Hass Avocados" class="gallery-img">
                <h3>Hass Avocados</h3>
                <p>Creamy, nutrient-rich superfood packed with healthy fats</p>
                <div class="price-tag">₹179/piece</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
                <div class="badge bg-primary mt-2">Superfood</div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Sweet Potato.jpg" alt="Sweet Potatoes" class="gallery-img">
                <h3>Sweet Potatoes</h3>
                <p>Orange-fleshed, rich in Vitamin A</p>
                <div class="price-tag">₹65/kg</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
              </div>
            </div>
            <!-- Row 3: Grocery Staples -->
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Almonds.jpg" alt="California Almonds" class="gallery-img">
                <h3>California Almonds</h3>
                <p>Raw, unpeeled - perfect for badam milk</p>
                <div class="price-tag">₹599/kg</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
              </div>
            </div>
  

            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Honey.jpg" alt="Organic Honey" class="gallery-img">
                <h3>Organic Honey</h3>
                <p>100% pure forest honey from Nilgiris</p>
                <div class="price-tag">₹399/500g</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
                <div class="badge bg-warning mt-2">Immunity Booster</div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Moong dal.jpg" alt="Organic Moong Dal" class="gallery-img">
                <h3>Organic Moong Dal</h3>
                <p>Hulled split green gram for khichdi/dosa</p>
                <div class="price-tag">₹129/kg</div>
                <button class="btn btn-success mt-2">Add to Cart</button>
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
            <!-- Row 1 -->
            <!-- Alphonso Mangoes -->
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Alphonso.webp" alt="Alphonso Mangoes" class="gallery-img">
                <h3>Alphonso Mangoes</h3>
                <p>The king of fruits, available April-June</p>
                <div class="price-tag">₹399/kg</div>
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
                <div class="badge bg-info mt-2">Seasonal: Mar-Jun</div>
              </div>
            </div>

            <!-- Row 2 -->
            <!-- Sapota (Chikoo) -->
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Chikoo.jpg" alt="Chikoo" class="gallery-img">
                <h3>Chikoo</h3>
                <p>Sweet, grainy winter fruit perfect for desserts</p>
                <div class="price-tag">₹129/kg</div>
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
                <div class="badge bg-info mt-2">Seasonal: Mar-Jun</div>
              </div>
            </div>

            <!-- Row 3 -->
            <!-- Muskmelon -->
            <div class="col-md-4 mb-4">
              <div class="product-card">
                <img src="Img/Muskmelon.jpg" alt="Muskmelon" class="gallery-img">
                <h3>Muskmelon</h3>
                <p>Hydrating summer fruit with delicate aroma</p>
                <div class="price-tag">₹99/piece</div>
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
        <div class="badge bg-info mt-2">Seasonal: Jun-Sep</div>
      </div>
    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Product Modal -->
<div id="productModal" class="product-modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 id="modalProductName">Product Name</h2>
      <span class="close-modal">&times;</span>
    </div>
    <div class="modal-body">
      <div class="modal-image">
        <img id="modalProductImage" src="" alt="Product Image">
      </div>
      <div class="modal-details">
        <p id="modalProductDesc">Product description goes here...</p>
        <div class="price-tag" id="modalProductPrice">₹0</div>
        <div class="badges" id="modalProductBadges"></div>
        
        <div class="quantity-selector">
          <button class="quantity-btn minus">-</button>
          <input type="number" class="quantity-input" value="1" min="1">
          <button class="quantity-btn plus">+</button>
        </div>
        
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
    </div>
  </div>
</div>
  </main>
  <!-- Footer (Now appears on all pages) -->
  <footer class="pt-5 pb-4 bg-dark text-white">
    <div class="container">
      <div class="row">
        <!-- Column 1: Quick Links -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4" style="color: #81b978;">Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('home-page'); return false;">Home</a></li>
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('about-section'); return false;">About Us</a></li>
            <li class="mb-2"><a href="#" class="text-white" onclick="showSection('gallery-section'); return false;">Products</a></li>
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
  
  <!-- Updated JavaScript for Page Navigation -->
  <script>
    // Function to show only one section at a time
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

    // Initialize - show home page by default
    document.addEventListener('DOMContentLoaded', function() {
      showSection('home-page');
    }
  // Product Modal Functionality
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('productModal');
    const productCards = document.querySelectorAll('.product-card');
    
    // Open modal when product is clicked
    productCards.forEach(card => {
      card.addEventListener('click', function(e) {
        if(e.target.tagName !== 'BUTTON') { // Don't open if clicking Add to Cart
          const img = card.querySelector('img');
          const title = card.querySelector('h3').textContent;
          const desc = card.querySelector('p').textContent;
          const price = card.querySelector('.price-tag').textContent;
          const badges = card.querySelectorAll('.badge');
          
          document.getElementById('modalProductName').textContent = title;
          document.getElementById('modalProductImage').src = img.src;
          document.getElementById('modalProductImage').alt = img.alt;
          document.getElementById('modalProductDesc').textContent = desc;
          document.getElementById('modalProductPrice').textContent = price;
          
          const badgesContainer = document.getElementById('modalProductBadges');
          badgesContainer.innerHTML = '';
          badges.forEach(badge => {
            badgesContainer.innerHTML += `<div class="badge ${badge.className}">${badge.textContent}</div>`;
          });
          
          modal.style.display = 'block';
        }
      });
    });
    
    // Close modal
    document.querySelector('.close-modal').addEventListener('click', function() {
      modal.style.display = 'none';
    });
    
    // Close when clicking outside modal
    window.addEventListener('click', function(e) {
      if(e.target == modal) {
        modal.style.display = 'none';
      }
    });
    
    // Quantity selector
    document.querySelectorAll('.quantity-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.quantity-input');
        if(this.classList.contains('minus')) {
          input.value = Math.max(1, input.value - 1);
        } else {
          input.value = parseInt(input.value) + 1;
        }
      });
    });
  }););
  </script>
</body>
</html>