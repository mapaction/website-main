#!/bin/bash

DEPLOY_DIR=`dirname $0`
ROOT=`readlink -f $DEPLOY_DIR/..`
WP_ROOT="$ROOT/wordpress"

HOST='sftp.flywheelsites.com'
REMOTE_WP_ROOT='/org-mapaction/mapactionmain_staging'
PATH_TO_THEME_FOLDER='wp-content/themes'
THEME_NAME='mapaction'

NOW=`date +"%Y-%m-%d_%H-%M"`

echo -n "Please enter your username for $HOST: "
read USERNAME

sftp "$USERNAME@$HOST" <<END
    rename "$REMOTE_WP_ROOT/$PATH_TO_THEME_FOLDER/$THEME_NAME" "$REMOTE_WP_ROOT/${THEME_NAME}_$NOW.bak"
    mkdir "$REMOTE_WP_ROOT/$PATH_TO_THEME_FOLDER/$THEME_NAME"
    put -r "$WP_ROOT/$PATH_TO_THEME_FOLDER/$THEME_NAME" "$REMOTE_WP_ROOT/$PATH_TO_THEME_FOLDER"
END
