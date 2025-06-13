<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Ravylogue - Personal Blog
Ravylogue is an elegant and modern personal blog platform, built with Laravel. Designed with a calm and reflective feel, this application allows writers to share notes, experiences, and knowledge through a clean, content-focused interface.

✨ Key Features
Elegant Design: A dark theme with a deep navy and cream white color palette, and classy typography using Playfair Display and Inter.

Post Management (CRUD): The owner can easily create, read, update, and delete (CRUD) blog posts.

Authorization System: Access rights are differentiated between the blog owner and regular users (guests).

Blog Owner: Has full access to manage all posts.

Registered User: Can read all posts and leave comments.

Manual Comment System: Users can leave comments on each post. Comment owners can edit and delete their own comments.

Quick Search: A search function to find posts based on title or content.

Responsive Design: Optimized display for desktop, tablet, and mobile devices.

💻 Tech Stack
Backend: PHP, Laravel Framework

Frontend: HTML, Tailwind CSS, Alpine.js

Database: MySQL (or other Laravel-supported databases)

Development Tools: Vite, Composer, NPM

🚀 Installation Guide
Follow the steps below to install and run this project in your local environment.

1. Clone the Repository
git clone https://github.com/YOUR-USERNAME/personalblog.git
cd personalblog

2. Install Dependencies
Install PHP dependencies using Composer and JavaScript dependencies using NPM.

composer install
npm install
npm run build

3. Environment Configuration
Copy the .env.example file to create your own .env file.

cp .env.example .env

Open the .env file and configure your database settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=personalblog
DB_USERNAME=root
DB_PASSWORD=

4. Generate App Key & Run Migrations
Generate a unique application key and run the migrations to create the database tables.

php artisan key:generate
php artisan migrate

5. Run the Development Server
Finally, run the Laravel development server.

php artisan serve

Your application is now accessible at http://127.0.0.1:8000.

👤 Blog Owner Access
This system has a special role for the blog owner. By default, the user with the following email is designated as the owner:

Email: rafiimanullah@gmail.com

The user with this email will be able to see the "New Post" button, as well as the icons to edit and delete all posts. Other users only have access to read and comment. This logic is controlled in app/Policies/PostPolicy.php.

Made with ❤️ by Rafi Imanullah
