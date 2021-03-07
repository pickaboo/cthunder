# Thunder - a simple bug hunt helper
##
 Thunder is a simple, light weight, debug helper for the PHP framework [Anax](https://github.com/mosbth/Anax-MVC).
By setting a marker in a class or a function - a frame will be generated that can be viewed by adding the View to you page. 

**The marker will provide information about**

- Text (your own message)  
- Selected variable (optional)
- Name of current Class
- Name of current Function
- Filepath 
- Time
- Time passed since last mark
 
See below for Usage and more info. 

By Andreas Hultman, [andreas.hultman@me.com](mailto:andreas.hultman@me.com)

## License
This software is free software and carries a MIT license.

## Use of external libraries
Thunder uses [Bootstrap](http://getbootstrap.com "Bootstrap") and [Fontawesome](http://fortawesome.github.io/Font-Awesome/ "Fontawesome"). These are included in the view template using the CDN support from [maxCDN](www.maxcdn.com).
So make sure that you are online when using Thunder.  
## Installation
You can either clone it from github or use Composer to install with [Packagist](https://packagist.org/packages/anhu/thunder "Thunder @ Packagist"). 
For installation with Composer - require the package in your composer.json using: 

    "anhu/thunder": "dev-master"

**add to project**

In Anax the easiest way to include Thunder is to add it do $di in the froncontroller. 

    $di->setShared('thunder', function() {
    $thunder = new \Anhu\Thunder\CThunder();
    return $thunder;  
    });

**output result to a view**

A template view are included in the package (thunder.tpl.php). In Anax framework just simply move it to your view folder and add in frontcontroller. 


    $app->router->add('thunder', function() use ($app) {   
    $app->theme->setVariable('title', "Thunder test");
    $app->views->add('packTest/thunder', [ 
    'content' => $app->thunder->getMarkers(), ]);
    });


## Usage
When thunder is included you can put a mark anywhere in your code. When the mark runs - information is saved to the session and will be available  for output in a view. 
There are several different ways you can set a mark. 

Examples below shows how mark is set after thunder are included in $di - in the Anax framework. If included in another way make sure to adjust path to setMarker. 


**the marker**

The mark is set by calling the setMarker function and passing a message and an optional parameter.  

`$this->di->thunder->setMarker("This is my own message", $Optional);` 

Its possible to pass values in the first parameter aswell and use Html. 

`$this->di->thunder->setMarker("<h1>Value of $x -> Value of $z</h1>", $testVar);` 

knock your self out ...
## History
8/29/2014 Ver 0.1 - First attempt 

