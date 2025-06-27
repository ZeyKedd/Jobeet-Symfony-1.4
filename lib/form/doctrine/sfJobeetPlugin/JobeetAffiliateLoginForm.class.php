<?php

class JobeetAffiliateLoginForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'token' => new sfWidgetFormInputText(),
            'format' => new sfWidgetFormChoice(array(
                'choices' => array('json' => 'JSON', 'xml' => 'XML', 'yaml' => 'YAML'),
            )),
        ));;

        $this->setValidators(array(
            'token' => new sfValidatorString(array('required' => true)),
            'format' => new sfValidatorChoice(array(
                'choices' => array('json', 'xml', 'yaml'),
                'required' => false,
            )),
        ));

        $this->widgetSchema->setNameFormat('affiliate_login[%s]');
        $this->widgetSchema['token']->setLabel('API token');
    }
}
