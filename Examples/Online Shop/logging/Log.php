<?php
class Logger {
    private $logFile;
    private $className;

    public function __construct($className) {
        $this->className = $className;
        $this->logFile = __DIR__ . "/Log.txt";
        $this->info("Logger created for: $className");
    }

    private function log($level, $message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$this->className] [$level] $message\n";

        // Use file_put_contents to write the log entry to the file
        // The FILE_APPEND flag ensures that the log entry is added to the end of the file
        if(file_put_contents($this->logFile, $logEntry, FILE_APPEND)){
        }else{
            echo"Logging error";
        }
    }

    public function info($message) {
        $this->log('{INFO}', $message);
    }

    public function warning($message) {
        $this->log('{WARNING}', $message);
    }

    public function error($message) {
        $this->log('{ERROR}', $message);
    }
}
?>