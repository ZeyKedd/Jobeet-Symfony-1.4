<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Sebastian Hernandez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfJobeetJobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    //Pagina segun idioma
    if (!$request->getParameter('sf_culture')) {
      if ($this->getUser()->isFirstRequest()) {
        $culture = $request->getPreferredCulture(array('en', 'fr'));
        $this->getUser()->setCulture($culture);
        $this->getUser()->isFirstRequest(false);
      } else {
        $culture = $this->getUser()->getCulture();
      }

      $this->redirect('localized_homepage');
    }
    $this->categories = Doctrine_Core::getTable('JobeetCategory')->getWithJobs();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->job = $this->getRoute()->getObject();
    $this->getUser()->addJobToHistory($this->job);

    //guardar ultimos trabajos vistos // myUser.Class.php

    // //Recupera trabajos ya visitados
    // $jobs = $this->getUser()->getAttribute('job_history', array());

    // // Agrega trabajo actual al array
    // array_unshift($jobs, $this->job->getId());

    // // Almacena el nuevo array a la sesion
    // $this->getUser()->setAttribute('job_history', $jobs);
  }

  // usuario le da a crear trabajo

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JobeetJobForm();
  }

  //usuario manda formulario lleno de crear trabajo

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new JobeetJobForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $job = $this->getRoute()->getObject();
    $this->forward404If($job->getIsActivated());

    $this->form = new JobeetJobForm($job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new JobeetJobForm($this->getRoute()->getObject());
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {

    $request->checkCSRFProtection();

    $job = $this->getRoute()->getObject();
    $job->delete();

    $this->redirect('sfJobeetJob/index');
  }

  // Verifica que los datos metidos en new y pasados a create sean validos para guardar
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    if ($form->isValid()) {
      $job = $form->save();
      $this->redirect($this->generateUrl('job_show', $job));
    }
  }

  public function executePublish(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $job = $this->getRoute()->getObject();
    $job->publish();

    $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days', sfConfig::get('app_active_days')));

    $this->redirect($this->generateUrl('job_show_user', $job));
  }


  public function executeExtend(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $job = $this->getRoute()->getObject();
    $this->forward404Unless($job->extend());

    $this->getUser()->setFlash('notice', sprintf('Your job validity has been extended until %s.', $job->getDateTimeObject('expires_at')->format('m/d/Y')));

    $this->redirect('job_show_user', $job);
  }

  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'sfJobeetJob', 'index');

    $this->jobs = Doctrine_Core::getTable('JobeetJob')->getForLuceneQuery($query);

    if ($request->isXmlHttpRequest()) {
      if ('*' == $query || !$this->jobs) {
        return $this->renderText('No Results');
      }
      return $this->renderPartial('sfJobeetJob/list', array('jobs' => $this->jobs));
    }
  }
}
