#!/bin/bash -x
EXPECTED_ARGS=5
E_BADARGS=65
MYSQL=`which mysql`

dbhost=$1
dbname=$2
dbuser=$3
dbpass=$4
dbschema=$5
  
Q0="DROP DATABASE IF EXISTS ${dbname} ;"
Q1="CREATE DATABASE ${dbname};"
Q2="GRANT USAGE ON *.* TO ${dbuser}@${dbhost} IDENTIFIED BY '"${dbpass}"';"
Q3="GRANT ALL PRIVILEGES ON ${dbname}.* TO ${dbuser}@${dbhost};"
Q4="FLUSH PRIVILEGES;"
Q5="USE ${dbname};"
Q6="SOURCE ${dbschema};"
SQL="${Q0}${Q1}${Q2}${Q3}${Q4}${Q5}${Q6}"
  
if [ $# -ne $EXPECTED_ARGS ]
then
  echo "Usage: $0 dbhost dbname dbuser dbpass dbschema"
  exit $E_BADARGS
fi
  
$MYSQL -u root -p -e "${SQL}"
