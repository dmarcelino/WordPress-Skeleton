#!/bin/bash
#
# This script configures WordPress file permissions based on recommendations
# from http://codex.wordpress.org/Hardening_WordPress#File_permissions
#
# Author: Michael Conigliaro <mike [at] conigliaro [dot] org>
#         https://gist.github.com/Adirael/3383404
#

USAGE="Usage: `basename $0` [wp_root_dir] [wp_owner] [wp_group] [webserver_group]"
if [ "$1" == "-h" ] || [ "$1" == "--help" ] ; then
    echo $USAGE
    exit 0 
fi

WP_ROOT=$1 # <-- wordpress root directory
if [ -z "$WP_ROOT" ]; then
    WP_ROOT=.
fi

WP_OWNER=$2 # <-- wordpress owner

WP_GROUP=$3 # <-- wordpress group, defaults to $WP_OWNER
if [ -z "$WP_GROUP" ]; then
    WP_GROUP=$WP_OWNER
fi

WS_GROUP=$4 # <-- webserver group
# if [ -z "$WS_GROUP" ]; then
#     WS_GROUP=$WP_GROUP
# fi


# reset to safe defaults (ignore hidden files and folders)
if [ -n "$WP_OWNER" ]; then
    echo "Fix ownership of files and folders..."
    find ${WP_ROOT} -not -path '*/\.*' -exec chown -c ${WP_OWNER}:${WP_GROUP} {} \;
else
    echo "Skipping ownership as [wp_owner] arg was not provided"
fi
echo "Fix permissions of files and folders..."
find ${WP_ROOT} -type d -not -path '*/\.*' -exec chmod -c 755 {} \;
find ${WP_ROOT} -type f -not -path '*/\.*' -exec chmod -c 644 {} \;

# allow wordpress to manage wp-config.php (but prevent world access)
if [ -n "$WS_GROUP" ]; then
    echo "Fix group for wp-config.php..."
    chgrp -c ${WS_GROUP} ${WP_ROOT}/wp-config.php

    echo "Fix permissions for wp-config.php..."
    chmod -c 660 ${WP_ROOT}/wp-config.php
else
    echo "Skipping ownership of wp-config.php as [webserver_group] arg was not provided"
    echo "Fix permissions for wp-config.php..."
    chmod -c 640 ${WP_ROOT}/wp-config.php
fi

# fix wp-config.ini if exists
if [ -e ${WP_ROOT}/wp-config.ini ]; then
    echo "Fix permissions for wp-config.ini..."
    chmod -c 640 ${WP_ROOT}/wp-config.ini
fi

# allow wordpress to manage wp-content
if [ -n "$WS_GROUP" ]; then
    echo "Fix group for wp-content..."
    find ${WP_ROOT}/wp-content -exec chgrp -c ${WS_GROUP} {} \;

    echo "Fix permissions for wp-content..."
    find ${WP_ROOT}/wp-content -type d -exec chmod -c 775 {} \;
    find ${WP_ROOT}/wp-content -type f -exec chmod -c 664 {} \;
else
    echo "Skipping ownership of wp-content as [webserver_group] arg was not provided"
fi
