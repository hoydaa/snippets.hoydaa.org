<?php
 
class myUniqueValidator extends sfValidator
{    
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);
 
    // set defaults
    $this->setParameter('unique_error', 'Dublicate value for a unique field');
 
    $this->getParameterHolder()->add($parameters);
 
    return true;
  }
 
  public function execute(&$value, &$error)
  {
  	$class_name = $this->getParameter('class_name');
  	$field_const_name = $this->getParameter('field_const_name');
	$form_field_name = $this->getParameter('form_field_name');
	$form_field_value = $this->getContext()->getRequest()->getParameter($form_field_name);
	$form_id_name = $this->getParameter('form_id_name');
	if($form_id_name)
		$form_id_value = $this->getContext()->getRequest()->getParameter($form_id_name);
	

	$class = new ReflectionClass($class_name);
	if($class->hasConstant($field_const_name)) {

		$criteria = new Criteria();
		$criteria->add($class->getConstant($field_const_name), $form_field_value);
		if(isset($form_id_value) && $form_id_value && $class->hasConstant('ID'))
			$criteria->add($class->getConstant('ID'), $form_id_value, Criteria::NOT_EQUAL);
		
		if($class->hasMethod('doSelectOne')) {
			$ref_method = $class->getMethod('doSelectOne');
			$object = $ref_method->invoke(null, $criteria);
			if(!$object)
				return true;
		}
		sfContext::getInstance()->getLogger()->info('Buraya geldi');
	}
 
    $error = $this->getParameter('unique_error');
    return false;
  }
}