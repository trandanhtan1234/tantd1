# Tantd1 E-commerce Platform

A full-stack e-commerce platform for selling clothes, featuring a public product catalog and a secure admin panel.

## Key Features

### For Users
- **Product Browsing**: Browse products by category, search for specific products by name, and view "best sellers" and "newest products."
- **Shopping & Ordering**: Add items to a shopping cart and place orders.
- **Payment Integration**: Supports multiple payment methods, including Cash, MoMo, and VNPAY.
- **User Management**: Register for a new account and log in to manage orders.

### For Admins
- **Product & Category Management**: Create, update, and delete products and categories.
- **Order Management**: View and update the status of incoming orders.
- **Account Management**: Manage customer and staff accounts.
- **Dashboard Analytics**: View key business metrics, including income for the current week, month, and year.

## Technology Stack
- **Backend**: Laravel (PHP)
- **Frontend**: HTML, CSS, JavaScript, Bootstrap, Sass
- **Build Tool**: Vite
- **Database**: MySQL
- **Package Managers**: Composer, npm

## Installation and Local Setup

Follow these steps to get the project up and running on your local machine.

1. **Clone the repository:**

    ```bash
    git clone https://github.com/trantandanh1234/tantd1.git
    cd tantd1
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install npm dependencies:**

    ```bash
    npm install
    ```

4. **Set up the environment file:**

    ```bash
    cp .env.example .env
    ```

    Open the newly created `.env` file and update your database credentials.

5. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

7. **Seed the database (optional):**

    ```bash
    php artisan db:seed
    ```

8. **Start the local development server:**

    ```bash
    php artisan serve
    ```

9. **Build frontend assets:**

    ```bash
    npm run dev
    ```

Your project should now be accessible at the local URL provided in your terminal (e.g., `http://127.0.0.1:8000`).

## Contributing

Feel free to fork the repository, make improvements, and submit pull requests. Please ensure that your changes adhere to the existing coding style and add appropriate tests where applicable.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
