rm -rf /var/www/tobemaker/*
cp -rf * /var/www/tobemaker/
cp /var/www/tobemaker/config.production_1.php /var/www/tobemaker/config.php
chmod -R 777 /var/www/tobemaker/tmp
chmod -R 777 /var/www/tobemaker/upload
