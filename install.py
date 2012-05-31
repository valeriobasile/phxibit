#!/usr/bin/env python
# install
#
# This is the installation script for Phxibit.
# The script asks for the authentication data for FTP and MySQL database,
# writes the Phxibit configuration variables in its config file, and
# copies the php source files to the remote site via FTP.
#
# Valerio Basile, May 2012

# given an SQL database dump, e.g. from phpmyadmin, returns a list of
# queries, filtering out comments.
def get_queries(sql):
    lines = sql.split("\n")
    lines_nocomment = filter(lambda x: not(x[:2]=="--" or x[:2]=="/*" or len(x)==0), lines)
    sql_nocomment = "\n".join(lines_nocomment)
    return sql_nocomment.split(";")[:-1]
    
from getpass import getpass
import ftplib
import sys
import MySQLdb
import os

CONFIG_FILE = "src/config/config.ini"
SQL_FILE = "create_schema.sql"
SRC_DIR = "src"

# FTP configuration
'''
ftp_host = raw_input("FTP host: ")
ftp_user = raw_input("FTP username: ")
ftp_pass = getpass("FTP password: ")
ftp_dir = raw_input("FTP directory: [/] ")
ftp_dir = ftp_dir or "/" # default FTP directory is /
'''
ftp_host = "vicious"
ftp_user = "myuser"
ftp_pass = "mypass"
ftp_dir = "/var/www/phxibit"

try:
    ftp = ftplib.FTP(ftp_host)
except:
    sys.stderr.write("cannot connect to FTP server {0}\n".format(ftp_host))
    sys.exit(1)
    
try:
    ftp.login(ftp_user, ftp_pass)
except:
    sys.stderr.write("FTP login error (username: {0})\n".format(ftp_user))
    sys.exit(1)

try:
    ftp.cwd(ftp_dir)
except:
    sys.stderr.write("cannot change FTP directory to {0}\n".format(ftp_dir))
    sys.exit(1)

local_base_dir = os.getcwd()
for (local_dir, _,local_files) in os.walk(SRC_DIR):
    if local_dir == SRC_DIR:
        os.chdir(local_dir)
        for local_file in local_files:
            ftp.storlines("STOR {0}".format(local_file), open(local_file))
        os.chdir(local_base_dir)
    else:
        rel_dir = "/".join(local_dir.split("/")[1:])
        try:
            ftp.mkd(rel_dir)
        except ftplib.error_perm as e_str:
            sys.stderr.write("{0} ({1})\n".format(e_str, "MKD {0}".format(rel_dir)))
        ftp.cwd(rel_dir)
        os.chdir(local_dir)
        for local_file in local_files:
            ftp.storlines("STOR {0}".format(local_file), open(local_file))
        ftp.cwd(ftp_dir)
        os.chdir(local_base_dir)
sys.exit(0)

# Database configuration (MySQL)
'''
mysql_host = raw_input("MySQL host: ")
mysql_user = raw_input("MySQL username: ")
mysql_pass = getpass("MySQL password: ")
mysql_db = raw_input("MySQL database: ")
'''
mysql_host = "vicious"
mysql_user = "myuser"
mysql_pass = "mypass"
mysql_db = "phxibit"

sql_fd = open(SQL_FILE, "r")
sql = sql_fd.read()
sql_fd.close()

for sql_query in get_queries(sql):
    try:
        db=MySQLdb.connect(host=mysql_host,
                      user=mysql_user,
                      passwd=mysql_pass,
                      db=mysql_db)
        cursor = db.cursor ()
        sys.stderr.write("{0}\n".format(sql_query))
        cursor.execute(sql_query)
        cursor.close ()
        db.close ()
    except MySQLdb.Error as (e_num, e_str):
        sys.stderr.write("MySQLdb error {0}: {1}\n".format(e_num, e_str))




