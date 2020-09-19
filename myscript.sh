#!/bin/sh

php artisan migrate
pg_dump $STG_DATABASE_URL | psql $DATABASE_URL
