<?php

require_once dirname(__FILE__) . '/../lib/backend_affiliateGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/backend_affiliateGeneratorHelper.class.php';

/**
 * backend_affiliate actions.
 *
 * @package    jobeet
 * @subpackage backend_affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class backend_affiliateActions extends autoBackend_affiliateActions
{
    public function executeListActivate()
    {
        $this->getRoute()->getObject()->activate();
        $this->redirect('jobeet_affiliate');

        $message = $this->getMailer()->compose(
            array('sebhr08@gmail.com' => 'Jobeet Bot'),
            $affiliate->getEmail(),
            'Jobeet affiliate token',
<<<EOF
            Your Jobeet affiliate account has ben activated
                            
            Your token is {$affiliate->getToken()}.

            The Jobeet Bot.
EOF
        );

        $this->getMailer()->send($message);
        $this->redirect('jobeet_affiliate');
    }

    public function executeListDesactivate()
    {
        $this->getRoute()->getObject()->desactivate();
        $this->redirect('jobeet_affiliate');
    }

    public function executeBatchActivate(sfWebRequest $request)
    {
        $q = Doctrine_Query::create()
            ->from('JobeetAffiliate a')
            ->whereIn('a.id', $request->getParameter('ids'));

        $affiliates = $q->execute();

        foreach ($affiliates as $affiliate) {
            $affiliate->activate();
        }

        $this->redirect('jobeet_affiliate');
    }

    public function executeBatchDesactivate(sfWebRequest $request)
    {
        $q = Doctrine_Query::create()
            ->from('JobeetAffiliate a')
            ->whereIn('a.id', $request->getParameter('ids'));

        $affiliates = $q->execute();

        foreach ($affiliates as $affiliate) {
            $affiliate->desactivate();
        }

        $this->redirect('jobeet_affiliate');
    }
}
