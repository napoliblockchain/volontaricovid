#!/bin/bash
echo Updating...
if [ ! -d "/var/www/dali/assets" ]; then
    mkdir /var/www/dali/assets
fi

git stash
git pull


chown -R www-data:www-data /var/www/dali/assets/
chown -R www-data:www-data /var/www/dali/protected/runtime/

chmod 755 /var/www/dali/protected/yiic
chmod 755 /var/www/dali/update.sh
chmod +x /var/www/dali/update.sh

echo Versioning...
git rev-parse HEAD>version.txt
echo Done!
