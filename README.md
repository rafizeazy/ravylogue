# Ravylogue - Personal Blog

**Ravylogue** is an elegant and modern personal blog platform, built with Laravel. Designed with a calm and reflective feel, this application allows writers to share notes, experiences, and knowledge through a clean, content-focused interface.

![ravylogue2](https://github.com/user-attachments/assets/871b5a7a-b0a6-4866-998e-6ed7db5c8e52)

---

## ✨ Key Features

-   **Elegant Design:** A dark theme with a *deep navy* and *cream white* color palette, and classy typography using Playfair Display and Inter.
-   **Post Management (CRUD):** The owner can easily create, read, update, and delete (CRUD) blog posts.
-   **Authorization System:** Access rights are differentiated between the blog owner and regular users (guests).
    -   **Blog Owner:** Has full access to manage all posts.
    -   **Registered User:** Can read all posts and leave comments.
-   **Manual Comment System:** Users can leave comments on each post. Comment owners can edit and delete their own comments.
-   **Quick Search:** A search function to find posts based on title or content.
-   **Responsive Design:** Optimized display for desktop, tablet, and mobile devices.

## 💻 Tech Stack

-   **Backend:** PHP, Laravel Framework
-   **Frontend:** HTML, Tailwind CSS, Alpine.js
-   **Database:** MySQL
-   **Development Tools:** Vite, Composer, NPM

## 🚀 Installation Guide

Follow the steps below to install and run this project in your local environment.

### 1. Clone the Repository

```bash
git clone https://github.com/rafizeazy/ravylogue.git
cd personalblog
```

### 2. Install Dependencies

Install PHP dependencies using Composer and JavaScript dependencies using NPM.

```bash
composer install
npm install
npm run build
```

### 3. Environment Configuration

Copy the `.env.example` file to create your own `.env` file.

```bash
cp .env.example .env
```

Open the `.env` file and configure your database settings:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=personalblog
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key & Run Migrations

Generate a unique application key and run the migrations to create the database tables.

```bash
php artisan key:generate
php artisan migrate
```

### 5. Run the Development Server

Finally, run the Laravel development server.

```bash
php artisan serve
```

Your application is now accessible at [**http://127.0.0.1:8000**](http://127.0.0.1:8000).


---

Made with ❤️ by Ravy
