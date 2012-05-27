#!/usr/bin/env python
# install
#
# This is the installation script for Phxibit.
# The script asks for the authentication data for FTP and MySQL database,
# writes the Phxibit configuration variables in its config file, and
# copies the php source files to the remote site via FTP.
#
# Valerio Basile, May 2012

from getpass import getpass
from ftplib import FTP
import sys

CONFIG_FILE = "src/config/config.ini"

# FTP configuration
ftp_host = raw_input("FTP host: ")
ftp_user = raw_input("FTP username: ")
ftp_pass = getpass("FTP password: ")
ftp_dir = raw_input("FTP directory: [/] ")
ftp_dir = ftp_dir or "/" # default FTP directory is /

try:
    ftp = FTP(ftp_host)
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

print (ftp.retrlines('LIST'))

# Database configuration (MySQL)

sys.exit(0)
mysql_host = raw_input("MySQL host: ")
mysql_user = raw_input("MySQL username: ")
mysql_pass = getpass.getpass("MySQL password: ")
mysql_db = raw_input("MySQL database: ")


