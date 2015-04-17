<?php

$installer = $this;
$installer->startSetup();

$defaultData = "UPDATE {$this->getTable('space48_times')} SET `open_time` = '08:00:00', `close_time` = '22:00:00' WHERE `times_type` = 'default'";

$installer->run($defaultData);

$installer->endSetup();

