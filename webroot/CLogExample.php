<?php
/**
 * Example file for CLog.
 *
 * @package CLog
 * @author  Markus Thulin <macky_b@hotmail.com>
 * @license https://choosealicense.com/licenses/mit/ MIT
 */

// Include CLog Class.
require '../src/CLog/CLog.php';

// Create new CLog object.
$log = new \thulin82\CLog\CLog();

/*
 * START LOGGING PART
 */

// Log start of file.
$log->timestamp('CLogExample', 'Start');

// Log before sleep().
$log->timestamp('CLogExample', 'sleep()', 'Before sleeping');

// Sleep....
sleep(2);

// Log after sleep().
$log->timestamp('CLogExample', 'sleep()', 'After sleeping');

// Log end of file.
$log->timestamp('CLogExample', 'End');

/*
 * END LOGGING PART
 */

// Print asHTMLTable().
echo $log->asHTMLTable(true);

// Print how many timepstamps made (4).
echo $log->numberOfTimestamps();

// Print all content as an array.
print_r($log->returnTimestamps());

// Print pageLoadTime().
echo $log->pageLoadTime();

// Print memoryPeak().
echo $log->memoryPeak('KB');

$log->printToFile('clog.log', true);
