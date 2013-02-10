#!/bin/bash
 
wget http://pecl.php.net/get/mongo-1.2.10.tgz
tar -xzf mongo-1.3.4.tgz
sh -c "cd mongo-1.3.4 && phpize && ./configure && sudo make install"
echo "extension=mongo.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`