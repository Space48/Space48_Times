<?php
/**
 * Space 48 Times Block Class
 *
 * Space 48 Times Block Class, Provides helper function for the template so that data can be obtained from the
 *          collection.
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
 * Space 48 Times Block Class
 *
 * Space 48 Times Block Class, Provides helper function for the template so that data can be obtained from the
 *          collection.
 *
 * @category  Space48
 * @package   Space48_Times
 * @author    James Cowie <james@space48.com>
 * @copyright 2010-2013 Space48
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://wiki.space48.com
 */
class Space48_Times_Block_Times extends Mage_Core_Block_Template
{
    protected $_timestamp;

    /**
     * Sets default time zone to be UK as its not always set in the PHP.INI file
     *
     * @see http://www.php.net/manual/en/datetime.configuration.php#ini.date.timezone
     */
    public function _construct()
    {
        /**
         * Don't do this (think BST). This is wrong!
         * It will alter all the timestamps from this point on.
         */
        //date_default_timezone_set('Europe/London');    	
        $this->_timestamp = Mage::getSingleton('core/locale')->storeTimeStamp();
    }

    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    /**
     * Get opening time from the database.
     *
     * @return string Open / Closed message for the current day
     */
    public function getMessage()
    {
        $message = $this->_getMessageData();
        if (date('H:i:s', $this->getTimestamp()) >= $message[0]['open_time'] && date('H:i:s', $this->getTimestamp()) <= $message[0]['close_time']) {
            return $message[0]['open_message'];
        } else {
            return $message[0]['close_message'];
        }
    }

    /**
     * Get store times from the database.
     *
     * @return string Open / Close time for the current day.
     */
    public function getStoreTimes()
    {
        $message = $this->_getMessageData();
        $currentTimezone = Mage::getStoreConfig(Mage_Core_Model_Locale::XML_PATH_DEFAULT_TIMEZONE);

        /**
         * We are using the date set in the admin (which is in UK time zone)
         * and convert it to current store's locale/timezone
         */

        // get UK Date object
        $dateOpen = new DateTime('now', new DateTimeZone('Europe/London'));
        $dateClosed = new DateTime('now', new DateTimeZone('Europe/London'));

        list($hour, $minute) = explode(':', $message[0]['open_time']);
        $dateOpen->setTime($hour, $minute);

        list($hour, $minute) = explode(':', $message[0]['close_time']);
        $dateClosed->setTime($hour, $minute);

        // Change the locale/timezone to current store (e.g. DE)
        $dateOpen->setTimezone(new DateTimeZone($currentTimezone));
        $dateClosed->setTimezone(new DateTimeZone($currentTimezone));

        return str_replace(':00', '', date('g:ia', strtotime($dateOpen->format('H:i:s'))) . ' - ' . date('g:ia', strtotime($dateClosed->format('H:i:s'))));
    }

    /**
     * Get the stores close time from the database
     *
     * @return string Closing time of the store.
     */
    public function getStoreCloseTime()
    {
        $message = $this->_getMessageData();

        return str_replace(':00', '', date('g:ia', strtotime($message[0]['close_time'])));
    }

    /**
     * Get Magento store contact telephone number from core config
     *
     * @return bool|mixed If the telephone number should be displayed on the front end during closed hours.
     */
    public function getStoreTelephone()
    {
        $storePhone = Mage::getStoreConfig('general/store_information/phone');

        if ($storePhone) {
            return $storePhone;
        } else {
            return false;
        }
    }


    // Get opening and closing times for all week
    public function getAllOpeningTimes()
    {
        $times = array();
        $weekdays = array(
            'Sunday'    => '0',
            'Monday'    => '1',
            'Tuesday'   => '2',
            'Wednesday' => '3',
            'Thursday'  => '4',
            'Friday'    => '5',
            'Saturday'  => '6'
        );

        $all_times = $this->_getModelData('times_type', 'default');

        foreach($all_times as $time) {
            if(isset($weekdays[$time['default_day']])) {
                $times[$weekdays[$time['default_day']]] = array(
                    'default_day'   => $weekdays[$time['default_day']],
                    'open_time'     => explode(':', $time['open_time']),
                    'close_time'    => explode(':', $time['close_time']),
                    'show'          => $time['show_secondary'],
                );
            }
        }

        return $times;
    }

    // Get opening and closing times for custom days
    public function getAllCustomOpeningTimes()
    {
        $times = array();

        // Get opening times for the next 3 days
        // (in order to have enough time for the cache to refresh)
        $today              = date('Y-m-d', $this->getTimestamp());
        $tomorrow           = date('Y-m-d', strtotime('+1 day' . $today));
        $dayAfterTomorow    = date('Y-m-d', strtotime('+2 day' . $today));

        $all_times = $this->_getModelData('times_type', 'custom');

        foreach($all_times as $time) {
            if($time['date'] == $this->_formatDateForDB($today)) {
                $times[$today] = array(
                    'open_time'     => strtotime($today . ' ' . $time['open_time']),
                    'close_time'    => strtotime($today . ' ' . $time['close_time']),
                    'show'          => $time['show_secondary'],
                );
            }

            if($time['date'] == $this->_formatDateForDB($tomorrow)) {
                $times[$tomorrow] = array(
                    'open_time'     => strtotime($tomorrow . ' ' . $time['open_time']),
                    'close_time'    => strtotime($tomorrow . ' ' . $time['close_time']),
                    'show'          => $time['show_secondary'],
                );
            }

            if($time['date'] == $this->_formatDateForDB($dayAfterTomorow)) {
                $times[$dayAfterTomorow] = array(
                    'open_time'     => strtotime($dayAfterTomorow . ' ' . $time['open_time']),
                    'close_time'    => strtotime($dayAfterTomorow . ' ' . $time['close_time']),
                    'show'          => $time['show_secondary'],
                );
            }
        }

        return $times;
    }


    /**
     * Get message data from the Model and return valid data string
     *
     * @return object mixed Object of model
     */
    protected function _getMessageData()
    {
        $today = date('l', $this->getTimestamp());
        $date  = date('d/m/Y', $this->getTimestamp());
        $message = $this->_getModelData('date', $date);

        if ($message) {
            return $message;
        } else {
            return $this->_getModelData('default_day', $today);
        }
    }

    /**
     * Get the model data.
     *
     * @param string $column database column name
     * @param string $filter SQL filter that should be applied to the collection
     *
     * @return object Magento data model based on filtered values.
     */
    protected function _getModelData($column, $filter)
    {
        $data = Mage::getModel('times/times')
            ->getCollection()
            ->addFilter($column, $filter)
            ->getData();

        return $data;
    }

    /**
     * Converts the date string to be valid with the database stored value (table 'space48_times')
     *
     * @param string $date
     *
     * @return string
     */
    protected function _formatDateForDB($date)
    {
        return date('d/m/Y', strtotime($date));
    }
    
    /**
     * Returns whether store is open right now
     *
     * @return bool
     */
    public function getIsOpen()
    {

        $message = $this->_getMessageData();

        if (date('H:i:s', $this->getTimestamp()) >= $message[0]['open_time'] && date('H:i:s', $this->getTimestamp()) <= $message[0]['close_time']) {
            return true;
        }

        return false;
    }
    
}