Initial Requirements:
I am assuming that you have LAMP and composer installed in your system

To install composer follow this link (if not installed):
https://www.ionos.com/community/hosting/php/install-and-use-php-composer-on-ubuntu-1604/


Your Mysql db should have table below:

Please create a db or use amn existing db of yours and create below table in it
Step 1:


CREATE TABLE `tbl_food_items` 
  (`id`         INT(11) UNSIGNED NOT NULL auto_increment, 
     `item_id`    INT(11) NOT NULL DEFAULT '0', 
     `name`       VARCHAR(255) NOT NULL DEFAULT '', 
     `group_name` VARCHAR(255) NOT NULL DEFAULT '', 
     `calories`   FLOAT NOT NULL DEFAULT '0', 
     `added_on`   INT(11) NOT NULL DEFAULT '0', 
     `status`     TINYINT(3) NOT NULL DEFAULT '1', 
     PRIMARY KEY (`id`), 
     KEY `itemid` (`item_id`), 
     KEY `status` (`status`) 
  ); 
Step 2:
Please unzip the folder and copy the same to your lamp directory (/var/www for linux or htdocs for windows)

Step 3:
Copy env.txt file  attached to root of project and rename it to .env (mandatory as it is required for db connection) 

Step 4:
Please edit mysql db credentials in .env (starts at line 7)

Step 5:
Note: I have used mysql as db so change your mysql db credentials in there
Whatever you change you should copy the same in app/config/database.php

Step 6:
Run  composer update  command from terminal on root of the project to load dependency libraries 

After all the libraries are loaded run following two commands

Step 7:
php artisan key:generate //generating encryptio key for app
php artisan serve  //serving app to local env

Make sure your storage folder has write permissions

Now open the link to look up the project on local

if you are deplotying to ssl server ,please add following line in voot function inside AppServiceProvider.php file
\URL::forceScheme('https');
