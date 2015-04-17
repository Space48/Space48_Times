<?php

$installer = $this;
$installer->startSetup();

$defaultData = "
ALTER TABLE
    {$this->getTable('space48_times')}
ADD
    `show_secondary` tinyint(1) NOT NULL
AFTER `show_closed_number`";

$installer->run($defaultData);

$installer->endSetup();
