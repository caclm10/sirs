# Student Report Information System for SMA Swasta Eria Medan

Welcome to the repository for the Student Report Information System for SMA Swasta Eria Medan. This project is a web application built using the [Laravel](https://laravel.com/) framework and the [MySQL](https://www.mysql.com) database management system. The application is designed to aid in the management of student report data for SMA Swasta Eria Medan (Internship).

## Key Features
- Student Data Management
- Teacher Data Management
- Student Report Management
- Report Data Analysis and Reporting
- User Management
- Class and Subject Management

## User Roles and Permissions
The system has three user roles, each with different permissions:

1. **Admin**:
   - Manages student, teacher, and admin profiles.
   - Manages subject and class data.
   - Assigns roles to users.
   
2. **Teacher (Class Advisor)**:
   - Manages and records student report data.
   
3. **Student**:
   - Views their own report.

## Installation

**Prerequisites:**
- [PHP](https://www.php.net) >= 7.3
- [Composer](https://getcomposer.org)
- [MySQL](https://www.mysql.com)

1. Clone this repository to your computer.
2. Open the terminal and navigate to the project folder.
3. Copy the `.env.example` file to `.env` and configure the database settings.
4. Run the `composer install` command to install PHP dependencies.
5. Run the `php artisan key:generate` command to generate the application key.
6. Run the `php artisan migrate` command to execute database migrations.
7. Run the `php artisan serve` command to start the development server.

Access the application via your browser at http://localhost:8000.

## Developer
This project is developed by [Lewin Xander Gulo](https://portfolio-caclm10.vercel.app). If you wish to get in touch with me, you can email me at [lewinxander@gmail.com](mailto:lewinxander@gmail.com).
