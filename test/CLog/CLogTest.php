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

        $el->timestamp("test2", "test2", "test2");
        $res = $el->numberOfTimestamps();
        $exp = 2;
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
    
    /**
     * Testing pageLoadTime
     *
     * @return void
     *
     */
    public function testPageLoadTime() {
    $el = new \thulin82\CLog\CLog();
    
    $el->timestamp("test", "test", "test");    
    $res = $el->pageLoadTime();        
    $exp_pattern = "/<p>Page was loaded in \d* secs.<\/p>/";    
    $this->assertRegExp($exp_pattern, $res, 'Regexp missmatch');    
    }
    
    /**
     * Testing memoryPeak($size)
     *
     * @return void
     *
     */
    public function testMemoryPeak() {
        $el = new \thulin82\CLog\CLog();

        $el->timestamp("test", "test", "test");
        $res = $el->memoryPeak("B");
        $exp_pattern1 = "/<p>Peek memory consumption was \d* B.<\/p>/";
        $this->assertRegExp($exp_pattern1, $res, 'Regexp missmatch');
        
        $res = $el->memoryPeak("KB");
        $exp_pattern2 = "/<p>Peek memory consumption was \d* KB.<\/p>/";
        $this->assertRegExp($exp_pattern2, $res, 'Regexp missmatch');
        
        $res = $el->memoryPeak("MB");
        $exp_pattern3 = "/<p>Peek memory consumption was \d*|\d*\.\d* MB.<\/p>/";
        $this->assertRegExp($exp_pattern3, $res, 'Regexp missmatch');
        
        $res = $el->memoryPeak("FL");
        $exp = "<p>Error in MemoryPeak().</p>";
        $this->assertEquals($exp, $res, 'Missmatch in error message');
    }

    /**
     * Testing asHTMLTable($css = false)
     *
     * @return void
     *
     */
    public function testAsHTMLTable() {
        $el = new \thulin82\CLog\CLog();

        $el->timestamp("test", "test", "test");
        $el->timestamp("test2", "test2", "test2");
        $res = $el->asHTMLTable();
        $this->assertInternalType('string', $res);
    }

    /**
     * Testing printToFile($filename = "clog.log", $append = false)
     *
     * @return void
     *
     */
    public function testPrintToFile() {
    $el = new \thulin82\CLog\CLog();

    $el->timestamp("test", "test", "test");
    $name = "clog.log";
    $el->printToFile($name);
    $this->assertFileExists($name, 'File does not exist');

    $el->printToFile($name, true);
    $this->assertFileExists($name, 'File does not exist');
    }
    
}
