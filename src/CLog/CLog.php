<?php
namespace thulin82\CLog;
/**
 * Class to log what happens.
 *
 */
class CLog
{
    /**
     * Properties
     *
     */
    private $timestamp = array();
    private $pos       = 0;


    /**
     * Constructor
     *
     */
    public function __construct() {
        
    }


    /**
     * timestamp, log a event with a time.
     *
     * @param string      $domain is the module or class.
     * @param string      $where a more specific place in the domain.
     * @param string|null $comment on the timestamp.
     *
     */
    public function timestamp($domain, $where, $comment = null) {
        $now = microtime(true);

        $this->timestamp[] = array(
            'pos'     => $this->pos,
            'domain'  => $domain,
            'where'   => $where,
            'comment' => $comment,
            'when'    => $now,
            'memory'  => memory_get_usage(true),
        );

        if ($this->pos > 0) {
            $this->timestamp[$this->pos - 1]['memory-peak'] = memory_get_peak_usage(true);
            $this->timestamp[$this->pos - 1]['duration']    = $now - $this->timestamp[$this->pos - 1]['when'];
        }

        $this->pos++;
    }


    /**
     * Get the number of timestamps made.
     *
     * @return Number of timestamps.
     *
     */
    public function numberOfTimestamps() {
        return count($this->timestamp);
    }


    /**
     * Get the timestamps made.
     *
     * @return array of timestamps.
     *
     */
    public function returnTimestamps() {
        return $this->timestamp;
    }


    /**
     * Page load time as html.
     *
     * @return string with the page load time.
     *
     */
    public function pageLoadTime() {
        $first    = $this->timestamp[0]['when'];
        $last     = $this->timestamp[count($this->timestamp) - 1]['when'];
        $loadtime = round($last - $first, 3);
        $html     = "<p>Page was loaded in {$loadtime} secs.</p>";
        return $html;
    }


    /**
     * Memory peak as html.
     *
     * @param string $size is given in B/KB/MB
     *
     * @return string with the memory peak.
     *
     */
    public function memoryPeak($size) {
        if ((strcmp($size, 'B') && strcmp($size, 'KB') && strcmp($size, 'MB')) == !0 ) {
            $html = '<p>Error in MemoryPeak().</p>';
        } else {
            if ($size == 'B') {
                $peek = round(memory_get_peak_usage(true), 2);
            } else if ($size == 'KB') {
                $peek = round(memory_get_peak_usage(true) / 1024, 2);
            } else {
                $peek = round(memory_get_peak_usage(true) / 1024 / 1024, 2);
            }
            $html = "<p>Peek memory consumption was {$peek} {$size}.</p>";
        }
        return $html;
    }


    /**
     * Timestamps as a HTML table.
     *
     * @param bool $css if to use css or not
     *
     * @return string with a html-table to display all timestamps.
     *
     */
    public function asHTMLTable($css = false) {
        $first = $this->timestamp[0]['when'];
        $last  = $this->timestamp[count($this->timestamp) - 1]['when'];
        $right = ' style="text-align: right;"';
        $html = '';
        if ($css === true) { $html = '<html><head><link rel="stylesheet" type="text/css" href="css/table.css"></head><body>'; } 

        $html .= "<table class=table><caption>Timestamps</caption><tr><th>Position</th><th>Domain</th><th>Where</th>
        <th>When (s)</th><th>Duration (s)</th><th>Percent</th><th>Memory (MB)</th><th>Memory peak (MB)</th>
        <th>Comment</th></tr>";

        foreach ($this->timestamp as $val) {
            $pos      = $val['pos'];
            $domain   = $val['domain'];
            $where    = $val['where'];
            $when     = $val['when'] - $first;
            $duration = isset($val['duration']) ? round($val['duration'], 3) : '-';
            $percent  = round(($when) / ($last - $first) * 100);
            $memory   = round($val['memory'] / 1024 / 1024, 2);
            $peak     = isset($val['memory-peak']) ? round($val['memory-peak'] / 1024 / 1024, 2) : '-';
            $comment  = $val['comment'];
            $when     = round($when, 3);
            $html    .= "<tr><td>$pos</td><td>$domain</td><td>$where</td><td$right>$when</td><td$right>$duration</td>
            <td$right>$percent</td><td$right>$memory</td><td$right>$peak</td><td>$comment</td></tr>";
        }
        $html .= '</table>';
        return $html;
    }


    /**
     * Print your timestamps to a file
     *
     * @param string $filename the name of the file to write to
     * @param bool   $append if to overwrite log or append
     *
     */
    public function printToFile($filename = 'clog.log', $append = false) {
        $res = print_r($this->returnTimestamps(), true);
        
        if ($append === true) {
            file_put_contents($filename, $res, FILE_APPEND);
        } else {
            file_put_contents($filename, $res);
        }
    }

}