#!/bin/bash

BIN_DIR=`dirname $0`
ROOT=`readlink -f $BIN_DIR/../..`

compass watch --sass-dir "$ROOT/wordpress/wp-content/themes/mapaction/sass" --css-dir "$ROOT/wordpress/wp-content/themes/mapaction/" --sourcemap
