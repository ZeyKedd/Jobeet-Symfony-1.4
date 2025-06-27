<?php

/**
 * affiliate actions.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfJobeetAffiliateActions extends sfActions
{


  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JobeetAffiliateForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JobeetAffiliateForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $jobeet_affiliate = $form->save();

      $this->redirect($this->generateUrl('affiliate_wait', $jobeet_affiliate));
    }
  }
  public function executeWait(sfWebRequest $request){}

  public function executeLogin(sfWebRequest $request)
  {
    $this->form = new JobeetAffiliateLoginForm();

    if ($request->isMethod(sfRequest::POST)) {
        $this->form->bind($request->getParameter($this->form->getName()));

        if ($this->form->isValid()) {
            return $this->processLoginForm($request, $this->form);
        }
    }
  }

  public function processLoginForm(sfWebRequest $request, sfForm $form)
  {
      $this->redirect($this->generateUrl('api_jobs', array(
        'token' => $form->getValue('token'),
        'sf_format' => $form->getValue('format', 'json'), 
      )));
  }

  

}
