#!/bin/bash

DEPLOY_DIR=`dirname $0`
ROOT=`readlink -f $DEPLOY_DIR/..`
WP_ROOT="$ROOT/wordpress"

HOST='sftp.flywheelsites.com'
REMOTE_WP_ROOT='/org-mapaction/mapactionmain_staging'
PATH_TO_UPLOADS='wp-content/uploads'

NOW=`date +"%Y-%m-%d_%H-%M"`

echo -n "Please enter your username for $HOST: "
read USERNAME

# Backup local uploads
mv "${WP_ROOT}/${PATH_TO_UPLOADS}" "${WP_ROOT}/${PATH_TO_UPLOADS}_$NOW.bak"

# Fetch remote uploads
sftp "$USERNAME@$HOST" <<END
    get -r "$REMOTE_WP_ROOT/$PATH_TO_UPLOADS" "$WP_ROOT/$PATH_TO_UPLOADS"
END
