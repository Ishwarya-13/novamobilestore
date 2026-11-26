<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Nova Mobile — discover your next favourite smartphone.">
  <title>Nova Mobile — Find your next favourite</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="announcement"><span>✦</span> The future is in your hands <span class="announcement-divider">·</span> Free delivery on orders above ₹25,000</div>
  <header class="site-header">
    <a class="brand" href="#"><span class="brand-mark">N</span><span>NOVA<span class="brand-light">MOBILE</span></span></a>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="#shop">Shop all</a><a href="#collections">Collections</a><a href="#why-nova">Why Nova</a>
    </nav>
    <div class="header-actions">
      <button class="icon-btn search-toggle" aria-label="Search" title="Search">⌕</button>
      <button class="icon-btn" id="accountBtn" aria-label="Account" title="Account">♙</button>
      <button class="cart-button" id="cartOpen"><span class="cart-icon">♧</span><span>Bag</span><b id="cartCount">0</b></button>
      <button class="mobile-menu" id="mobileMenu" aria-label="Open menu">☰</button>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="hero-copy">
        <div class="eyebrow"><span class="eyebrow-line"></span> A smarter way to shop tech</div>
        <h1>Meet your<br><em>next</em> favourite.</h1>
        <p>Big ideas. Beautiful design. Brilliant technology. Find the phone that feels like it was made for you.</p>
        <div class="hero-actions"><a class="btn btn-primary" href="#shop">Explore phones <span>↗</span></a><a class="text-link" href="#collections">Discover collections <span>→</span></a></div>
        <div class="hero-proof"><div class="proof-avatars"><span>✦</span><span>●</span><span>◆</span></div><div><strong>4.9/5 customer love</strong><small>Thoughtfully chosen. Happily owned.</small></div></div>
      </div>
      <div class="hero-art">
        <div class="hero-orbit orbit-one"></div><div class="hero-orbit orbit-two"></div>
        <div class="hero-glow"></div>
        <img class="hero-phone" src="https://images.unsplash.com/photo-1598327105666-5e4a0f8b6b5a?auto=format&fit=crop&w=900&q=90" alt="Premium smartphone on a clean studio background">
        <div class="floating-note note-top"><span class="note-dot"></span><div><b>Made for more</b><small>Power meets possibility</small></div></div>
        <div class="floating-note note-bottom"><span class="note-icon">✧</span><div><b>New season edit</b><small>Fresh picks, just landed</small></div></div>
        <div class="hero-index">01 <span>/</span> 04</div>
      </div>
      <div class="hero-bottom"><span>SCROLL TO EXPLORE</span><span class="scroll-line"></span><span>CURATED TECH, CONSIDERED WELL.</span></div>
    </section>

    <section class="trust-strip" id="why-nova">
      <div><span class="trust-icon">◇</span><p><b>Genuine products</b><small>100% authentic devices</small></p></div>
      <div><span class="trust-icon">↗</span><p><b>Fast & free delivery</b><small>On qualifying orders</small></p></div>
      <div><span class="trust-icon">♡</span><p><b>Easy returns</b><small>Shop with confidence</small></p></div>
      <div><span class="trust-icon">⌁</span><p><b>Expert support</b><small>Here when you need us</small></p></div>
    </section>

    <section class="shop-section section-wrap" id="shop">
      <div class="section-heading">
        <div><div class="eyebrow"><span class="eyebrow-line"></span> THE NOVA EDIT</div><h2>Find your <em>kind</em> of phone.</h2><p>Handpicked devices for every way you live, create and connect.</p></div>
        <a class="text-link desktop-link" href="#shop">View all devices <span>→</span></a>
      </div>
      <div class="shop-toolbar">
        <div class="category-tabs" id="categoryTabs">
          <button class="category-tab active" data-category="all">All phones</button>
          <button class="category-tab" data-category="Apple">Apple</button>
          <button class="category-tab" data-category="Samsung">Samsung</button>
          <button class="category-tab" data-category="Google">Google</button>
          <button class="category-tab" data-category="OnePlus">OnePlus</button>
        </div>
        <div class="toolbar-right">
          <label class="search-box"><span>⌕</span><input id="searchInput" type="search" placeholder="Search phones..." aria-label="Search phones"></label>
          <select id="sortSelect" aria-label="Sort products"><option value="featured">Featured</option><option value="low">Price: low to high</option><option value="high">Price: high to low</option><option value="rating">Top rated</option></select>
        </div>
      </div>
      <div class="product-meta"><span id="productCount">Showing our favourites</span><span>Prices inclusive of all taxes</span></div>
      <div class="product-grid" id="productGrid">
        <div class="loading-state"><span class="loader"></span> Finding your next favourite...</div>
      </div>
    </section>

    <section class="feature-banner section-wrap" id="collections">
      <div class="feature-content"><div class="eyebrow light"><span class="eyebrow-line"></span> THE CREATOR COLLECTION</div><h2>More than a phone.<br><em>Your whole world.</em></h2><p>For the big moments, little details and everything in between. Explore devices built to keep up with you.</p><a href="#shop" class="btn btn-cream">Shop the collection <span>↗</span></a></div>
      <div class="feature-image"><img src="https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?auto=format&fit=crop&w=1000&q=85" alt="Modern smartphone camera close-up"></div>
      <div class="feature-watermark">N.</div>
    </section>

    <section class="newsletter section-wrap">
      <div><div class="eyebrow"><span class="eyebrow-line"></span> A LITTLE NOVA IN YOUR INBOX</div><h2>Good things are <em>coming.</em></h2><p>Get first dibs on new arrivals, thoughtful tech tips and member-only offers.</p></div>
      <form id="newsletterForm" class="newsletter-form"><label class="sr-only" for="newsletterEmail">Email address</label><input id="newsletterEmail" type="email" placeholder="Your email address" required><button type="submit">Keep me posted <span>→</span></button><small id="newsletterMessage">No noise. Just the good stuff.</small></form>
    </section>
  </main>

  <footer class="footer">
    <div class="footer-top"><a class="brand brand-footer" href="#"><span class="brand-mark">N</span><span>NOVA<span class="brand-light">MOBILE</span></span></a><p>Technology that feels a little more human.</p><div class="footer-social"><a href="#" aria-label="Instagram">ig</a><a href="#" aria-label="Pinterest">p</a><a href="#" aria-label="YouTube">▶</a></div></div>
    <div class="footer-bottom"><span>© 2026 Nova Mobile. Made for what’s next.</span><span>Privacy · Terms · Support</span><span>Designed with intention <b>✦</b></span></div>
  </footer>

  <div class="overlay" id="overlay"></div>
  <aside class="cart-drawer" id="cartDrawer" aria-label="Shopping bag">
    <div class="drawer-head"><div><span class="eyebrow">YOUR PICKS</span><h3>Your bag <span id="drawerCount">(0)</span></h3></div><button class="close-btn" id="cartClose" aria-label="Close cart">×</button></div>
    <div class="cart-items" id="cartItems"><div class="empty-cart"><span>♡</span><h4>Your bag is taking a little break.</h4><p>Find something you love and it’ll show up here.</p><button class="btn btn-primary" id="continueShopping">Explore phones</button></div></div>
    <div class="cart-footer"><div class="subtotal-row"><span>Subtotal</span><strong id="cartSubtotal">₹0</strong></div><small>Shipping and taxes calculated at checkout.</small><button class="btn btn-primary checkout-btn" id="checkoutBtn">Continue to checkout <span>→</span></button><div class="secure-note">♢ Secure checkout · Easy returns</div></div>
  </aside>

  <div class="modal" id="productModal" role="dialog" aria-modal="true" aria-label="Product details"><button class="close-btn modal-close" data-close="productModal">×</button><div id="productModalContent"></div></div>
  <div class="modal checkout-modal" id="checkoutModal" role="dialog" aria-modal="true" aria-label="Checkout"><button class="close-btn modal-close" data-close="checkoutModal">×</button><div class="checkout-inner"><div class="eyebrow"><span class="eyebrow-line"></span> ALMOST YOURS</div><h2>Let's make it <em>official.</em></h2><p class="modal-intro">Add your details and we’ll prepare your order.</p><form id="checkoutForm" class="checkout-form"><div class="form-row"><label>Full name<input name="customer_name" required placeholder="Your name"></label><label>Email address<input name="email" type="email" required placeholder="you@example.com"></label></div><label>Phone number<input name="phone" type="tel" required pattern="[0-9+\-\s]{10,15}" placeholder="+91 98765 43210"></label><label>Delivery address<textarea name="address" required rows="3" placeholder="House no., street, city, PIN code"></textarea></label><div class="checkout-total"><span>Order total</span><strong id="checkoutTotal">₹0</strong></div><button class="btn btn-primary checkout-submit" type="submit">Place order <span>→</span></button><small class="demo-note">Demo checkout: no payment is collected. Order details are saved to your local database.</small></form><div id="checkoutMessage" class="checkout-message"></div></div></div>
  <div class="toast" id="toast" role="status"></div>
  <script src="assets/app.js"></script>
</body>
</html>
