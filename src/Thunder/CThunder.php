<?php
namespace Anhu\Thunder;

/**
 * Simple debug tool för Anax framework
 * open README for more details
 */

class CThunder
{
   
    private $block="<h1><i class='fa fa-cloud'></i>  Thunder <small>the marker</small></h1>";
    
    function __construct()
    {
        // setup session
        if(!isset($_SESSION['marker'])) {
            $_SESSION['marker'] = array();
        }

    }                        
    /**
    * Sets a marker - saving info in session
    *
    * @param string $message - the message
    * @param string $checkValue - variable or constant of any type
    */
    public function setMarker($message, $checkValue=null)
    {
        
        $backtracer = debug_backtrace();
        $checkValue = isset($checkValue)?$checkValue:'null';
        $file = isset($backtracer[0]['file']) ? $backtracer[0]['file'] : 'n/a';
        $line = isset($backtracer[0]['line']) ? $backtracer[0]['line'] : 'n/a';
        $function = isset($backtracer[1]['function']) ? $backtracer[1]['function'] : 'n/a';
        $class = isset($backtracer[1]['class']) ? $backtracer[1]['class'] : 'n/a';
        $time = date("Y/m/d H:i:s"). substr((string)microtime(), 1, 8);
        $presentMicroTime=microtime();
        $timing = isset($_SESSION['thunder_timer'])? $this->microtime_diff($_SESSION['thunder_timer'], $presentMicroTime):0;
        $_SESSION['thunder_timer'] = $presentMicroTime;
        $_SESSION['marker'][] = [
            'message' => $message,
            'class' => $class,
            'function' => $function,
            'line'=> $line,
            'file'=>$file,
            'time'=>    $time,
            'timer'=>  $timing,
            'checkValue' => $checkValue,
        ];
    }

/**
* calculates time past between two microtime values
*   
*/

  function microtime_diff( $start, $end=NULL ) { 
        if( !$end ) { 
            $end= microtime(); 
        } 
        list($start_usec, $start_sec) = EXPLODE(" ", $start); 
        list($end_usec, $end_sec) = explode(" ", $end); 
        $diff_sec= intval($end_sec) - intval($start_sec); 
        $diff_usec= floatval($end_usec) - floatval($start_usec); 
        RETURN floatval( $diff_sec ) + $diff_usec; 
    }



    /**
    * Get messages
    * 
    * @return string messages in HTML
    */
    public function getMarkers() 
    {
        $messages = null;
        // if marker is set
        // fetching and store in new variables
        if(isset($_SESSION['marker'])) {
            foreach($_SESSION['marker'] as $marks => $mark) {
                
            
                $message   = $mark['message'];
                $class      = $mark['class'];
                $function   = $mark ['function'];
                $line       = $mark['line'];
                $file       = $mark['file'];
                $time       = $mark['time'];
                $timer       = $mark['timer'];
                $checkValue = $mark['checkValue'];


                $this->block .= "<div class='panel panel-primary'>";
                $this->block .= "<div class='panel-heading'>";
                $this->block .= "<h5>" . $class . " | " . $function . "</h5>";
                $this->block .= "</div>";
                $this->block .= '<div class="panel-body">';
                $this->block .= "<p>Test value: " . $checkValue ."</p>";
                $this->block .= "<div>" . $message ."</div>";
                $this->block .= "</div>";
                $this->block .= '<div class="panel-footer">';
                $this->block .= "<div style='font-size:10px'> Line  ". $line . " | File  ". $file . "<div style='text-align:right'> Time: " . $time . "<div>Time since last mark: ".$timer."</div></div></div>";
                $this->block .= "</div>";
                $this->block .= "</div>";
            
            }

            // done - clear
            $_SESSION['marker'] = null;
        }   $_SESSION['thunder_timer']=null;

        return $this->block;
    }
}