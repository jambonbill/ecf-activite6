<?php
// Les contrôleurs appelleront des fichiers de vue vides pour l’instant 
// (les vues seront développées pendant l’activité suivantes).

require "../vendor/autoload.php";
require "../config/const.php";


$router = new AltoRouter();//https://altorouter.com/


// map homepage
$router->map( 'GET', '/', function(){
    //echo  "La theorie des cordes<hr />";
    $ctrl=new App\Controllers\BrandController();
    $ctrl->landingpage();//this is a quick fix
});

$router->map( 'GET', '/instruments', function() {
    
    $ctrl=new App\Controllers\InstrumentController();
    $ctrl->index();//list instruments
});

$router->map( 'GET', '/brands', function() {
    $ctrl=new App\Controllers\BrandController();
    $ctrl->index();    
});

$router->map( 'GET', '/types', function() {
    header("HTTP/1.0 404 Not Found");
    $ctrl=new App\Controllers\BrandController();
    $ctrl->landingpage();//this is a quick fix
});

$router->map( 'GET|POST', '/brand/add', function() {
    $ctrl=new App\Controllers\BrandController();
    $ctrl->add();
});


// match current request url
$match = $router->match();


// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}