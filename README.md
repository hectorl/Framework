Framework
=========

Simple framework that uses MVC. It uses [HTML5 Boilerplate](http://html5boilerplate.com/) as front-end template and [Smarty](http://smarty.net) as template engine. It is ready to support localization and is really easy to integrate your own solutions.

## Prerequisites
* PHP >= v5.3.2
* Mod rewrite

## How it works
Using friendly URL's we can know the controller, method and parameters that we are going to use. For exmaple, using the URL:

`http://mydomain.com/videos/load/id/1234`

The framework will try to search into the controller **videos** the method **load** using as parameter the **id 1234**

## Installation
1. Download the framework.
2. Inisde **config/**, set all variables.
3. Run your app and check if all works!

### Your app is in a subfolder

If the URL of your app looks like `http://mydomain.com/my_app/`, you have to change the line `RewriteRule ^(.*)$ index.php/$1 [L]` to `RewriteRule ^(.*)$ my_app/index.php/$1 [L]` in the .htaccess. Then, be sure that `AllowOverride` is set to `All` in order to make the rewrite rule work.