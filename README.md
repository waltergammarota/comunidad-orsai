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
sudo supervisorctl restart all


scheduler

sudo vim /etc/crontab
* * * * * cd /var/www/beta.comunidadorsai.org && php artisan schedule:run >> /dev/null 2>&1
crontab -l
check
journalctl -u cron.service -f

en prod
* * * * * cd /var/www/comunidadorsai-prod && php artisan schedule:run >> /dev/null 2>&1

mysqldump -u orsai -pfundaxionOrsai2020 --databases comunidadorsai-prod > backup-prod-211220200730.sql
para beta
mysqldump -u orsai -pfundaxionOrsai2020 --databases orsai > backup-beta-22102020b.sql

mongodb 
sudo apt install php-dev php-pear
sudo pecl install mongodb
extension=mongodb.so en cli y fpm
sudo systemctl restart php7.4-fpm.service

MERCADO PAGO
composer require doctrine/inflector:1.4.0

DEPLOY

cd /var/www/comunidadorsai-prod
git status
controlar archivos sin commitear
git pull
php artisan migrate (si hay migraciones, si corre y no hay nada no pasa nada)
sudo supervisorctl restart all


ngrok http -host-header=rewrite orsai.test:80
configurar endpoint de webhook en mercadolibre con url + ?token={MP_WEBHOOK_TOKEN} guardado en el .env

