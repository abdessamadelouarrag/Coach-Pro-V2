# Coach Pro V2

A comprehensive sports coaching management system built with PHP, designed to streamline coaching operations, athlete management, and training programs.

## 📋 Overview

Coach Pro V2 is a web-based application that helps coaches and sports organizations manage their athletes, training sessions, schedules, and performance tracking in one centralized platform.

## ✨ Features

- **Athlete Management**: Register and manage athlete profiles, including personal information and performance metrics
- **Training Sessions**: Schedule and track training sessions with detailed planning
- **Performance Tracking**: Monitor athlete progress and performance over time
- **User Authentication**: Secure login system for coaches and administrators
- **Dashboard**: Comprehensive overview of all coaching activities
- **Responsive Design**: Works seamlessly across desktop and mobile devices

## 🛠️ Technologies Used

- **Backend**: PHP (74.4%)
- **Frontend**: CSS (16.9%), JavaScript (0.5%)
- **Database**: MySQL (coachpro_v2.sql)
- **Server Configuration**: Apache (.htaccess)

## 📁 Project Structure

```
Coach-Pro-V2/
├── Js/                 # JavaScript files
├── classes/            # PHP classes and business logic
├── config/             # Configuration files
├── pages/              # Application pages
├── public/             # Public assets (images, CSS, JS)
├── style/              # Stylesheets
├── .htaccess           # Apache configuration
├── coachpro_v2.sql     # Database schema
└── README.md           # Project documentation
```

## 🚀 Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server
- Web browser (Chrome, Firefox, Safari, or Edge)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/abdessamadelouarrag/Coach-Pro-V2.git
   cd Coach-Pro-V2
   ```

2. **Database Setup**
   - Create a new MySQL database
   - Import the database schema:
     ```bash
     mysql -u your_username -p your_database_name < coachpro_v2.sql
     ```

3. **Configure Database Connection**
   - Navigate to the `config/` directory
   - Update the database configuration file with your credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'your_database_name');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     ```

4. **Deploy to Web Server**
   - Copy the project files to your web server's document root (e.g., `/var/www/html/` or `htdocs/`)
   - Ensure proper permissions are set:
     ```bash
     chmod -R 755 Coach-Pro-V2/
     ```

5. **Access the Application**
   - Open your web browser and navigate to:
     ```
     http://localhost/Coach-Pro-V2/
     ```

## 💻 Usage

### For Coaches

1. **Login**: Access the system using your credentials
2. **Dashboard**: View overview of athletes and upcoming sessions
3. **Add Athletes**: Register new athletes with their information
4. **Schedule Training**: Create and manage training sessions
5. **Track Progress**: Monitor athlete performance and improvements

### For Administrators

1. **User Management**: Add and manage coach accounts
2. **System Configuration**: Configure application settings
3. **Reports**: Generate reports on coaching activities

## 🔒 Security

- Password encryption for user accounts
- SQL injection prevention
- Session management for secure authentication
- `.htaccess` configuration for URL protection

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 👨‍💻 Author

**Abdessamad Elouarrag**
- GitHub: [@abdessamadelouarrag](https://github.com/abdessamadelouarrag)

## 📧 Contact

For questions or support, please open an issue on GitHub or contact the repository owner.

## 🙏 Acknowledgments

- Thanks to all contributors who have helped improve this project
- Built with passion for the sports coaching community
