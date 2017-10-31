<?php
namespace hosamaldeen\auto_route;

class Route
{
	public $prefix = '';
	public $namespace = '';
	public $middleware  ;
	
	public function create(){
		$segments = \Request::segments() ;
		$url = '';
		if($this->prefix!='')
		{
			$url = $this->prefix.'/';
			$prefix = explode('/', $this->prefix);
			$segments = array_values(array_diff($segments , $prefix));
		}
			
			
		$controllerNamespace = "\App\Http\Controllers\\" ;
		if($this->namespace!='')
			$controllerNamespace .= $this->namespace.'\\' ;
			
		if(count($segments) == 1) //controller/index
		{
			$controller = ucfirst($segments[0]).'Controller' ;
			$method = 'index';
			$url .= $segments[0] ;		
		}
		else if(count($segments) == 2 && is_numeric($segments[1]) ) //controller/show/{id}
		{
			$controller = ucfirst($segments[0]).'Controller' ;
			$method = 'show';
			$url .= $segments[0].'/{id}' ;
		}
		else if(count($segments) == 2) //controller/method
		{
			$controller = ucfirst($segments[0]).'Controller' ;
			$method = $segments[1];
			$url .= $segments[0].'/'.$segments[1] ;
		}
		else if(count($segments) == 3) //controller/method/parameter
		{
			$controller = ucfirst($segments[0]).'Controller' ;
			$method = $segments[1];
			$url .= $segments[0].'/'.$segments[1].'/{id}' ;
		}
		else return ;
		
		if(	class_exists($controllerNamespace.$controller) && method_exists($controllerNamespace.$controller ,$method ) )
		{
			\Route::any($url, $controllerNamespace.$controller.'@'.$method)->middleware($this->middleware);	
		}
	}
}