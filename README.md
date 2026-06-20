CSE Project Repository

> A comprehensive web-based platform for Computer Science Engineering students to showcase, manage, and collaborate on academic and personal projects.

📚 Overview

CSE Project Repository is a full-stack web application built to help Computer Science Engineering students present their project work, manage project metadata, and connect projects to GitHub repositories. The app supports CRUD operations for projects, user-friendly search & filtering, category management, and safe server-side handling for forms and inputs.

Key goals:
- Make it easy for students to upload and maintain project portfolios.
- Provide filtering and searching by title, student, technology, and category.
- Offer a simple admin interface for managing categories and sample data.
- Keep a focus on security (SQL injection/XSS protection) and responsive design.

🎯 Features

Student / Public Features
- ✅ Upload Projects — Form with validation and optional GitHub repo link
- ✅ Browse All Projects — Grid/list view with pagination
- ✅ Search & Filter — By title, student name, technology, category
- ✅ View Project Details — Full metadata, screenshots (optional), GitHub link
- ✅ Edit Projects — Update any project fields
- ✅ Delete Projects — Soft-delete or hard-delete depending on config
- ✅ Responsive Design — Mobile/tablet/desktop friendly

Admin Features
- ✅ Category Management — Create, edit, delete categories
- ✅ Project Management — Approve or manage submitted projects
- ✅ Sample Data Import — Quickly populate the database for demos

Security
- ✅ SQL Injection Mitigation — `mysqli_real_escape_string()` and prepared statements where possible
- ✅ XSS Mitigation — `htmlspecialchars()` on output
- ✅ Type Safety — Cast numeric inputs where required
- ✅ POST Validation — Server-side checks for required fields
- ✅ Client-Side Validation — Form input hints and basic checks
- ✅ CSRF (optional) — Recommend adding CSRF tokens for production

Data & Analytics
- ✅ Project Statistics — Counts for projects, categories, and students
- ✅ Timestamps — Automatic record of upload and update times
- ✅ Pagination & Sorting — Efficient browsing of large datasets

🌐 Tech Stack

| Layer | Technology | Notes |
|-------|------------|-------|
| Backend | PHP (7.4+) | Core server logic |
| Frontend Styling | CSS3 | Responsive layout (can use Bootstrap) |
| Frontend Interactivity | JavaScript (ES6) | Search/filter UI, validation |
| Database | MySQL (5.7+) | Core storage |
| Server | Apache (WAMP/XAMPP) | Local development |

📁 Project Structure (example)

```
/ (project root)
├─ index.php                # Home / project listing
├─ project.php              # Project detail page
├─ upload.php               # Form handler for uploads
├─ edit.php                 # Edit project page
├─ delete.php               # Delete project handler
├─ admin/
│  ├─ categories.php        # Manage categories
│  └─ dashboard.php
├─ includes/
│  ├─ config.php            # DB config & settings
│  ├─ db.php                # Database connection helper
│  └─ functions.php         # Helper functions (validation, sanitization)
├─ assets/
│  ├─ css/
│  ├─ js/
│  └─ images/
├─ sql/
│  └─ schema.sql            # Database schema and sample data
└─ README.md
```

🚀 Quick Start (Local Development)

Requirements:
- PHP 7.4+ (or newer)
- MySQL 5.7+ (or MariaDB)
- Apache (or any webserver) — XAMPP/WAMP recommended for Windows
- Git (optional)

Steps:

1. Clone the repo
```bash
git clone https://github.com/YASH-DILIP-SANKLECHA/web_tech.git
cd web_tech
```

2. Copy files to your webserver document root
- For XAMPP: place the folder inside `C:\xampp\htdocs\` (Windows)
- For WAMP: place the folder inside `C:\wamp64\www\`

3. Create a MySQL database
- Open phpMyAdmin or use the MySQL CLI and create a database:
```sql
CREATE DATABASE web_tech_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

4. Import schema and sample data
- Import `sql/schema.sql` via phpMyAdmin or:
```bash
mysql -u root -p web_tech_db < sql/schema.sql
```

5. Configure database connection
- Copy `includes/config.example.php` to `includes/config.php` (or edit `includes/config.php`) and set DB credentials:
```php
<?php
// includes/config.php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_tech_db');

// Optional settings
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
```

6. Ensure `assets/uploads/` is writable by the webserver (chmod 755/775 as needed).

7. Open the app in your browser:
- http://localhost/web_tech/ (or subpath you installed to)

Database Schema (example snippet)

A minimal schema for projects and categories (full schema is in sql/schema.sql):

```sql
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  student_name VARCHAR(255) NOT NULL,
  description TEXT,
  technologies VARCHAR(255),
  category_id INT,
  github_url VARCHAR(255),
  screenshot VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

Usage

- Upload a project via the "Add Project" form. Required fields: Title, Student Name, Category.
- Use the search box to search by title or student name; apply category filters.
- Click a project to view details and follow the GitHub link to the repo (if provided).
- Admin pages allow managing categories and reviewing/removing inappropriate projects.

Validation & Security Notes

- Always validate and sanitize inputs on the server. Example:
  - Use `mysqli_real_escape_string()` or prepared statements.
  - Use `filter_var()` for URL/email validation.
  - Output escaping with `htmlspecialchars()` before rendering HTML.
- For production:
  - Use prepared statements (PDO or mysqli with prepared queries) everywhere.
  - Add CSRF protection tokens to all forms.
  - Use HTTPS and secure session settings.
  - Limit file upload types and size, and store uploads outside webroot when possible.

Testing

- Manual test flows:
  - Upload valid/invalid project forms to ensure validation works.
  - Test search, filter, pagination, edit, and delete.
- Automated testing:
  - Add PHP unit tests or integration tests as needed (not included by default).

Deployment

- Move files to a LAMP/LEMP server or host supporting PHP & MySQL.
- Configure environment variables or `includes/config.php` with production DB credentials.
- Set appropriate file permissions and ensure backups for your database and uploads.

Extending the App / Ideas

- Add user accounts and authentication (students, admins)
- Allow project contributors (multiple students per project)
- Add tags and advanced filtering
- Integrate continuous deployment linking with GitHub webhooks
- Add automated screenshots or gallery carousel
- Provide export (CSV/JSON) of projects and statistics

Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add feature"`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request describing your changes.

Please follow good commit message practices and include tests where appropriate.

License

This project is licensed under the MIT License. See the LICENSE file for details.

Acknowledgements

- Built as a student-oriented demo platform
- Icons, libraries, and other third-party assets should be credited here if used (Bootstrap, Font Awesome, etc.)

Contact

CONTRIBUTORS: YASH-DILIP-SANKLECHA , Madansingh7
GitHub: https://github.com/YASH-DILIP-SANKLECHA

If you'd like further edits (remove emojis, convert tables to plain text, or commit this README to the repo), tell me which and I'll apply them.
