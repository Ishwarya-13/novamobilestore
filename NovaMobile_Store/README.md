# Nova Mobile — PHP + MySQL E-commerce Website

A responsive smartphone storefront using HTML, CSS, vanilla JavaScript, PHP and MySQL. The visual palette follows the supplied reference image: deep navy `#00105B`, periwinkle `#6060B5`, soft lavender `#C9B6E0`, and warm cream `#FAF8EC`.

## Features
- Premium responsive storefront and mobile navigation
- Product cards with search, brand filters and sorting
- Product quick-view modal
- Shopping bag with quantity controls (saved in browser localStorage)
- Checkout form that creates orders and order items in MySQL
- Stock validation and stock decrement inside a database transaction
- Newsletter subscription endpoint
- Prepared statements with PDO for database writes
- Demo catalogue fallback if the API/database is not available

## Requirements
- XAMPP / WAMP / MAMP (Apache, PHP 8+, MySQL)
- A modern browser
- Internet connection for Google Fonts and the externally hosted Unsplash product photography

## Run locally with XAMPP
1. Extract the `NovaMobile_Store` folder into `C:\xampp\htdocs\`.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Choose **Import**, select `database.sql` from this folder, and click **Import**. This creates the `nova_mobile` database and sample products.
5. Open `config/database.php`. The default XAMPP settings are `root` with an empty password. Change these if your MySQL credentials differ.
6. Visit `http://localhost/NovaMobile_Store/`.

Do not open `index.php` by double-clicking it; PHP must run through Apache.

## Project structure
```text
NovaMobile_Store/
├── index.php
├── database.sql
├── README.md
├── config/
│   └── database.php
├── api/
│   ├── products.php
│   ├── orders.php
│   └── newsletter.php
└── assets/
    ├── style.css
    └── app.js
```

## Where to customise
- **Products, prices, stock and image URLs:** edit the `INSERT INTO products` rows in `database.sql`, or update the `products` table in phpMyAdmin.
- **Database login:** `config/database.php`
- **Colours and layout:** `assets/style.css` (`:root` variables near the top)
- **Cart, filters, checkout interactions:** `assets/app.js`
- **Store content and sections:** `index.php`

## Important notes before real deployment
- This is a learning/demo store, not a production payment integration. The checkout records an order but does not collect payment.
- Add an authenticated admin panel, CSRF protection, rate limiting, server-side address validation, email notifications, HTTPS, privacy/terms pages and a trusted payment gateway before taking real orders.
- Change the default database credentials and keep secrets outside the public web root in production.
- Product photography is loaded from Unsplash image CDN URLs, so an internet connection is needed to display those photos. Replace image URLs with your licensed product photos when launching a real store.

## Learning references
The project uses standard HTML/CSS/JavaScript patterns and PHP PDO prepared statements. Useful official references:
- MDN Web Docs: https://developer.mozilla.org/en-US/docs/Web
- PHP PDO: https://www.php.net/manual/en/book.pdo.php
- PHP prepared statements: https://www.php.net/manual/en/pdo.prepared-statements.php
- Unsplash image API and image delivery documentation: https://unsplash.com/documentation
- Unsplash API image guidelines: https://help.unsplash.com/en/articles/2511245-unsplash-api-guidelines

The Unsplash URLs in the sample catalogue are remote image URLs. For a public app using the Unsplash API itself, follow its API and attribution requirements; for a commercial product catalogue, use images you own or are licensed to use.
