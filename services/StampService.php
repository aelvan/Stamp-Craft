<?php
namespace Craft;

class StampService extends BaseApplicationComponent
{
  
  var $settings = array();
  
	/**
	 * Gets a plugin setting
   * 
	 * @param $name String Setting name
	 * @return mixed Setting value
	 * @author André Elvan
	*/
  public function getSetting($name) {
    $this->settings = $this->_init_settings();
    return $this->settings[$name];
  }
  

	/**
	 * Gets Stamp settings from config
   * 
	 * @return array Array containing all settings
	 * @author André Elvan
	*/
  private function _init_settings() {
    $settings = array();
    $settings['stampPublicRoot'] = craft()->config->get('stampPublicRoot');
    
    return $settings;
  }
  
  
}
