#!/bin/sh
DIR=$(cd $(dirname $0)/../tmp/cache;pwd)
FILENAME="columbus_*"

for f in `find "${DIR}" -name "${FILENAME}"`
do
        echo ${f}
        rm -rf ${f}
done
