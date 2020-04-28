Backend with Laravel 7

Subject:
	Post route to add bundles [/api/bundle]
	Get route to get all bundles [/api/bundle]

Requirements:
	Specific rules for bundle name
	Specific rules for package name respecting Android package convention

Get started:
    Copy .env.testing to .env and put your database information.
    [You SHOULD not delete .env.testing file, it use this information when running tests]
    Install composer modules: composer install
    Install node modules for dev purpose: npm install
    Create database: php artisan db:create
    Execute migrations: php artisan migrate
    Run test: php artisan test
    Run on dev mode: php artisan serve