#!/bin/bash

BIN_DIR=`dirname $0`
ROOT=`readlink -f $BIN_DIR/../..`

docker exec -t -i mapaction-mysql mysql -u mapaction -pmapaction mapaction
