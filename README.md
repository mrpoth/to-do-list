## MLP To-Do

To run the to-do app, please do the following:

**1. Clone the repo and cd into the working directory**

**2. Do the following commands:**
```bash
composer install
npm install
cp .env-example .env
```
**3. At this point, you'll need to create a database and a user, and update the .env accordingly**

**4. Then, run the following:**
```bash
npm run dev
php artisan serve
php artisan key:generate
php artisan migrate
```

The serve command should let you know where the application is running.