#!/bin/bash
echo Updating...
if [ ! -d "/var/www/volontaricovid.napoliblockchain.it/assets" ]; then
    mkdir /var/www/volontaricovid.napoliblockchain.it/assets
fi

git stash
git pull


chown -R www-data:www-data /var/www/volontaricovid.napoliblockchain.it/assets/
chown -R www-data:www-data /var/www/volontaricovid.napoliblockchain.it/protected/runtime/

chmod 755 /var/www/volontaricovid.napoliblockchain.it/protected/yiic
chmod 755 /var/www/volontaricovid.napoliblockchain.it/update.sh
chmod +x /var/www/volontaricovid.napoliblockchain.it/update.sh

echo Versioning...
git rev-parse HEAD>version.txt
echo Done!
