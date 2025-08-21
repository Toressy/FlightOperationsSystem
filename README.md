# FlightOperationsSystem

FlightOperationsSystem is a comprehensive web-based flight management platform built using PHP and MySQL. It supports various administrative tasks including flight scheduling, booking, pilot and plane management, and staff coordination.

## ✈️ Features

- **Booking System**: Users can book available flights online.
- **Admin Portal**: Admins can add, edit, or delete flights, schedules, staff, pilots, and planes.
- **Pilot Dashboard**: Pilots have access to relevant information via a custom interface.
- **Modular Design**: Separate scripts handle data retrieval, CRUD operations, and authentication.
- **Role-Based Access**: Interfaces are adjusted based on user roles (e.g., passenger, pilot, admin).

## 📁 Project Structure

- `index.php`: Main landing page
- `login.php`: User login and authentication
- `admin-start.php`: Admin dashboard
- `book-flight.php`: Passenger flight booking interface
- `add-*.php`, `edit-*.php`, `delete-*.php`: Manage system records
- `dbconfig.php`, `dbconfiglogin.php`: Database connection settings
- `class.crud.php`: Contains reusable CRUD methods
- `menu-pilot.php`: Pilot's navigation menu
- `get-*.php`: Data fetch scripts for views and dashboards

## 🛠 Requirements

- PHP 7.x or newer
- MySQL
- Web server (XAMPP, WAMP, LAMP)

## 🚀 Setup Instructions

1. Import the SQL database (not included in this zip) to your MySQL server.
2. Configure database access in `dbconfig.php` and `dbconfiglogin.php`.
3. Deploy all files to your web server's root directory.
4. Open `index.php` in your browser and log in.

## 📚 Use Cases

- Airline training environments
- Academic projects focused on database-driven apps
- Admin-controlled flight and crew scheduling systems
