# laravel auto route
laravel General Route to allow You not to put every general route in the route file

# Installation
run this command ```composer require hosamaldeen/auto_route```

# Route Rules
there are 4 ways for general routes based on the count of the segments 
  * Urls that include 1 segments like **/product**
  <br />will request **ProductController@index**
    
  * Urls that include 2 segments **/product/all**
  <br />will request **ProductController@all**
  
  * Urls that include 2 segments and the second segment is number like **/product/1**
  <br />will request **ProductController@view**
  <br />and pass the value to the function as {id}
  
  * Urls that include 3 segments **/product/search/1**
  <br />will request **ProductController@search**
  <br />and pass the value to the function as {id}

# Usage
in your route file add this 
```
$defaultRoute = new hosamaldeen\auto_route\Route;
$defaultRoute->create();
```
you can add some options to your routes 
```
$defaultRoute = new hosamaldeen\auto_route\Route;
$defaultRoute->prefix = '';
$defaultRoute->middleware = [];
$defaultRoute->namespace = '';
$defaultRoute->create();
```

# Full Example
```
$defaultRoute = new hosamaldeen\auto_route\Route; // frontend
$defaultRoute->create();

$defaultRoute = new hosamaldeen\auto_route\Route; //backend
$defaultRoute->prefix = '/backend';
$defaultRoute->middleware = ['web'];
$defaultRoute->namespace = 'Backend';
$defaultRoute->create();
```


