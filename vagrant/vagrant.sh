#!/usr/bin/env bash

set -e
export DEBIAN_FRONTEND=noninteractive

# Variables
DBHOST=localhost
DBNAME=redprint
DBUSER=root
DBPASSWD=root

echo -e "\n--- Adding required repositories ---\n"

# add npm repos
echo "deb https://deb.nodesource.com/node_8.x trusty main" > /etc/apt/sources.list.d/nodesource.list
wget --quiet -O - https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add -


# Add PHP and nginx repositories
add-apt-repository ppa:nginx/stable
add-apt-repository ppa:ondrej/php

# MySQL setup for development purposes ONLY
echo -e "\n--- Install MySQL specific packages and settings ---\n"

apt-get update

# Download mysql apt repo for mysql 5.7 installation
wget http://dev.mysql.com/get/mysql-apt-config_0.8.3-1_all.deb

apt-get install debconf-utils -y > /dev/null

# Pre configure mysql setup
echo mysql-apt-config mysql-apt-config/repo-distro select ubuntu | debconf-set-selections
echo mysql-apt-config mysql-apt-config/repo-codename select trusty | debconf-set-selections
echo mysql-apt-config mysql-apt-config/select-server select mysql-5.7 | debconf-set-selections
echo mysql-community-server mysql-community-server/root-pass password $DBPASSWD | debconf-set-selections
echo mysql-community-server mysql-community-server/re-root-pass password $DBPASSWD | debconf-set-selections

dpkg -i mysql-apt-config_0.8.3-1_all.deb  > /dev/null

apt-get update

apt-get -y install mysql-server augeas-tools

# mysql server configuration
augtool set /etc/mysql/my.cnf/target[3]/character-set-server utf8
augtool set /etc/mysql/my.cnf/target[3]/collation-server utf8_unicode_ci

# Create DB
echo -e "\n--- Setting up our MySQL user and db ---\n"
mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'"

# install packages

apt-get install -y libpcre3 acl git nginx nodejs redis-server supervisor build-essential php7.2-fpm php7.2-cli php7.2-curl php7.2-gd php7.2-intl php7.2-readline php7.2-mysql php7.2-json php7.2-mbstring php7.2-soap php7.2-xml php7.2-zip xvfb
# install composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# install webpack
npm install -g webpack
# install webpack-dev-server
npm install -g webpack-dev-server
#install yarn
npm install -g yarn

# install configs
#make an empty supervisor conf file and ln it to our copy
sudo touch /etc/supervisor/conf.d/laravel-worker.conf
sudo mkdir -p /home/redprint
sudo touch /home/redprint/worker.log
ln -sf /srv/web/vagrant/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
# Server config files
ln -sf /srv/web/vagrant/php.ini /etc/php/7.2/fpm/php.ini
ln -sf /srv/web/vagrant/www.conf /etc/php/7.2/fpm/pool.d/www.conf
ln -sf /srv/web/vagrant/nginx.conf /etc/nginx/nginx.conf
ln -sf /srv/web/vagrant/cert.pem /etc/nginx/cert.pem
ln -sf /srv/web/vagrant/key.pem /etc/nginx/key.pem

service mysql restart
service php7.2-fpm restart
service nginx restart
update-rc.d nginx defaults

# go to app dir
cd /srv/web

# copy env
cp .env.example .env

# composer install
mkdir -p /srv/web/bootstrap/cache
chmod 777 -R bootstrap/
chmod 777 -R storage/
chmod 777 -R public/

php artisan key:generate

composer install

# migrate
php artisan migrate

# seed
php artisan db:seed
