#!/usr/bin/env bash

touch database/database.sqlite
chmod 777 database/database.sqlite
docker build -t fleet-management .
#docker-compose up -d
docker run -p 8001:8000 fleet-management
