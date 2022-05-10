<h1><strong>Big Beefy Men</strong></h1>

COPY ENV EXAMPLE TO ENV
```cmd
cp .env.example .env
```

RUN THIS
```cmd
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

THEN RUN THIS
```cmd
./vendor/bin/sail up
```

OR CREATE A BASH ALIAS
```cmd
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

THEN YOU CAN USE
```cmd
sail up
```

READ THIS
https://laravel.com/docs/9.x/sail#introduction

NOW ITS TIME TO RUN MIGRATIONS AND BUILD FRONTEND
```cmd
sail artisan migrate
```
```cmd
sail npm install
```
```cmd
sail npm run dev
```
