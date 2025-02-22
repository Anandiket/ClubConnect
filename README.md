# ClubConnect - Connecting College Clubs & Committees

## Introduction
**ClubConnect** is a web application designed to connect college clubs and committees with students by displaying real-time updates on events, achievements, and committee details. The platform enables each committee's admin to manage and update data through PHP form handling and a phpMyAdmin database.

### Key Features
- **Real-time Event Updates**: Students can stay informed about upcoming events.
- **Committee & Member Information**: Displays details of various committees and their members.
- **Achievements Showcase**: Highlights past achievements and milestones.
- **Admin Dashboard**: Committee admins can update information dynamically.
- **Report Generation**: Admins can generate committee reports using PHP Excel.
- **User-Friendly Interface**: Built with HTML5, CSS3, JavaScript, and PHP for a seamless experience.

---

## Getting Started
### 1. Clone the Repository
```bash
git clone https://github.com/Anandiket/clubconnect.git
cd clubconnect
```

### 2. Set Up a Local Server
Use **XAMPP** or **WAMP** to host the project locally.

1. Copy the `clubconnect` folder into the `htdocs` directory (for XAMPP) or `www` directory (for WAMP).
2. Start Apache and MySQL from the control panel.

### 3. Configure the Database
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
2. Create a new database named `committees`.
3. Import the provided `committees.sql` file from the repository.

### 4. Configure Environment Variables
Edit the `config.php` file:
```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "committees";
?>
```

### 5. Run the Application
Access the application in your browser at:
```
http://localhost/clubconnect/
```

---

## Requirements
Ensure you have the following installed:
- **XAMPP/WAMP** (for local server & database management)
- **PHP 7+**
- **MySQL**
- **phpMyAdmin**
- **HTML, CSS, JavaScript**

---

## Future Enhancements
- **Event Registration System** to allow students to RSVP for events.
- **Email Notifications** for upcoming events.
