# Laravel Project - Installation and Setup Guide

## Installation

1. **Clone the repository**
    ```sh
    git clone https://github.com/saiwaiyanphyo/hotel-booking.git
    ```

2. **Change directory to the project folder**
    ```sh
    cd hotel-booking
    ```

3. **Install dependencies**
    ```sh
    composer install
    ```

4. **Copy the example environment file and configure the environment**
    ```sh
    cp .env.example .env
    ```

5. **Generate the application key**
    ```sh
    php artisan key:generate
    ```

6. **Run database migrations and seeders**
    ```sh
    php artisan migrate --seed
    ```

7. **Serve the application**
    ```sh
    php artisan serve
    ```

8. **Open the browser and visit the following URL**
    ```sh
    http://localhost:8000/admin/login
    http://localhost:8000/employee/login
    ```

9. **Login with the following credentials**
    - **Email**: `admin@mail.com`
    - **Password**: `P@ssw0rd`

## Troubleshooting

- If you encounter any issues, ensure that all dependencies are installed and the environment is configured correctly.
- Check the logs for any errors:
    ```sh
    tail -f storage/logs/laravel.log
    ```

## License

This project is licensed under the MIT License.
