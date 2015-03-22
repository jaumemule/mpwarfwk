# MPWAR Jaume Mulé Framework #

### How to install ###

Clone this repository in a shared folder and then execute the this commandline:

```zsh
$ git clone https://github.com/jaumemule/mpwarfwk.git frameworks

```

This framework allows 2 environtments:

* Development Environment:

```zsh

sudo vim /etc/httpd/conf.d/20-framework.dev.conf

<VirtualHost *:80>
 DocumentRoot /www/frameworks/public/
 ServerName framework.dev
 ServerAlias *.framework.dev

RewriteEngine On
 #Allowed media extensions (includes .txt files for robots or .html, e.g: Google hosted HTMLs):
 RewriteCond %{REQUEST_FILENAME} !^(.+)\.(js|css|gif|png|jpg|swf|ico|txt|html)$
 RewriteRule ^/(.+) /index_dev.php [QSA,L]
</VirtualHost>


```

* Production Environment:

```zsh
sudo vim /etc/httpd/conf.d/20-framework.prod.conf

<VirtualHost *:80>
 DocumentRoot /www/frameworks/public/
 ServerName framework.prod
 ServerAlias *.framework.prod

RewriteEngine On
 #Allowed media extensions (includes .txt files for robots or .html, e.g: Google hosted HTMLs):
 RewriteCond %{REQUEST_FILENAME} !^(.+)\.(js|css|gif|png|jpg|swf|ico|txt|html)$
 RewriteRule ^/(.+) /index.php [QSA,L]
</VirtualHost>


```

Load all framework dependencies with your command line:

```zsh

$ cd /www/frameworks
$ composer update

```

### Run Sample application ###

```http://framework.dev``` or ```http://framework.prod``` 

### Documentation ###

Inside the application, you can see a documentation page. Use it to learn how to use this framework in your application layer.

This is protected by session, so... first of all load database.sql file in your mysql

Then, login with user "Pablo" and "test" Password. Enjoy.


