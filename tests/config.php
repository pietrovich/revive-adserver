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

/**
 * The configuration file for the test suite.
 *
 * @package    Max
 * @subpackage TestSuite
 * @author     Andrew Hill <andrew@m3.net>
 */

// Define the different environment configurations
define('NO_DB',          0);
define('DB_NO_TABLES',   2);
define('DB_WITH_TABLES', 3);
define('DB_WITH_DATA',   4);

// The directories where tests can be found, to help
// reduce filesystem parsing time
$GLOBALS['_MAX']['TEST']['directories'] =
    array(
        'etc/changes',
        'lib/max',
        'lib/OA',
        'lib/util',
        'plugins',
        'tests'
    );

// Project path - helpful for testing external projects
// which integrate with Openads code
define('MAX_PROJECT_PATH', MAX_PATH);

// Define the available root-level test groups
$GLOBALS['_MAX']['TEST']['groups'] = array(
    0 => 'unit',
    1 => 'integration',
    2 => 'visualisation'
);

/*
+---------------------------------------------------------------------------+
| UNIT TESTING CONFIGURATION ITEMS                                          |
+---------------------------------------------------------------------------+
*/

// The test type name
$type = $GLOBALS['_MAX']['TEST']['groups'][0];

// Define the directory that tests should be stored in
// (e.g. "tests", "tests/unit", etc.).
define($type . '_TEST_STORE', 'tests/unit');

// The different "layers" that can be tested, defined in terms of
// layer test codes (ie. the test files for the layer will be
// xxxxx.code.test.php), and the layer names and database
// requirements for the test(s) in that layer
$GLOBALS['_MAX']['TEST'][$type . '_layers'] =
    array(
        'cor'   => array('Core Classes',                        DB_NO_TABLES),
        'db'    => array('Database Abstraction Layer (DB)',     DB_NO_TABLES),
        'tbl'   => array('Table Creation Layer (DB)',           DB_NO_TABLES),
        'dal'   => array('Data Abstraction Layer (DB)',         DB_WITH_TABLES),
        'del'   => array('Delivery Engine',                     NO_DB),
        'dl'    => array('Delivery Limitations',                NO_DB),
        'ent'   => array('Entities',                            NO_DB),
        'fct'   => array('Forecast',                            NO_DB),
        'mtc'   => array('Maintenance Engine (DB)',             DB_WITH_TABLES),
        'mts'   => array('Maintenance Statistics Engine',       NO_DB),
        'mtsdb' => array('Maintenance Statistics Engine (DB)',  DB_NO_TABLES),
        'mtp'   => array('Maintenance Priority Engine',         NO_DB),
        'mtf'   => array('Maintenance Forecasting Engine',      NO_DB),
        'mtfdb' => array('Maintenance Forecasting Engine (DB)', DB_NO_TABLES),
        'plg'   => array('Plugins',                             DB_WITH_TABLES),
        'admin' => array('Administrative Interface',            NO_DB),
        //'dev'   => array('Developer Tools',                     DB_WITH_TABLES),
        'mol'   => array('Openads Other Libraries',             DB_WITH_TABLES),
        'up'    => array('Upgrade Classes',                     DB_WITH_TABLES),
        'mig'   => array('Upgrade Migration Classes',           DB_NO_TABLES),
        'util'   => array('Commonly used utilities',           NO_DB)
    );

/*
+---------------------------------------------------------------------------+
| INTEGRATION TESTING CONFIGURATION ITEMS                                   |
+---------------------------------------------------------------------------+
*/

// The test type name
$type = $GLOBALS['_MAX']['TEST']['groups'][1];

// Define the directory that tests should be stored in
// (e.g. "tests", "tests/unit", etc.).
define($type . '_TEST_STORE', 'tests/integration');

// The different "layers" that can be tested, defined in terms of
// layer test codes (ie. the test files for the layer will be
// xxxxx.code.test.php), and the layer names and database
// requirements for the test(s) in that layer
$GLOBALS['_MAX']['TEST'][$type . '_layers'] =
    array(
        'mts' => array('Maintenance Statistics Engine (DB)',   DB_NO_TABLES),
        'mtp' => array('Maintenance Priority Engine (DB)',     DB_WITH_DATA),
        'mtf' => array('Maintenance Forecasting Engine (DB)',  DB_WITH_TABLES),
        'del' => array('Delivery Engine (DB)',                 DB_WITH_DATA),
        'up'  => array('Upgrade Classes',                      DB_WITH_TABLES),
        //'dev' => array('Developer Tools',                      DB_WITH_TABLES),
    );

/*
+---------------------------------------------------------------------------+
| VISUALISATION TESTING CONFIGURATION ITEMS                                 |
+---------------------------------------------------------------------------+
*/

// The test type name
$type = $GLOBALS['_MAX']['TEST']['groups'][2];

// Define the directory that tests should be stored in
// (e.g. "tests", "tests/unit", etc.).
define($type . '_TEST_STORE', 'tests/visualisation');

// The different "layers" that can be tested, defined in terms of
// layer test codes (ie. the test files for the layer will be
// xxxxx.code.test.php), and the layer names and database
// requirements for the test(s) in that layer
$GLOBALS['_MAX']['TEST'][$type . '_layers'] =
    array(
        'mtp'   => array('Maintenance Priority Engine',      NO_DB),
        'mtpdb' => array('Maintenance Priority Engine (DB)', DB_WITH_TABLES)
    );

?>
