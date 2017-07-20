#!/bin/bash
/usr/bin/mysqld_safe & sleep 5
mysql -u root -e "CREATE DATABASE 420px"
mysql -u root 420px < /tmp/dump.sql
sleep infinity