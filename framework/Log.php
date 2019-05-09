<?php
namespace framework;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log{
    private $log;
    function __construct(){
        $log = new Logger('app');
        $debug = config('app.debug', false);
        $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', $debug ? Logger::DEBUG : Logger::WARNING));
        $this->log= $log;
    }

    public function info($message){
        $this->log->info($message);
    }

    public function debug($message){
        $this->log->debug($message);
    }

    public function error($message){
        $this->log->error($message);
    }
}