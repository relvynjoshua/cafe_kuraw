<div align="center">
  <img src="/public/img/kuraw_logo.jpg" alt="Kuraw logo" width="200" height="auto" />
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
- 🛒 **Point of Sale (POS) System:** Facilitate in-store transactions with sales processing  and payment handling.
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

## Testing

Run tests with:

```bash
php artisan test
```

## Deployment

### 🚀 Deploying with Laravel Forge and DigitalOcean

## **1. Set Up Laravel Forge and Create a Server**

1. **Sign up for Laravel Forge**: [Laravel Forge](https://forge.laravel.com) is a tool for managing Laravel applications.
2. **Connect a Cloud Provider**: Link your cloud hosting provider (e.g., DigitalOcean, AWS, Linode) to Forge.
3. **Create a Server**:
   - Choose your cloud provider.
   - Select the server type, size, and region.
   - Forge will provision the server and install necessary services like Nginx, PHP, MySQL, etc.


## **2. Deploy The Laravel Project**

### **Connect Git Repository**
1. Link your Laravel project repository (GitHub, GitLab, Bitbucket) in the Forge dashboard.
2. Add the repository URL and set up SSH keys for Forge to access the repo.

### **Configure Deployment Script**
1. Navigate to your server in Forge > "Deployments."
2. Add the following deployment script:

```bash
#!/bin/bash

# Pull the latest changes
git pull origin main

# Install/update dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache configuration
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Set permissions
chown -R forge:www-data /home/forge/<your-domain>
chmod -R 775 /home/forge/<your-domain>/storage /home/forge/<your-domain>/bootstrap/cache

# Restart queue workers
php artisan queue:restart
```

Replace `<your-domain>` with your project’s directory name.

### **Set Environment Variables**
1. In Forge, go to "Environment" and add your `.env` variables.
2. Ensure your database credentials, `APP_ENV=production`, and other API keys are correctly set.


## **3. Install and Test Dependencies**

### **Ensure Composer Dependencies**

Verify `composer.json` lists all required packages (e.g., `laravel/dompdf`, `toastify-js`). If a package is missing, install it:

```bash
composer require <package-name>
```

### **Node.js and NPM**

If your project uses frontend assets:

```bash
npm install
npm run prod
```

Ensure `package.json` has the correct dependencies for frontend tools like Toastify.

### **File Permissions**

Set correct permissions for storage and bootstrap/cache:

```bash
chmod -R 775 storage bootstrap/cache
chown -R forge:www-data storage bootstrap/cache
```


## **4. Test Server Configuration**

### **Check PHP and Database Versions**

Ensure your server uses the correct PHP and MySQL versions:

```bash
php -v
mysql -V
```

### **Nginx Configuration**

Forge sets up Nginx automatically, but ensure the web root points to `/public` in your project folder.

### **Queue Workers**

If your app uses jobs or queues, ensure workers are running:
- In Forge, go to "Daemon Queue" and set up workers for your queues.

### **Scheduler**

Enable the scheduler for `php artisan schedule:run` under the "Scheduler" tab in Forge.


## **5. Testing Your Application**

### **Access the Site**

1. Visit your domain in the browser to confirm the Laravel app is loading.
2. Check if public assets (CSS, JS) load correctly.

### **Verify Features**

- **Test DOMPDF**:
  - Ensure PDFs generate correctly by testing the related functionality.
  - Check if the font directory or other required resources are accessible.
- **Test Toastify**:
  - Verify Toastify alerts display on user actions.

### **Debug Issues**

Check Laravel logs and Nginx logs for errors:

```bash
cat storage/logs/laravel.log
cat /var/log/nginx/error.log
```


## **6. Optimize for Production**

### **Disable Debug Mode**

Ensure `APP_DEBUG=false` in `.env`.

### **Caching**

Pre-cache configs and routes:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **SSL Configuration**

Use Forge’s "SSL Certificates" feature to add a free Let's Encrypt certificate.

### **Performance Tweaks**

- Use Laravel Horizon for queue monitoring.
- Set up Redis or another caching mechanism if needed.


## **7. Continuous Deployment**

- Set up automatic deployment in Forge to trigger on new Git commits.
- Customize deployment triggers and scripts in the "Deployments" section.


## **8. Monitor and Backup**

### **Monitoring**

- Use Laravel Telescope or Sentry for monitoring errors.
- Forge includes server health monitoring tools.

### **Backup**

- Enable backups in Forge for database snapshots and storage files.


## **9. Final Checklist**

- Ensure `.env` is configured correctly for production.
- All dependencies (Composer, NPM) are installed and optimized.
- Scheduled tasks and queue workers are running.
- Logs are clean of errors.

## License

Distributed under the MIT License. See [LICENSE.txt](LICENSE.txt) for more information.