# How to

## Vendor differences

In some lessons, the source code is slightly different, depending on the database type (MySQL, Postgres and SQLite). When this happens, you'll see a database driver check in the source code that looks something like this:

```php
if (config('database.default') === 'pgsql') {
    // ...
}
```

In some cases, it's not possible to create variations for all three database types, and an exception will be thrown instead.

```php
if (config('database.default') === 'sqlite') {
    throw new \Exception('This lesson does not support SQLite.');
}
```

## Installation

To test this demo application, please follow these instructions.

First, go to the lesson's source code directory.

Next, install the PHP vendor dependencies using [Composer](https://getcomposer.org/):

```sh
composer install
```

Next, copy the example configuration. You can do this from the command line, or by simply copying the `.env.example` file and saving it as `.env`.

```sh
cp .env.example .env
```

Next, generate an application key by running the `key:generate` Artisan command:

```sh
php artisan key:generate
```

Next, you'll need to configure a database. You can use the MySQL, Postgres, or SQLite drivers. To do this, update the `DB_CONNECTION` value in your `.env` file:

```bash
DB_CONNECTION=mysql  # MySQL
DB_CONNECTION=pgsql  # Postgres
DB_CONNECTION=sqlite # SQLite
```

You will likely also need to edit the other database connection values as needed for your system, such as the database host (`DB_HOST`), database port (`DB_PORT`), database name (`DB_DATABASE`), database user (`DB_USERNAME`) and database password (`DB_PASSWORD`).

If you're using SQLite, you can generate an SQLite database file by running the following command:

```bash
touch database/database.sqlite
```

Be sure to see the [database section](https://laravel.com/docs/database) of the Laravel documentation if you're having trouble establishing a database connection.

Once your database connection has been setup, run the database migrations:

```sh
php artisan migrate
```

Next, run the database seeder to populate the database with some sample data:

```sh
php artisan db:seed
```

Now you're ready to go!

If you're using [Laravel Valet](https://laravel.com/docs/valet), [Laravel Homestead](https://laravel.com/docs/valet), or some other local development environment, view your website there as you normally would. Alternatively, you can also use the built-in PHP server:

```sh
php artisan serve
```

This command will output an address where you can then view the site.

Enjoy! 😊
