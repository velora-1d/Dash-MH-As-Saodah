#!/bin/bash

APP_DIR="/var/www/dashboard-mh"
DOMAIN="assaodah.santrix.my.id"

# 1. Install Dependencies in Home Dir (as ubuntu user)
cd /home/ubuntu/dashboard-mh
cp .env.example .env

composer install --no-dev --optimize-autoloader
npm install
npm run build

# 2. Move code and fix permissions
sudo rm -rf $APP_DIR
sudo mkdir -p $APP_DIR
sudo cp -r /home/ubuntu/dashboard-mh/. $APP_DIR
sudo chown -R www-data:www-data $APP_DIR
sudo chmod -R 775 $APP_DIR/storage $APP_DIR/bootstrap/cache

cd $APP_DIR

# 3. Setup .env
sudo -u www-data sed -i "s|APP_URL=.*|APP_URL=https://${DOMAIN}|" .env
sudo -u www-data sed -i "s|DB_DATABASE=.*|DB_DATABASE=dashboard_mh|" .env
sudo -u www-data sed -i "s|DB_USERNAME=.*|DB_USERNAME=mh_user|" .env
sudo -u www-data sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=Mh_Pass_2024!|" .env
sudo -u www-data sed -i "s|APP_LOCALE=.*|APP_LOCALE=id|" .env

# 4. App Initialization
sudo -u www-data php artisan key:generate
sudo -u www-data php artisan storage:link
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan db:seed --class=RoleUnitUserSeeder --force

# 5. Nginx Configuration
NGINX_CONF="/etc/nginx/sites-available/${DOMAIN}"
sudo bash -c "cat > ${NGINX_CONF}" <<EOF
server {
    listen 80;
    server_name ${DOMAIN};
    root ${APP_DIR}/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

sudo ln -sf ${NGINX_CONF} /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl restart nginx

echo "Deployment Finalization (PHP 8.4) Complete!"
