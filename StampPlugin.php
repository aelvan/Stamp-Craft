<?php

namespace Craft;

class StampPlugin extends BasePlugin
{
  public function getName()
  {
    return Craft::t('Stamp');
  }

  public function getVersion()
  {
    return '1.1';
  }

  public function getDeveloper()
  {
    return 'André Elvan';
  }

  public function getDeveloperUrl()
  {
    return 'http://vaersaagod.no';
  }
}