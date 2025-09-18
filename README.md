# PHP MVC Project

A simple **MVC (Model - View - Controller)** architecture built in PHP, developed as a **school project** using XAMPP. This project demonstrates how to structure a PHP application using MVC principles, with support for user management, employee and service handling, and a basic interface.

---

## ✨ Features

* **Employee management**: add, update, list, and delete employees
* **Service management**: manage services linked to employees
* **User management**: registration, login, profile handling
* **Basic UI**: header, menu, messages, and footer system
* **Separation of concerns**: clear MVC layers for maintainability

---

## 📂 Project Structure

```
php-mvc/
├── config/         # Database and app configuration
├── controleurs/    # Controllers (Accueil, Employés, Services, Utilisateurs...)
├── metiers/        # Business classes (Employe, Service, Utilisateur)
├── modeles/        # Data access layer (models)
├── vues/           # Views (templates and forms)
├── public/         # Static resources (CSS, JS, images)
├── vendor/         # Composer dependencies
├── index.php       # Application entry point
├── composer.json   # Composer configuration
└── README.md       # Project documentation
```

---

## ⚙️ Requirements

* **XAMPP** (Apache, PHP, MySQL)
* **PHP** ≥ 7.4
* **Composer** (for dependency management)

---

## 🚀 Installation & Setup (with XAMPP)

1. **Clone or download the repository**

   ```bash
   git clone https://github.com/your-username/php-mvc.git
   ```

2. **Move the project into the XAMPP `htdocs` folder**

   ```
   C:/xampp/htdocs/php-mvc
   ```

3. **Install dependencies**

   ```bash
   composer install
   ```

4. **Database setup**

   * Start Apache and MySQL in the XAMPP Control Panel
   * Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   * Create a new database (e.g., `php_mvc`)
   * Import the SQL schema (if provided)
   * Update your database credentials in `config/config.php`

5. **Run the project**

   * Open [http://localhost/php-mvc](http://localhost/php-mvc) in your browser

---

## 🖥️ Usage

* Register a new user or log in with existing credentials
* Manage employees and services through the interface

---

## 🛠️ Tech Stack

* **Backend**: PHP (MVC architecture)
* **Frontend**: HTML, CSS, basic JavaScript
* **Database**: MySQL (via XAMPP)
* **Dependencies**: Composer packages (see `composer.json`)

---

## 🙌 Notes

* This project was created as part of a **school assignment** to learn and demonstrate MVC in PHP.
* It is **not intended for production use**.
