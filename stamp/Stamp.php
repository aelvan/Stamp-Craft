<?php
namespace craft\plugins\stamp;

use \craft\app\base\Plugin;

class Stamp extends Plugin
{
    public static $plugin;

    /**
     * Stamp constructor.
     *
     * @param string $id
     * @param null $parent
     * @param array $config
     */
    public function __construct($id, $parent = null, $config = [])
    {
        static::$plugin = $this;
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    /**
     * Registers Stamp template variables
     *
     * @return string
     */
    public function getVariableDefinition()
    {
        return 'craft\plugins\stamp\variables\StampVariable';
    }
}