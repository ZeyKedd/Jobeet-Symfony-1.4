<?php



/*
metodos peticion

isParameter()	Comprueba un valor de un parámetro
isFormat()	Verifica el formato de una petición
isMethod()	Verifica el método
hasCookie()	Chequea si la petición tiene una cookie con el nombre dado
isCookie()	Verifica el valor de una cookie
  
    metodos repuesta
    
    checkElement()	Comprueba si un selector CSS de la respuesta coincide con algunos criterios
    checkForm()	Checks an sfForm form object
    debug()	Prints the response output to ease debug
    matches()	Tests a response against a regexp
    isHeader()	Verifica el valor de una cabecera
    isStatusCode()	Verifica el código de estado de la respuesta
    isRedirected()	Verifica si la respuesta actual es un redireccionamiento
    */
    

include(dirname(__FILE__) . '/../../bootstrap/functional.php');
$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

$browser->info('1 - The category page')->
  info('  1.1 - Categories on homepage are clickable')->
  get('en/')->
  click('Programming')->
  with('request')->begin()->
    isParameter('module', 'sfJobeetCategory')->
    isParameter('action', 'show')->
    isParameter('slug', 'programming')->
  end()->
 
  
// El número mostrado (como “15”) corresponde a los trabajos ocultos 
  info(sprintf('  1.2 - Categories with more than %s jobs also have a "more" link', sfConfig::get('app_max_jobs_on_homepage')))->
  get('en/')->
  click('15')->
  with('request')->begin()->
    isParameter('module', 'sfJobeetCategory')->
    isParameter('action', 'show')->
    isParameter('slug', 'programming')->
  end()->
 
  info(sprintf('  1.3 - Only %s jobs are listed', sfConfig::get('app_max_jobs_on_category')))->
  with('response')->checkElement('.jobs tr', sfConfig::get('app_max_jobs_on_category'))->

 

  // Rectifica que el numero de trabajos en la paginacion dentro de la categoria sea correcto
  info('  1.4 - The job listed is paginated')->
  with('response')->begin()->
    checkElement('.pagination_desc', '/19 jobs/')->
    checkElement('.pagination_desc', '#page 1/2#')->
  end()->
 
  click('2')->
  with('request')->begin()->
    isParameter('page', 2)->
  end()->
  with('response')->checkElement('.pagination_desc', '#page 2/2#')

;