<?php
/**
 * Stamp plugin for Craft CMS 3.x
 *
 * A simple plugin for adding timestamps to filenames.
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */

namespace aelvan\stamp\models;

use craft\base\Model;

class Settings extends Model
{
    public $publicRoot = null;
}