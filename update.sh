#!/bin/bash

# delete directory
rm -rf adm
rm -rf bbs
rm -rf css
rm -rf extend
rm -rf img
rm -rf install
rm -rf js
rm -rf lib
rm -rf mobile
rm -rf plugin
rm -rf shop
rm -rf skin
rm -rf theme
rm -rf *.php
rm -rf *.sh
rm -rf *.txt

# extract file
tar -zxvf yc.tar.gz

# delete zip file
rm -rf yc.tar.gz
