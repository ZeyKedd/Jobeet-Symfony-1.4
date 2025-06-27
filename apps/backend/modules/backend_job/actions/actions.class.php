<?php

require_once dirname(__FILE__) . '/../lib/backend_jobGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/backend_jobGeneratorHelper.class.php';

/**
 * backend_job actions.
 *
 * @package    jobeet
 * @subpackage backend_job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class backend_jobActions extends autoBackend_jobActions
{

    public function executeBatchExtend(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');

        $q = Doctrine_Query::create()
            ->from('JobeetJob j')
            ->whereIn('j.id', $ids);

        foreach ($q->execute() as $job) {
            $job->extend(true);
        }

        $this->getUser()->setFlash('notice', 'The seleceted jobs have been extended successfully');
        $this->redirect('jobeet_job');
    }

    public function executeListExtend(sfWebRequest $request)
    {

        $job = $this->getRoute()->getObject();
        $job->extend(true);

        $this->getUser()->setFlash('notice', sprintf('The jobs %s have been extended successfully', $job->getId()));
        $this->redirect('jobeet_job');
    }

    public function executeListDeleteNeverActivated(sfWebRequest $request)
    {
        $nb = Doctrine::getTable('JobeetJob')->cleanup(60);

        if ($nb) {
            $this->getUser()->setFlash('notice', sprintf('%d never activated jobs have been deleted successfully.', $nb));
        } else {
            $this->getUser()->setFlash('notice', 'No job to delete.');;
        }
        $this->redirect('jobeet_job');
    }
}
