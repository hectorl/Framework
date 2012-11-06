Framework
=========

Simple framework that uses MVC. It uses [HTML5 Boilerplate](http://html5boilerplate.com/) as front-end template and [Smarty](http://smarty.net) as template engine. It is ready to support localization and is really easy to integrate your own solutions.

## Prerequisites
* PHP >= v5.3.2
* Mod rewrite

## How it works
Using friendly URL's we know the controller, method and parameters that we are going to use. For exmaple, using the URL:

`http://mydomain.com/videos/load/id/1234`

The framework will try to search into the controller **videos** the method **load** using as parameter the **id 1234**

## Installation
1. Download the framework.
2. Inisde **config/**, set all variables.
5. Run your app and check if all works!