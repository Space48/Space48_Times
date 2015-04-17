<?php
/**
 * Space 48 Opening Times Form
 *
 * Creates the form used in the Adminthtml system for the Opening Times module
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
 * Space 48 Opening Times Form
 *
 * Creates the form used in the Adminthtml system for the Opening Times module
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Block_Adminhtml_Times_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('times_edit');
        $this->setTitle($this->__('Manage Opening Times'));
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
                'checked'   => $model->getData('show_open_number') == 1 ? true : false,
                'onclick'   => "this.value = this.checked ? 1 : 0;",
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
                'checked'   => $model->getData('show_closed_number') == 1 ? true : false,
                'onclick'   => "this.value = this.checked ? 1 : 0;",
                'value'  => '1',
                'disabled' => false,
                'after_element_html' => '<small>Show the telephone number when store is closed</small>',
                'tabindex' => 1
            )
        );

        $fieldset->addField(
            'show_secondary', 'checkbox', array(
                'label'     => Mage::helper('checkout')->__('Show phone icon'),
                'name'      => 'show_secondary',
                'checked'   => $model->getData('show_secondary') == 1 ? true : false,
                'onclick'   => "this.value = this.checked ? 1 : 0;",
                'value'     => '0',
                'disabled'  => false,
                'after_element_html' => '<small>Show secondary phone icon in bottom right corner when store is closed</small>',
                'tabindex' => 1
            )
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}