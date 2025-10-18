# Conv-App (Expense Tracker)

Conv-App is a simple expense tracking web application built with **Laravel 11**, **Tailwind CSS**, and **MySQL**. It allows users to manage their expenses, view summaries, and convert expenses into their preferred currency.

---

## Features

- **User Authentication**: Register, login, and logout securely.
- **Expense Management**: Add, edit, and delete expenses.
- **Expense Summary**: View categorized summaries of expenses over a date range.
- **Currency Conversion**: Expenses are automatically converted to the user's preferred currency.
- **Responsive Design**: Built with Tailwind CSS for mobile-friendly use.

---

## Requirements

- PHP >= 8.1
- Composer
- MySQL
- Node.js & npm 
- Laravel 11

---

## Installation

1. **Clone the repository:**


git clone https://github.com/hebaAlajouri/conv-app.git
cd conv-app
2. **Install PHP dependencies:**
composer install
3. **Install Node.js dependencies:**
npm install
4. **Set up the environment file:**
cp .env.example .env
php artisan key:generate
5. **Build frontend assets:**
npm run dev 
6. **Install and configure Sanctum (if not already installed via composer):**
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
7. **Serve the application:**
php artisan serve
