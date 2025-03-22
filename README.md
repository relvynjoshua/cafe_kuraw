<div align="center">
  <img src="/cafe_kuraw/public/img/kuraw_logo.jpg" alt="Kuraw logo" width="200" height="auto" />
  <h1>Kuraw Coffee Shop System</h1>
  <p>Web and Mobile Management Information System </p>
</div>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Overview 

The **Web and Mobile Management Information System for Kuraw Coffee Shop** is a comprehensive platform designed for both web and mobile users. It allows customers to place orders, reserve tables, and browse the café’s menu with ease. Given the café’s limited space and parking, the reservation feature enhances customer convenience. 

The system consists of two platforms:

- 🌐 **Web Application** – Provides an intuitive interface for customers, cashiers, and administrators to interact with the system.
- 📱 **Mobile Application** – Built with React Native, offering seamless order placement and reservations on the go.

The platform supports three user roles:
- 🍽️ **Customers** – Order food for pickup or delivery, reserve tables, and explore café details.
- 👨‍💼 **Admins** – Manage orders, track sales trends, generate reports, oversee inventory, and handle user access.
- 🤝 **Cashiers** – Process in-store orders via the POS system and manage customer reservations.

This system streamlines café operations, enhances user experience, and optimizes business management.

## Features

- 🛠 **Inventory System:** Manage and track stock levels, product details, and supplier information.
- 🛒 **Point of Sale (POS) System:** Facilitate in-store transactions with sales processing, receipt generation, and payment handling.
- 📊 **Admin Dashboard:** Provide administrators with an overview of business metrics, system analytics, and quick access to management tools.
- 🛒 **Ordering System:** Allow customers to place orders online, customize their selections, and choose pickup or delivery options.
- 📅 **Reservation System:** Enable customers to reserve tables or event spaces, with scheduling and confirmation functionalities.
- 🔑 **Authentication:** Support user registration and login processes, ensuring secure access to personalized features.
- 🖼 **Gallery Management:** Display and manage images of products, events, and the café environment to engage customers.
- 🤝 **User Management:** Administer user roles, permissions, and profiles to maintain system security and personalized experiences.
- 🛠 **API Integration:** Connect web and mobile applications using a RESTful API.
- 📱 **Mobile App:** Developed with React Native to provide a seamless mobile experience.
- 🛠 **Log Checker:** Logs and tracks changes made in the admin dashboard for accountability.
- 📃 **PDF Report Generation:** Generate reports for daily, weekly, monthly, and yearly business insights.
- 📊 **Sales Analytics:** Display trends and key metrics in the admin dashboard.
- 🛡 **OTP Integration:** Secure account creation with one-time password verification.
- 📞 **Contact System:** Customers can send messages directly to the administrator for inquiries and support.
- 💼 **Employee Management:** Administrators can add, edit, and manage employees.

## Tech Stack

- **Backend:** Laravel
- **Database:** MySQL
- **Frontend:** HTML, CSS, Bootstrap, JavaScript
- **Mobile Development:** React Native
- **Hosting & Deployment:** DigitalOcean, Laravel Forge

## Installation

### Prerequisites

Make sure you have the following installed:

- PHP (≥8.0)
- Composer
- Laravel
- MySQL or any preferred database

### Steps to Install

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo.git
   ```
2. Navigate into the project directory:
   ```bash
   cd your-project-name
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
5. Generate an application key:
   ```bash
   php artisan key:generate
   ```
6. Configure your `.env` file with your database credentials.
7. Run database migrations:
   ```bash
   php artisan migrate --seed
   ```
8. Serve the application:
   ```bash
   php artisan serve
   ```

## Usage

### 🍽️ For Users

- Order menu items for pickup or delivery.
- Reserve the café for gatherings and events.
- Access detailed information about Kuraw Coffee Shop with ease.
- Contact administrators directly for inquiries.

### 👨‍💼 For Admins

- Manage online orders, track new orders, and analyze sales trends.
- Export sales and inventory data for record-keeping and decision-making.
- Maintain and update the café's inventory.
- Manage the gallery to post news and announcements.
- Add and update menu items.
- Oversee user management, including enabling/disabling users.
- Monitor logs to track data modifications.
- Manage employee records and roles.

### 🤝 For Cashiers

- Take in-store orders using the POS system.
- Manage reservations and customer orders efficiently.
- Access the complete list of food and beverage offerings.

## API Routes (if applicable)

List important API endpoints with descriptions.

## Testing

Run tests with:

```bash
php artisan test
```

## Deployment

### 🚀 Deploying with Laravel Forge and DigitalOcean

1. **Set up a DigitalOcean Droplet:**
   - Create a new Droplet on DigitalOcean with Ubuntu as the OS.
   - Configure SSH access and retrieve your server’s IP address.
2. **Connect Laravel Forge:**
   - Log in to Laravel Forge and connect it to your DigitalOcean account.
   - Create a new server and select the Droplet you set up.
3. **Deploy the Laravel Project:**
   - Add your GitHub repository to Laravel Forge.
   - Set the root directory for the project (e.g., `/home/forge/yourdomain.com`).
   - Configure the `.env` file with the correct environment variables.
4. **Set Up the Database:**
   - Use Laravel Forge to create a MySQL database and update the `.env` file accordingly.
   - Run migrations:
     ```bash
     php artisan migrate --seed
     ```
5. **Configure a Web Server:**
   - Use Laravel Forge to set up Nginx for serving your Laravel application.
   - Ensure the document root is set to `/public`.
6. **SSL and Domain Setup:**
   - Assign a domain to your project in Laravel Forge.
   - Enable free SSL via Let’s Encrypt for HTTPS support.
7. **Automate Deployment:**
   - Set up automatic deployments in Laravel Forge to pull from your GitHub repository when updates are pushed.

## License

Distributed under the MIT License. See [LICENSE.txt](LICENSE.txt) for more information.
s