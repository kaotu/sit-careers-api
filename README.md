### SIT Careers API
----
##### Config your machine for 1st Time
1. Install PHP >= 7.0.0
2. Install [Composer](https://getcomposer.org/)
    > ##### For windows dowload Download and run [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
    > ##### For Mac OS you can use the command line in this [Link](https://duvien.com/blog/installing-composer-mac-osx)

3. Install Laravel 
```bash
composer global require laravel/installer
```

##### Start Project
1. if you must to migrate and seed you can use below command
```bash
php artisan migrate --seed
```
2. Start server or Start project
```bash
php artisan serve
```

> Don't forget change .env
-----

##### Start Project by docker-compose
###### You can use docker-compose with development
1. For the first time.
```bash
docker-compose -f docker-compose.local.yml up --build
```
2. Next time.
```bash
docker-compose -f docker-compose.local.yml up
```
3. If you install some libs and want use composer. `Just restart composer container` and wait.
```bash
docker restart sit-careers-composer
```
If you face error `PermissionError on db folder` Please use
```bash
sudo chown -R $USER:$USER db/
```

-----
Enjoy !! ✌
