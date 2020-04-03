# test26

#### Requirements: 
1. [git](https://git-scm.com/downloads)
2. [composer](https://getcomposer.org/download/)
5. php >=7.2
6. mysql >=5.7

#### Installation

- clone project or download zip file and extract
- composer install
- cp .env.example .env
- open .env file and change these values
```
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_pass
```
- php artisan key:generate
- php artisan migrate --seed
- php artisan serve --port=8000
