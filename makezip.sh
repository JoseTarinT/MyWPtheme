#!/bin/sh
docker exec mytheme-compiler npm run production
docker exec mytheme-compiler npm run bundle
docker cp mytheme-compiler:/home/node/mytheme.zip .
