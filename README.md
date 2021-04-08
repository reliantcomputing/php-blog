## Deploy using LAMP stack

### Login to your server

-   Login as root
    ``

### Set up your firewall

-   Allow SSH.
    `ufw allow OpenSSH`
-   Enable firewall
    `ufw enable`
-   Check status if all is good
    `ufw status`

### Install php and all extensions required by Laravel

`apt-get update && apt-get upgrade`
`apt-get install python-software-properties`
`add-apt-repository ppa:ondrej/php`
`apt-get update`
`apt-get install php7.2`
`apt-get install php-pear php7.2-curl php7.2-dev php7.2-gd php7.2-mbstring php7.2-zip php7.2-mysql php7.2-xml`

### Setting up your database

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

```<VirtualHost *:80>

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
```
