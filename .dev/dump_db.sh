#!/bin/bash
#
# This script dumps the DB using config from wp-config.ini
#
# To restore the DB use the following commands:
#     source ../wp-config.ini
#     mysql --user=$db_user --password=$db_password $db_name < db_dump.sql

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

source $DIR/../wp-config.ini

mysqldump --add-drop-table --user=$db_user --password=$db_password $db_name > $DIR/db_dump.sql

