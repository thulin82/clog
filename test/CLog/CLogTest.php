<?php
namespace thulin82\CLog;
/**
 * Class to test CLog
 *
 */
class CLogTest extends \PHPUnit_Framework_TestCase {

    /**
     * Test 
     *
     * @return void
     *
     */
    public function testBasicTest() {
        $el = new \thulin82\CLog\CLog();
        
        $res = "test";
        $exp = "test";
        $this->assertEquals($res, $exp, "Created strings missmatch"); 
    }
    
    /**
     * Test2
     *
     * @return void
     *
     */
    public function testNumberOfTimestamps() {
        $el = new \thulin82\CLog\CLog();
        
        $el->timestamp("test", "test", "test");
        $res = $el->numberOfTimestamps();
        $exp = 1;
        $this->assertEquals($res, $exp, "Missmatch in number of timestamps"); 
    }

}