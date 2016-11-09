#!/bin/bash
BIN_DIR=`dirname $0`
ROOT=`readlink -f $BIN_DIR/../..`

# Ensure the mysql_data folder exists
mkdir -p $ROOT/dev/mysql_data

# Build the image if needed
docker build -t mapaction-mysql $ROOT/dev/docker/mapaction-mysql

# Stop and delete any running container
docker rm -f mapaction-mysql

# Start the container
docker run --name mapaction-mysql -d -v $ROOT/dev/mysql_data:/var/lib/mysql mapaction-mysql
