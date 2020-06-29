FUNDACION ORSAI

INSTALACION
1. git clone
2. npm install
3. composer update
4. php artisan storage:link
5. php artisan migrate
6. GRANT ALL PRIVILEGES ON *.* TO 'orsai'@'localhost' IDENTIFIED BY 'fundaxionOrsai2020';
5. php artisan queue:work >/dev/null 2>&1 &



CADA VEZ QUE SE CAMBIA ALGO EN LOS MAILS
php artisan queue:restart
sudo systemctl restart mailing.service

retry all jobs
php artisan queue:retry all

Configurar en .env el email del administrador


