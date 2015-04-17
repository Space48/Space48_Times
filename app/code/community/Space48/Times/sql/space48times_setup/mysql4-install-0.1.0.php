<?php
/**
 * Space 48 Installer
 *
 * Space 48 Installer script. This script runs on first load of the module and creates all required tables.
 *
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space 48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   SVN: $Id$
 * @link      http://wiki.space48.com
 */

/**
 * Space 48 installer
 *
 * Space 48 Installer script. This script runs on first load of the module and creates all required tables.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
$installer = $this;
$installer->startSetup();

$dropSql = "DROP TABLE IF EXISTS {$this->getTable('space48_times')};";

$createTableSql =  "CREATE TABLE {$this->getTable('space48_times')} (
          `times_id` int(11) NOT NULL AUTO_INCREMENT,
          `date` varchar(255) DEFAULT NULL,
          `open_time` varchar(255) NOT NULL,
          `close_time` varchar(255) NOT NULL,
          `open_message` varchar(255) NOT NULL,
          `show_open_number` tinyint(1) NOT NULL,
          `show_closed_number` tinyint(1) NOT NULL,
          `times_type` varchar(255) DEFAULT NULL,
          `close_message` varchar(255) DEFAULT NULL,
          `default_day` varchar(255) DEFAULT NULL,
          PRIMARY KEY (`times_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";


$defaultDataMon = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Monday')";

$defaultDataTue = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Tuesday')";

$defaultDataWed = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Wednesday')";

$defaultDataThur = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Thursday')";

$defaultDataFri = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Friday')";

$defaultDataSat = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Saturday')";

$defaultDataSun = "INSERT INTO
                    {$this->getTable('space48_times')} (
                        open_time, close_time, open_message, close_message, times_type, default_day)
                    VALUES ('9','21','were open','were closed','default','Sunday')";

$installer->run($dropSql);
$installer->run($createTableSql);
$installer->run($defaultDataMon);
$installer->run($defaultDataTue);
$installer->run($defaultDataWed);
$installer->run($defaultDataThur);
$installer->run($defaultDataFri);
$installer->run($defaultDataSat);
$installer->run($defaultDataSun);

$installer->endSetup();

