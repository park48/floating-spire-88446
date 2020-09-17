#!/bin/sh

bundle exec rake db:migrate
bundle exec rake db:seed
bundle exec my_sample:load
