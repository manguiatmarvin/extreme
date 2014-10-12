Sourcefit Management System CRM +
=======================

Introduction
------------
This application is meant to be used to support Sourcefit Philippines Employee and 
Client Management. This app has several perspectives 

1. CLIENT - will be able to cummunicate and track time table, work informations from   his/her service provider (sourcefit employee)

2. ADMIN - Can view add or remove settings required for this application
      - can also sends invites, create schedules.

3. HR  -  sends invites to join soucefit, will be able to update user fro GUEST to 
         employee. sends special notifications to employee 

4. ACCOUNTING - Will be able to communicate, track time table for each employee, create reports 

5. EMPLOYEE - Will be able to access his own time table, determines 
          remaining leaves, employement status

6. GUEST - will be able to create profile, uploads resume, and take online exam,
            view notifications from HR
        

Requirements
------------
server:
- server 
- apache 2
- Mysql

please refer to system requirement for Zend Framework 2

Installation
------------

1. (Source Code) First, Download the sourcecode from git (git@github.com:manguiatmarvin/osms.git)

put the soucecode in a secure location eg

/home/user/Documents/vhost/

2. Download ZendFramework2 http://framework.zend.com/downloads/latest
  uncompress the file to a secure location eg /home/marvin/ZendFramework2.3.3

3.(Setup the APACHE web server

# Normal set up for UBUNTO 14.02 see apace 2 vhost configuration 

<VirtualHost marvin.sourcefit.com:80>
   ServerName marvin.sourcefit.com
   DocumentRoot /var/www/vhost/marvin.sourcefit.com/public
   SetEnv APPLICATION_ENV "development"
   SetEnv ZF2_PATH "path/to/zend/library"
   <Directory /var/www/vhost/marvin.sourcefit.com/public/>
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

**** this app is currently under development, so please be resourceful, and also it will be a big help if you can seek help from expert. 



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


