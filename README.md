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

EN PRODUCCION
php artisan queue:restart 
sudo systemctl restart mailing-prod.service

retry all jobs
php artisan queue:retry all


EN BETA
para arrancar los procesos
sudo supervisorctl restart all
para parar todos los procesos 
sudo supervisorctl stop all

para editar el proceso
sudo vim laravel-worker.conf
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all





