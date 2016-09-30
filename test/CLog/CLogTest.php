<?php
namespace thulin82\CLog;
/**
 * Class to test CLog
 *
 */
class CLogTest extends \PHPUnit_Framework_TestCase {

    /**
     * Basic Test (not testing CLog)
     *
     * @return void
     *
     */
    public function testBasicTest() {

        $res = "test";
        $exp = "test";
        $this->assertEquals($res, $exp, "Created strings missmatch"); 
    }

    /**
     * Testing numberOfTimestamps()
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

    /**
     * Testing returnTimestamps()
     *
     * @return void
     *
     */
    public function testReturnTimestamps() {
        $el = new \thulin82\CLog\CLog();

        $el->timestamp("test", "test", "test");
        $res = $el->returnTimestamps();
        $exp = 1;
        $this->assertCount($exp, $res);
    }

}
