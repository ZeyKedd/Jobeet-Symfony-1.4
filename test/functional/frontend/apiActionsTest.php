<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new JobeetTestFunctional(new sfBrowser());
$browser-> loadData();


$browser->
  info('1 - Web Service Segurity')->

  info(' 1.1 - A token is needed to access the service')->
  get('/en/api/foo/job.xml')->
  with('response')->isStatusCode(404)->

  info(' 1.2 - an inactive account cannot access the web service')->
  get('/en/api/symfony/job.xml')->
  with('response')->isStatusCode(404)->

  info('2 - The jobs returned are limited to the categories configured for the affiliate')->
  get('/en/api/sensio_labs/jobs.xml')->
  with('request')->isFormat('xml')->
  with('response')->begin()->
    isValid()-> //NINGUN archivo <?xml puede tener algo antes de la sentecia xml
    checkElement('job', 19)-> //falla
  end()->
 
  info('3 - The web service supports the JSON format')->
  get('/en/api/sensio_labs/jobs.json')->
  with('request')->isFormat('json')->
  with('response')->matches('/"category"\: "Programming"/')->
 
  info('4 - The web service supports the YAML format')->
  get('/en/api/sensio_labs/jobs.yaml')->
  with('response')->begin()->
    isHeader('content-type', 'text/yaml; charset=utf-8')->
    matches('/category\: Programming/')->
  end()
;

