Space48_Times
=====================

Description
-----------


Most Recent Location
--------------------
BetterBathrooms

Other Locations
---------------
Bodybuildingwarehouse , taps

Requirements
------------
- PHP >= 5.2.0
- Mage_Core


Compatibility
-------------
Magento >= 1.4

Tested
-------------
Enterprise 1.13.1.0

Installation Instructions
-------------------------
To install this module add the files to appropriate directories. 
To activate the module log into the admin and go to System > Configuration > Advanced > Disable Modules Output > Select Enable on Space48_Times

The following line must also be added to the header.phtml file (frontend/enterprise/*default or other theme name*/template/page/html/header.phtml)

`<?php echo $this->getChildHtml('space48.times'); ?>`


Uninstallation
--------------



Copyright
---------
(c) 2015 Space48
