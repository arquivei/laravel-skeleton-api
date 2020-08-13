#!/bin/sh

export LD_LIBRARY_PATH="$(which openssl)"

APP_IDENTIFIER=$(grep APP_IDENTIFIER= .env.dist | cut -d '=' -f 2-)
echo "APP_IDENTIFIER=$APP_IDENTIFIER"

if [ ! -f .env ]; then
    cp .env.dist .env
fi

