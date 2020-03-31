#!/bin/bash
echo Updating...
if [ ! -d "/var/www/npay/assets" ]; then
    mkdir /var/www/npay/assets
fi
if [ ! -d "/var/www/npay/protected/verbali" ]; then
    mkdir /var/www/npay/protected/verbali
fi
git stash
git pull

chmod -R ugo+rwx /var/www/npay/assets/
chmod -R ugo+rwx /var/www/npay/uploads/
chmod -R ugo+rwx /var/www/napay/custom/
chmod -R ugo+rwx /var/www/npay/protected/runtime/
chmod -R ugo+rwx /var/www/npay/protected/privatekeys/
chmod -R ugo+rwx /var/www/npay/protected/log/
chmod -R ugo+rwx /var/www/npay/protected/verbali/
chmod 755 /var/www/npay/protected/yiic
chmod 755 /var/www/npay/update.sh
chmod +x /var/www/npay/update.sh

echo Versioning...
git rev-parse HEAD>version.txt
echo Done!
