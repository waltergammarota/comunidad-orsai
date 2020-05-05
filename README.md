FUNDACION ORSAI

1. git clone
2. npm install
3. composer update
4. php artisan storage:link
5. php artisan migrate
6. GRANT ALL PRIVILEGES ON *.* TO 'orsai'@'localhost' IDENTIFIED BY 'fundaxionOrsai2020';
5. php artisan queue:work >/dev/null 2>&1 &

PARA LANZAR LOS JOBS QUE ENVIAN MAILS
php artisan queue:work
php artisan queue:restart
