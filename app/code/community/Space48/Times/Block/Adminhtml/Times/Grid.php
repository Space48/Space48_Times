<?php
/**
 * Space 48 Opening Times Grid
 *
 * Prepares the collection and generates the columns for use within the Adminhtml section for the Opening Times
 * Module
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
 * Space 48 Opening Times Grid
 *
 * Prepares the collection and generates the columns for use within the Adminhtml section for the Opening Times
 * Module
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Block_Adminhtml_Times_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Default application construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('timesGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare the Magento collection for the Opening times model
     *
     * @return Object Instances of the space48_times table.
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('times/times')
            ->getCollection()
            ->addFilter('times_type', 'default');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare the columns that should be displayed in the Magento adminhtml
     * section for the Space 48 Opening Times module.
     *
     * @return $this|void
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'default_day', array(
                'header'  => 'Day',
                'align'   => 'left',
                'width'   => '50px',
                'index'   => 'default_day'
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
     * Get the selected rows full URL used when selecting a row to enter edit mode.
     *
     * @param Object $row Instances of the data row selected
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}