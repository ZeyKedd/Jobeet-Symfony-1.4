<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/backend/job')->

  with('request')->begin()->
    isParameter('module', 'backend_job')->
    isParameter('action', 'index')->
  end()
;
