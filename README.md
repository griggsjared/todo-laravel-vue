# PHP/Laravel + Typescript/Vue/Inertia Todo List App

Requires composer 2.0+, php 8.1+, and node 14+.

To serve the dev env:
```
cp .env.example .env
touch database/database.sqlite
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

To start the dev build:
```
npm i
npm run dev
```
To run tests:
```
php artisan test
```

To run php code style test:
```
./vendor/bin/pint --test
```

To run php code style fix:
```
./vendor/bin/pint
```

To run js/ts code style test:
```
npx prettier --check .
```

To run js/ts code style fix:
```
npx prettier --write .
```

Run Docker web container:
```
docker run -p 8080:8080 --rm $(docker build -f docker/web/Dockerfile -q -t todo .)


```
