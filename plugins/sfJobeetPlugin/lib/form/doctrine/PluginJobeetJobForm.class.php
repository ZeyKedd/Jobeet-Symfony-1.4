<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginJobeetJobForm extends BaseJobeetJobForm
{
  public function configure()
  {

    $this->disableCSRFProtection();



  // Configura que no mostrara en la tabla -> se refactoriza en un metodo para reutilizat en otra clase
    // unset(
    //   $this['created_at'],
    //   $this['updated_at'],
    //   $this['expires_at'],
    //   $this['is_activated'],
    //   $this['token']
    // );


    
    
    $this->removeFields();



    // para agregar mas de un schema de validacion se usa el sfvalidatorAnd(array(...)) mas un array
    // en cambio un solo validador remplazar sfValidatorAnd(array) por el requerido sfValidatorX() 


    //  Validar email 
    $this->validatorSchema['email'] = new sfValidatorAnd(array(
      $this->validatorSchema['email'],
      new sfValidatorEmail()
    ));

    // Un desplegable para el tipo de trabajo(full time...)

    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
      'choices' => Doctrine_Core::getTable('JobeetJob')->getTypes(),
      'expanded' => false,
    ));

    // validar que se seleccione uno del array
    $this->validatorSchema['type'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine_Core::getTable('JobeetJob')->getTypes()),
    ));

    // un espacio para poner el logo de la empresa
    $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
      'label' => 'Company logo',
    ));

    // ponerle label a los recuadros  (informacion dentro deel recuadro)
    $this->widgetSchema->setLabels(array(
      'category_id'    => 'Category',
      'is_public'      => 'Public?',
      'how_to_apply'   => 'How to apply?',
    ));

    // validacion de la imagen

    $this->validatorSchema['logo'] = new sfvalidatorFile(array(
      'required' => false,
      'path' =>  sfConfig::get('sf_upload_dir') . '/jobs', //lo almacena en la ruta dada
      'mime_types' => 'web_images', //Verifica qeu sea un formato web
    ));

    $this->widgetSchema->setHelp('is_public', 'Si el trabajo puede publicarse también en sitios web afiliados o no.');

    $this->widgetSchema->setNameFormat('job[%s]');
  }
  
  protected function removeFields()
  {
    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['expires_at'],
      $this['is_activated'],
      $this['token']
    );
  }
}