# Kredium CRM

## Local environment setup

Clone repository
```
git clone git@github.com:jiggsaw85/kredium-crm.git
```

Install Laravel
```
cd kredium-crm && composer install
```

Set environment file
```
cp .env.example .env
```

Add database credentials
```
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

Run migrations
```
php artisan migrate
```

Run seeders
```
php artisan db:seed
```

Run local server
```
php artisan serve
```

### Available users
```
email: johndoe@example.com
password: password123
```
```
email: janedoe@example.com
password: password456
```
