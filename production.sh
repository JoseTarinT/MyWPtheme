#!/bin/bash
isInstalled()
{
    command -v "$1" >/dev/null 2>&1
}
if ! isInstalled node; then
    echo "Please install Node JS"
    exit 1
fi
if ! isInstalled npm; then
    echo "Please install NPM"
    exit 1
fi

npm i
npm run production
