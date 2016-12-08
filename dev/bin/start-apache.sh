#!/bin/bash

BIN_DIR=`dirname $0`
ROOT=`readlink -f $BIN_DIR/../..`

# Rebuild the image if needed
docker build -t mapaction-apache $ROOT/dev/docker/mapaction-apache

# Stop and delete running container
docker rm -f mapaction-apache

# Start the container
docker run --name mapaction-apache -d -v $ROOT/wordpress:/var/www/html -p 8080:80 --link mapaction-mysql:mapaction-mysql mapaction-apache
