<?php
namespace craft\plugins\stamp\services;

use Craft;
use craft\app\base\Component;

class StampService extends Component
{

    var $settings = array();

    /**
     * Gets a plugin setting
     *
     * @param $name String Setting name
     * @return mixed Setting value
     */
    public function getSetting($name)
    {
        $this->settings = $this->_init_settings();
        return $this->settings[$name];
    }
    
    /**
     * Gets Stamp settings from config
     *
     * @return array Array containing all settings
     */
    private function _init_settings()
    {
        $settings = array();
        $settings['stampPublicRoot'] = Craft::$app->config->get('stampPublicRoot');

        return $settings;
    }
}
