#!/bin/bash

echo "After deployment script"

export COMPOSER_HOME="$HOME/.config/composer";

EFS_MOUNT_POINT="/etc/storage/admin/public/assets"
EFS_LINK="/var/www/html/console/public/assets"

# Check if the symbolic link exists
if [ ! -e "$EFS_LINK" ]; then
    # Create a symbolic link to the EFS mount point
    sudo ln -s "$EFS_MOUNT_POINT" "$EFS_LINK"
fi

EFS_MOUNT_POINT_1="/etc/storage/admin/assets"
EFS_LINK_1="/var/www/html/console/assets"

# Check if the symbolic link exists
if [ ! -e "$EFS_LINK_1" ]; then
    # Create a symbolic link to the EFS mount point
    sudo ln -s "$EFS_MOUNT_POINT_1" "$EFS_LINK_1"
fi

cd /var/www/html/admin
mkdir -p storage/framework/{sessions,views,cache}
composer install --optimize-autoloader --no-dev
php artisan route:cache		
php artisan view:cache		
php artisan config:clear
php artisan cache:clear

chown -R apache:apache /var/www/html
find /var/www/html/console -type d -exec chmod 755 {} \;
find /var/www/html/console -type f -exec chmod 644 {} \;
chmod -R 777 /var/www/html/console/storage/
