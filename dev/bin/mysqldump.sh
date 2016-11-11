#!/bin/bash

BIN_DIR=`dirname $0`
ROOT=`readlink -f $BIN_DIR/../..`
NOW=`date +"%Y-%m-%d_%H-%M"`

docker exec -t -i mapaction-mysql mysqldump -u mapaction -pmapaction mapaction > "$ROOT/dev/mapaction_$NOW.sql"
