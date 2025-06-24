<?php

/**
 * category actions.
 *
 * @package    jobeet
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfJobeetCategoryActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->category = $this->getRoute()->getObject();

    // if ($request->getRequestFormat() == 'atom') 
    // {
    //   $this->jobs = $this->category->getActiveJobs();
    //   $this->setTemplate('indexSuccess', 'job');
    // } else {


    $this->pager = new sfDoctrinePager(
      'JobeetJob',
      sfConfig::get('app_max_jobs_on_category')
    );
    $this->pager->setQuery($this->category->getActiveJobsQuery());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    // if ($request->getRequestFormat() == 'atom') {
    //   $this->setLayout(false);
    //   $this->getResponse()->setContentType('application/atom+xml');
    // }
  }
}
