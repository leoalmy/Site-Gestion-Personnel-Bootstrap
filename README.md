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
├── BDD/            # Database schema and sample data
├── config/         # App configuration
├── controleurs/    # Controllers (Accueil, Employés, Services, Utilisateurs...)
├── metiers/        # Business classes (Employe, Service, Utilisateur)
├── modeles/        # Data access layer (models)
├── vues/           # Views (templates and forms)
├── public/         # Static resources (CSS, JS, images)
├── vendor/         # Composer dependencies
├── index.php       # Application entry point
├── .env.example    # Example environment configuration
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

You have two options to get the code: **clone the repository** or **download the release .zip**.

### Option A: Clone the Repository

1. Open your terminal / Git Bash
2. Run:

   ```bash
   git clone https://github.com/leoalmy/Site-Gestion-Personnel-Bootstrap.git
   ```
3. Move the project into the XAMPP `htdocs` folder, e.g.:

   ```
   C:/xampp/htdocs/php-mvc
   ```
4. Continue with the common setup steps below.

### Option B: Download Release .zip

1. Go to the [Releases](https://github.com/leoalmy/Site-Gestion-Personnel-Bootstrap/releases) page on GitHub
2. Download the latest `.zip` release
3. Extract it into your XAMPP `htdocs` folder, e.g.:

   ```
   C:/xampp/htdocs/php-mvc
   ```
4. Continue with the common setup steps below.

---

### Common Setup Steps

5. **Install dependencies**

   ```bash
   composer install
   ```

6. **Configure environment variables**

   * Copy `.env.example` to `.env`

     ```bash
     cp .env.example .env
     ```
   * Update `.env` with your database credentials

7. **Database setup**

   * Start Apache and MySQL in the XAMPP Control Panel
   * Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   * Create the required databases
   * Import the SQL files provided in the **BDD/** folder

8. **Run the project**

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
