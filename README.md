Newspedler.com +
=======================

Introduction
------------

        
Requirements
------------
server:
- server 
- apache 2
- Mysql

please refer to system requirement for Zend Framework 2

Installation
------------

1. (Source Code) First, Download the sourcecode from git 


2. Download ZendFramework2 http://framework.zend.com/downloads/latest
  uncompress the file to a secure location eg /home/marvin/ZendFramework2.3.3

3.(Setup the APACHE web server

# Normal set up for UBUNTO 14.02 see apace 2 vhost configuration 

<VirtualHost marvin.sourcefit.com:80>
   ServerName marvin.sourcefit.com
   DocumentRoot /var/www/vhost/newspedler.com/public
   SetEnv APPLICATION_ENV "development"
   SetEnv ZF2_PATH "path/to/zend/library"
   <Directory /var/www/vhost/newspedler.com/public/>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
   </Directory>
</VirtualHost>

Note: 
set the APPLICATION_ENV to "production" when
deploying to live site

3. create a symlink from application source folder and the configured VHOST

sudo ln -s /home/marvin/Documents/vhost/ vhost
create a file local.php on config/autoload/

  <?php
return array(
    'db' => array(
        'username' => '<DBUSER>',
        'password' => '<DBPASSWORD>',
    ),
);

4. DB schema
 CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `mi` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

