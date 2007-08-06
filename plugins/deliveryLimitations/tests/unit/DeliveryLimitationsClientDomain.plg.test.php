<?php

/*
+---------------------------------------------------------------------------+
| Openads v2.3                                                              |
| ============                                                              |
|                                                                           |
| Copyright (c) 2003-2007 Openads Limited                                   |
| For contact details, see: http://www.openads.org/                         |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id$
*/

require_once MAX_PATH . '/lib/max/Plugin.php';
require_once MAX_PATH . '/plugins/deliveryLimitations/Client/Domain.delivery.php';

/**
 * A class for testing the Plugins_DeliveryLimitations_Client_Domain class.
 *
 * @package    MaxPlugin
 * @subpackage TestSuite
 * @author     Andrew Hill <andrew@m3.net>
 */
class Plugins_TestOfPlugins_DeliveryLimitations_Client_Domain extends UnitTestCase
{

    /**
     * The constructor method.
     */
    function Plugins_TestOfPlugins_DeliveryLimitations_Client_Domain()
    {
        $this->UnitTestCase();
    }

    /**
     * A method to test the _getSqlLimitation() method.
     */
    function test_getSqlLimitation()
    {
        $current_quotes_runtime = get_magic_quotes_runtime();

        $oPlugin = &MAX_Plugin::factory('deliveryLimitations', 'Client', 'Domain');

        $result = $oPlugin->_getSqlLimitation('==', '*');
        $this->assertTrue($result);
        $result = $oPlugin->_getSqlLimitation('==', 'WWW.fornax.net');
        $this->assertEqual($result, "LOWER(RIGHT(host_name, 14)) = ('www.fornax.net')");
        $result = $oPlugin->_getSqlLimitation('!=', 'WWW.fornax.net');
        $this->assertEqual($result, "LOWER(RIGHT(host_name, 14)) != ('www.fornax.net')");
        $result = $oPlugin->_getSqlLimitation('=~', 'fornax.net');
        $this->assertEqual($result, "LOWER(host_name) LIKE ('%fornax.net%')");

        // Test that slashes are added correctly
        set_magic_quotes_runtime(1);
        $result = $oPlugin->_getSqlLimitation('==', 'WWW.for"nax.net');
        $this->assertEqual($result, "LOWER(RIGHT(host_name, 15)) = ('www.for\"nax.net')");
        set_magic_quotes_runtime(0);
        $result = $oPlugin->_getSqlLimitation('==', 'WWW.for"nax.net');
        $this->assertEqual($result, "LOWER(RIGHT(host_name, 15)) = ('www.for\\\"nax.net')");

        set_magic_quotes_runtime($current_quotes_runtime);
    }


    /**
     * Tests the delivery part of this plugin.
     *
     * The test works only if the testing machine has a proper setup!
     */
    function test_checkClientDomain()
    {
        $_SERVER['REMOTE_HOST'] = 'localhost.localdomain';
        $this->assertTrue(MAX_checkClient_Domain('localdomain', '==', array('ip' => '127.0.0.1')));
        $_SERVER['REMOTE_HOST'] = 'web.unanimis.co.uk';
        $this->assertTrue(MAX_checkClient_Domain('unanimis.co.uk', '==', array('ip' => '10.0.0.8')));
        $this->assertFalse(MAX_checkClient_Domain('unanimis.co.uk', '!=', array('ip' => '10.0.0.8')));
        $this->assertTrue(MAX_checkClient_Domain('.*unani.*', '=x', array('ip' => '10.0.0.8')));
    }
}

?>
