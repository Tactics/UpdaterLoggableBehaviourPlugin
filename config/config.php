<?php
 	
// register behavior hooks
sfPropelBehavior::registerHooks('updater_loggable', array(
  ':save:pre'   => array('ttUpdaterLoggableBehaviour', 'preSave')
));
 	
sfPropelBehavior::registerMethods('updater_loggable', array (
  array ('ttUpdaterLoggableBehaviour', 'getCreatedByAccount'),
  array ('ttUpdaterLoggableBehaviour', 'getUpdatedByAccount'),
  array ('ttUpdaterLoggableBehaviour', 'getCreatedByPersoon'),
  array ('ttUpdaterLoggableBehaviour', 'getUpdatedByPersoon'),
));

