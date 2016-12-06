#!/bin/bash

DEPLOY_DIR=`dirname $0`
ROOT=`readlink -f $DEPLOY_DIR/..`
WP_ROOT="$ROOT/wordpress"

HOST='sftp.flywheelsites.com'
REMOTE_WP_ROOT='/org-mapaction/mapactionmain_staging'
PATH_TO_PLUGIN_FOLDER='wp-content/plugins'
PLUGIN_1_NAME='ma-home-widget'
PLUGIN_2_NAME='ma-widget-insert'

NOW=`date +"%Y-%m-%d_%H-%M"`

echo -n "Please enter your username for $HOST: "
read USERNAME

sftp "$USERNAME@$HOST" <<END
    rename "$REMOTE_WP_ROOT/$PATH_TO_PLUGIN_FOLDER/$PLUGIN_1_NAME" "$REMOTE_WP_ROOT/${PLUGIN_1_NAME}_$NOW.bak"
    mkdir "$REMOTE_WP_ROOT/$PATH_TO_PLUGIN_FOLDER/$PLUGIN_1_NAME"
    put -r "$WP_ROOT/$PATH_TO_PLUGIN_FOLDER/$PLUGIN_1_NAME" "$REMOTE_WP_ROOT/$PATH_TO_PLUGIN_FOLDER"

    rename "$REMOTE_WP_ROOT/$PATH_TO_PLUGIN_FOLDER/$PLUGIN_2_NAME" "$REMOTE_WP_ROOT/${PLUGIN_2_NAME}_$NOW.bak"
    mkdir "$REMOTE_WP_ROOT/$PATH_TO_PLUGIN_FOLDER/$PLUGIN_2_NAME"
    put -r "$WP_ROOT/$PATH_TO_PLUGIN_FOLDER/$PLUGIN_2_NAME" "$REMOTE_WP_ROOT/$PATH_TO_PLUGIN_FOLDER"
END
