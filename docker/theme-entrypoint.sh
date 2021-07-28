#!/bin/bash
StartPostInstall() {
    # Wait a few seconds first for db
    sleep 3
    su www-data -s /bin/bash -c "post-install.sh"
}

StartPostInstall & # Fork
docker-entrypoint.sh "$@" # Start Wordpress
