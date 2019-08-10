<?php
namespace App\Core;

use Exception;
use ErrorException;

/**
 * Error and exception handler
 */
class Error {
    /**
    * Error handler. Convert all errors to Exceptions by throwing an ErrorException
     * @param int $level Error level
     * @param string $message Error message
     * @param string $filename filename the error was raised in
     * @param int $line Line number in the file
     * @throws
     */
    public static function errorHandler($level, $message, $filename, $line) {
        if (error_reporting() !== 0) {
            throw new ErrorException($message, 0, $level, $filename, $line);
        }
    }

    /**
     * Exception handler
     * @param Exception $exception The exception
     * @return void
     */
    public static function exceptionHandler(Exception $exception) {
        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exceptions : " . get_class($exception) . "</p>";
        echo "<p>Message : '" . $exception->getMessage() . "'</p>";
        echo "<p>Uncaught exception : <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Uncaught exception : " . $exception->getFile() . " on line " . $exception->getLine() . "</p>";
    }
}