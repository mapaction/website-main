#!/bin/bash

BIN_DIR=`dirname $0`
ROOT=`readlink -f $BIN_DIR/../..`

# Test for interactive shell
if [ -t 0 ]; then
	OPTS="-t -i"
else
	OPTS="-i"
fi
docker exec $OPTS mapaction-mysql mysql -u mapaction -pmapaction mapaction
