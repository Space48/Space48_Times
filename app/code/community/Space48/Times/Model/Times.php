<?php
/**
 * Space 48  Model
 *
 * Space 48 Times Model, This model can be used to load the resource from the database.
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
 * Space 48 Times Model
 *
 * Space 48 Times Model, This model can be used to load the resource from the database.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Model_Times extends Mage_Core_Model_Abstract
{
    /**
     * Initialise instance of the model
     *
     * @return null
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('times/times');
    }
}