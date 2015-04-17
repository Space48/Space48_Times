<?php
/**
 * Space 48 Times Controller
 *
 * Space 48 Times Controller, Extends Adminhtml controller action so that all operations
 *          performed inside the default section of this module can be captured.
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
 * Space 48 Times Controller
 *
 * Space 48 Times Controller, Extends Adminhtml controller action so that all operations
 *          performed inside the section of this module can be captured.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Helper function to reduce duplicate calls to load layout
     *
     * @param bool $loadJs Allow loading of EXT JS
     * @param bool $block  Allow including extra blocks for execution
     *
     * @return object reference instance of layout
     */
    protected function _loadLayout($loadJs = false, $block = false)
    {
        $this->loadLayout();
        if ($loadJs) {
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        }

        if ($block) {
            $this->_addContent(
                $this->getLayout()
                    ->createBlock('space48_times/adminhtml_times_'  . $block)
            );
        }

        $this->renderLayout();
    }

    /**
     * Index Action
     *
     * @return mixed
     */
    public function indexAction()
    {
        $this->_loadLayout();
    }

    /**
     * Edit action
     *
     * @return mixed
     */
    public function editAction()
    {
        $id    = $this->getRequest()->getParam('id');
        $model = Mage::getModel('times/times');

        if ($id) {
            $model->load((int)$id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('times')->__('Error loading model'));
                $this->_redirect('*/*/');
            }
        }

        // Prepare times arrays
        $model->setData('open_time', str_replace(':', ',', $model->getData('open_time')));
        $model->setData('close_time', str_replace(':', ',', $model->getData('close_time')));

        Mage::register('times_data', $model);

        $this->_loadLayout(true, 'edit');
    }

    /**
     * Save Action
     *
     * @return null
     */
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();

        if ($data) {
            $model = Mage::getModel('times/times');
            $id    = $this->getRequest()->getParam('times_id');

            if ($id) {
                $model->load($id);
            }

            // Prepare times arrays
            if(is_array($data['open_time'])) {
                $data['open_time'] = implode(':', $data['open_time']);
            }
            if(is_array($data['close_time'])) {
                $data['close_time'] = implode(':', $data['close_time']);
            }

            // Set values for unchecked check-boxes in order to save their values in DB
            $checkboxes = array(
                'show_open_number',
                'show_closed_number',
                'show_secondary',
            );

            foreach($checkboxes as $checkbox) {
                $data[$checkbox] = isset($data[$checkbox]) ? $data[$checkbox] : 0;
            }

            $model->setData($data);

            Mage::getSingleton('adminhtml/session')->setFormData($data);

            try {
                if ($id) {
                    $model->setTimesId($id);
                }
                $model->save();

                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('times')->__('Error saving the time'));
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('checkout')->__('Times saved OK'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                $this->_redirect('*/*/');

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return;


    }

    /**
     * Custom dates action
     *
     * @return null
     */
    public function testAction()
    {
        $this->_loadLayout();
    }
}