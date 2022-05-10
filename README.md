<h1><strong>Big Beefy Men</strong></h1>

RUN THIS AFTER CLONE
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
