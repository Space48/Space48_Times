<?php
/**
 * Space 48 Custom Block Edit Form Class
 *
 * Space 48 Custom Block Edit Form Class, Magento form class for the Opening Times module.
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
 * Space 48 Custom Block Edit Form Class
 *
 * Space 48 Custom Block Edit Form Class, Magento form class for the Opening Times module.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Block_Adminhtml_Custom_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('times_custom_edit');
        $this->setTitle($this->__('Manage Custom Opening Times'));
    }

    /**
     * Setup form fields for inserts / updates
     *
     * @return Mage_Adminhtml_Block_Widget_Form|void
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('times_data');

        $form = new Varien_Data_Form(
            array(
                'id'     => 'edit_form',
                'action' => $this->getUrl('*/*/save', array($this->getRequest()->getParam('id'))),
                'method' => 'post'
            )
        );

        $fieldset = $form->addFieldset(
            'base_fieldset', array(
                    'legend'  => Mage::helper('checkout')->__('Manage times and message'),
                    'class'   => 'fieldset-wide'
                )
        );

        if ($model->getId()) {
            $fieldset->addField(
                'times_id', 'hidden', array(
                    'name'  => 'times_id',
                )
            );
        }

        $fieldset->addField(
            'date', 'date', array(
                'label'     => Mage::helper('checkout')->__('Date'),
                'name'      => 'date',
                'after_element_html' => '<small>Date that this message should be displayed</small>',
                'tabindex' => 1,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            )
        );

        $fieldset->addField(
            'open_message', 'textarea', array(
                'name'     => 'open_message',
                'label'    => Mage::helper('checkout')->__('Open Message'),
                'title'    => Mage::helper('checkout')->__('Open Message'),
                'required' => true,
            )
        );

        $fieldset->addField(
            'close_message', 'textarea', array(
                'name'     => 'close_message',
                'label'    => Mage::helper('checkout')->__('Closed Message'),
                'title'    => Mage::helper('checkout')->__('Closed Message'),
                'required' => true,
            )
        );

        $fieldset->addField(
            'open_time', 'time', array(
                'name'     => 'open_time',
                'label'    => Mage::helper('checkout')->__('Open Time (24h format)'),
                'title'    => Mage::helper('checkout')->__('Open Time (24h format)'),
                'required' => true,
            )
        );

        $fieldset->addField(
            'show_open_number', 'checkbox', array(
                'label'     => Mage::helper('checkout')->__('Show open number'),
                'name'      => 'show_open_number',
                'onclick' => "",
                'onchange' => "",
                'value'  => '1',
                'disabled' => false,
                'after_element_html' => '<small>Show the telephone number when store is open</small>',
                'tabindex' => 1
            )
        );

        $fieldset->addField(
            'close_time', 'time', array(
                'name'     => 'close_time',
                'label'    => Mage::helper('checkout')->__('Close Time (24h format)'),
                'title'    => Mage::helper('checkout')->__('Close Time (24h format)'),
                'required' => true,
            )
        );

        $fieldset->addField(
            'show_closed_number', 'checkbox', array(
                'label'     => Mage::helper('checkout')->__('Show closed number'),
                'name'      => 'show_closed_number',
                'onclick' => "",
                'onchange' => "",
                'value'  => '1',
                'disabled' => false,
                'after_element_html' => '<small>Show the telephone number when store is closed</small>',
                'tabindex' => 1
            )
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}