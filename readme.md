<a href="http://www.fandominc.com"><img src="/public/favicon.ico" align="right"></a>
# Internship Project for Fandom Inc. (Property/Unit Booking System for Sole Proprietorship Business)
## Instructions
- Copy or clone this project to your workstation.
- Install *NodeJs* and *NPM*.
- Then open your *terminal* and go to the folder of the project then type first `composer install` then `npm install`, you need internet connection for this.
- After the installation of dependencies, type to the terminal `gulp` to inform laravel elixir to compile JS/CSS files and store it to the public folder.
- Create an *.env file* and configure your database connection and configurations.
- Run the command `php artisan key:generate` for generating applications unique key.
- Run the command `php artisan preload` to migrate tables & pre-populate data to database.
- Run the command `php artisan storage:link` for property photo storage files location.
- And then run `php artisan serve` to browse the project at *localhost:8000*.

- <b>`For Development`</b> : open two terminals, on the first terminal run `php artisan serve` and for the second terminal run `gulp watch`, wait for the browser to open a tab that host *locahost:3000*


## Screenshots
<img src="/screenshots/home.png" alt="home_page"> <br>
<img src="/screenshots/property_list.png" alt="home_page"> <br>
<img src="/screenshots/property.png" alt="home_page">

> Creator: Oliver P. Carlos

# Made With Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.