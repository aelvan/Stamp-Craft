<?php
/**
 * Stamp plugin for Craft CMS 4.x
 *
 * A simple plugin for adding timestamps to filenames.
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */

namespace aelvan\stamp;

use craft\base\Model;
use craft\base\Plugin;
use aelvan\stamp\variables\StampVariable;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;


class Stamp extends Plugin
{

    public static $plugin;

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('stamp', StampVariable::class);
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return new \aelvan\stamp\models\Settings();
    }

}
