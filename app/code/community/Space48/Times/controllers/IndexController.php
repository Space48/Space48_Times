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
class Space48_Times_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Frontend Index Action for rendering opening times.
     *
     * @return mixed
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /** Display LiveChat button or not */
    public function showLivechatAction()
    {

        if (!$this->getRequest()->isAjax()) {
            return false;
        }

        /**
         * Only display LiveChat during business UK hours.
         * Needs to be done in JS to avoid caching.
         */
        $timestamp = Mage::getSingleton('core/locale')->storeTimeStamp(0); // use UK store timestamp
        $day = date('D', $timestamp);
        $showLivechat = false;

        // Standard Hours
        if (in_array($day, array('Sat', 'Sun'))) { // Weekend

            $timeStart = strtotime(date('Y-m-d 08:00:00', $timestamp));
            $timeEnd   = strtotime(date('Y-m-d 17:30:00', $timestamp));
            if ($timestamp > $timeStart && $timestamp < $timeEnd ) {
                $showLivechat = true;
            }

        } else { // Business days

            $timeStart = strtotime(date('Y-m-d 08:00:00', $timestamp));
            $timeEnd   = strtotime(date('Y-m-d 21:30:00', $timestamp));
            if ($timestamp > $timeStart && $timestamp < $timeEnd ) {
                $showLivechat = true;
            }

        }


        /**
        Special Hours:
        Christmas Day: Closed all day
        Boxing Day: 10am – 6pm
        New Years Eve: 8am-6pm
        New Years Day: Closed
        Easter Day: Closed
         */
        /*
        if(date('Y-m-d', $timestamp) == '2013-12-25' || date('Y-m-d', $timestamp) == '2014-01-01') {
            $showLivechat = false;
        }

        if(date('Y-m-d', $timestamp) == '2013-12-26') {
            $showLivechat = false;
            if($timestamp > strtotime('2013-12-26 10:00:00') && $timestamp < strtotime('2013-12-26 18:00:00')) {
                $showLivechat = true;
            }
        }

        if(date('Y-m-d', $timestamp) == '2013-12-31') {
            $showLivechat = false;
            if($timestamp > strtotime('2013-12-31 08:00:00') && $timestamp < strtotime('2013-12-31 18:00:00')) {
                $showLivechat = true;
            }
        }
        */

        if (date('Y-m-d', $timestamp) == '2015-04-05') {
            $showLivechat = false;
        }

        $response = $showLivechat ? '1' : '0';

        // send response
        $this->getResponse()->setBody($response);

    }
}