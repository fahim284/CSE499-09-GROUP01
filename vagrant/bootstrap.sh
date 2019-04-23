#!/usr/bin/env bash
sudo service nginx restart
sudo service php7.2-fpm restart

# supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*