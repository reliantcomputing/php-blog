## Deploy using LAMP stack

### Creating a droplet at Digital ocean.

-   Choose LAMP stack template

### Login to your server

-   Login as root@ip_address

### Install php and all extensions required by Laravel

`apt-get update && apt-get upgrade`
`sudo apt install php-mbstring php-xml php-bcmath`
`add-apt-install composer`

### Setting up your database

-   run sudo `mysql_secure_installation` and follow th instruction
-   open mysql shell
    `sudo mysql`
-   Create a database
    `CREATE DATABASE blog;`
-   Create a new user then grant permissions
    `GRANT ALL ON blog.* TO 'blog_user'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;`
-   Exit mysql shell
    `exit`

### Install Laravel project from GitHub

`cd /var/www/html`
`git clone https://github.com/reliantcomputing/php-blog.git`
`cd php-blog`
`composer install`

-   set db name, username: root, password: you password
    `sudo vim .env`
    `php artisan key:generate`
    `php artisan migrate`

### Apache configuration

`cd /etc/apache2`
`sudo vi 000-default.conf`

<VirtualHost \*:80>

ServerAdmin webmaster@localhost

DocumentRoot /var/www/html/php-blog/public

<Directory /var/www/html/php-blog/public>

Options Indexes FollowSymLinks

AllowOverride All

Require all granted

</Directory>

ErrorLog ${APACHE_LOG_DIR}/error.log

CustomLog ${APACHE_LOG_DIR}/access.log combined

<IfModule mod_dir.c>

DirectoryIndex index.php index.pl index.cgi index.html index.xhtml index.htm

</IfModule>

</VirtualHost>

`:wq`

### Restart apache

`sudo a2enmod rewrite`
`sudo service apache2 restart`
`sudo chmod -R 777 storage`
