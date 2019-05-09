<?php
// namespace Helper;
include __DIR__ . '/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// use Monolog\Processor\UidProcessor;
// use Monolog\Processor\ProcessIdProcessor;
// use Monolog\Formatter\JsonFormatter;

$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::WARNING));

// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');
$log->info('My loger is no ready');
echo '完成';