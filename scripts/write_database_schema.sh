#!/bin/sh

mysqldump -d -u mysql -p natverk_development --host 0.0.0.0 --column-statistics=0 --skip-add-drop-table --result-file=./database/schema.sql;
