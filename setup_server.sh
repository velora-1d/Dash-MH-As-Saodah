#!/bin/bash

# Update system
sudo apt update && sudo apt upgrade -y

# Install software-properties-common
sudo apt install -y software-properties-common

# Add PHP PPA
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Install Nginx
sudo apt install -y nginx

# Install PHP 8.4 and extensions
sudo apt install -y php8.4-fpm php8.4-mysql php8.4-mbstring php8.4-xml php8.4-bcmath php8.4-curl php8.3-zip php8.4-gd php8.4-zip unzip

# Install MySQL
sudo apt install -y mysql-server

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js and NPM
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Create Database
DB_NAME="dashboard_mh"
DB_USER="mh_user"
DB_PASS="Mh_Pass_2024!"

sudo mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
sudo mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
sudo mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# Firewall
sudo ufw allow 'Nginx Full'
sudo ufw allow 22

echo "Server Stack (PHP 8.4) Setup Complete!"
