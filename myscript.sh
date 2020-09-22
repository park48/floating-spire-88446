#!/bin/sh

<<<<<<< HEAD
php artisan migrate
pg_dump $STG_DATABASE_URL | psql $DATABASE_URL
=======
bundle exec rake db:migrate
bundle exec rake db:seed
bundle exec my_sample:load
>>>>>>> origin/master
