<?php
/**
 * Space 48 Custom Block Grid Form Class
 *
 * Space 48 Custom Block Grid Form Class, Magento Grid class for the Opening Times module.
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
 * Space 48 Custom Block Grid Form Class
 *
 * Space 48 Custom Block Grid Form Class, Magento Grid class for the Opening Times module.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Block_Adminhtml_Custom_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Default application construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('timesCustomGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare magento data collection from ORM
     *
     * @return Mage_Adminhtml_Block_Widget_Grid|void
     *
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('times/times')
            ->getCollection()
            ->addFilter('times_type', 'custom');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns for display in Magento grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid|void
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'date', array(
                'header'  => 'Date',
                'align'   => 'left',
                'width'   => '200px',
                'index'   => 'date'
            )
        );

        $this->addColumn(
            'open_message', array(
                'header'  => 'Open Message',
                'align'   => 'left',
                'width'   => '100px;',
                'index'   => 'open_message'
            )
        );

        $this->addColumn(
            'close_message', array(
                'header'  => 'Closed Message',
                'align'   => 'right',
                'width'   => '100px',
                'index'   => 'close_message'
            )
        );

        $this->addColumn(
            'open_time', array(
                'header'  => 'Open Time',
                'align'   => 'right',
                'width'   => '100px',
                'index'   => 'open_time'
            )
        );

        $this->addColumn(
            'close_time', array(
                'header'  => 'Close Time',
                'align'   => 'right',
                'width'   => '100px',
                'index'   => 'close_time'
            )
        );
    }

    /**
     * Get edit row ID and form correct link
     *
     * @param int $row ID of selected row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/adminhtml_custom/edit', array('id' => $row->getId()));
    }
}