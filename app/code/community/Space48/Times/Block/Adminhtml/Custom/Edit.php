<?php
/**
 * Space 48 Custom Edit Block Class
 *
 * Space 48 Custom Edit Block Class, Enables the form view for the opening times module within Magento
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
 * @version   GIT: $Id$
 * @link      http://wiki.space48.com
 */

/**
 * Space 48 Custom Edit Block Class
 *
 * Space 48 Custom Edit Block Class, Enables the form view for the opening times module within Magento
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Block_Adminhtml_Custom_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        $this->_blockGroup = 'space48_times';
        $this->_controller = 'adminhtml_custom';

        parent::__construct();

        $this->updateButton('save', 'label', $this->__('Save Time'));
        $this->updateButton('delete', 'label', $this->__('Delete Time'));
    }

    /**
     * Get header text
     *
     * @return string Header text for the Magento admin based on if data is in the registry.
     */
    public function getHeaderText()
    {
        if (Mage::registry('times_data')->getId()) {
            return $this->__('Edit Custom time');
        } else {
            return $this->__('New Custom Time');
        }
    }

}