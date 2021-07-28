#!/bin/bash
# This script is automatically run when the WP container starts. Run it manually with:
#    docker exec mytheme post-install.sh
# 
# If this file is changed you need to first apply it to the image/container with:
#    docker-compose up -d --build

cd /var/www/html

# Continue watiting for database to come up (or wp installed)
until wp core is-installed
do
    echo "Waiting for WP database..."
    sleep 3
done
echo "Wordpress database is up"

# Wait for compiler to create style sheet
until [ -f wp-content/themes/mytheme/style.css ]
do 
    echo "Waiting for compiler..."
    sleep 3
done
echo "Compiler has finished"

# Put your WP CLI commands here
wp option update blogname "My theme"
wp option update siteurl "http://localhost:42235"
wp option update home "http://localhost:42235"
wp theme activate mytheme
wp plugin install lazy-blocks --activate
wp plugin install kirki --activate

echo "Post install completed"
