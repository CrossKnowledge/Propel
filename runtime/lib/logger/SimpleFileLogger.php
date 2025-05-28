<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace CK\Runtime\Lib\Logger;

/**
 * Simple file-based logger implementation that implements BasicLogger interface
 *
 * @author     Author: Abou-Bakr Seddik Ouahabi <aboubakr.ouahabi@innowise.com>
 * @package    propel.runtime.logger
 */
class SimpleFileLogger implements BasicLogger
{
    /**
     * @var string The log file path
     */
    private string $logFile;

    /**
     * @var int The minimum log level to write
     */
    private int $minLevel;

    /**
     * @var array Log level names
     */
    private static array $levelNames = [
        0 => 'EMERGENCY',
        1 => 'ALERT',
        2 => 'CRITICAL',
        3 => 'ERROR',
        4 => 'WARNING',
        5 => 'NOTICE',
        6 => 'INFO',
        7 => 'DEBUG'
    ];

    /**
     * Constructor
     *
     * @param string $logFile   Path to log file
     * @param int $minLevel  Minimum log level (0-7)
     */
    public function __construct(string $logFile = './propel.log', int $minLevel = 7)
    {
        $this->logFile = $logFile;
        $this->minLevel = $minLevel;
    }

    /**
     * A convenience function for logging an alert event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function alert(mixed $message): bool
    {
        return $this->log($message, 1);
    }

    /**
     * A convenience function for logging a critical event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function crit(mixed $message): bool
    {
        return $this->log($message, 2);
    }

    /**
     * A convenience function for logging an error event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function err(mixed $message): bool
    {
        return $this->log($message, 3);
    }

    /**
     * A convenience function for logging a warning event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function warning(mixed $message): bool
    {
        return $this->log($message, 4);
    }

    /**
     * A convenience function for logging a notice event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function notice(mixed $message): bool
    {
        return $this->log($message, 5);
    }

    /**
     * A convenience function for logging an info event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function info(mixed $message): bool
    {
        return $this->log($message, 6);
    }

    /**
     * A convenience function for logging a debug event.
     *
     * @param mixed $message String or Exception object containing the message to log.
     * @return bool True on success
     */
    public function debug(mixed $message): bool
    {
        return $this->log($message, 7);
    }

    /**
     * Primary method to handle logging.
     *
     * @param mixed $message  String or Exception object containing the message to log.
     * @param int|null $severity The numeric severity. Defaults to null so that no
     *                        assumptions are made about the logging backend.
     * @return bool True on success
     */
    public function log(mixed $message, int $severity = null): bool
    {
        if ($severity === null) {
            $severity = 7; // Default to DEBUG
        }

        // Don't log if below minimum level
        if ($severity > $this->minLevel) {
            return true;
        }

        // Convert message to string
        if ($message instanceof \Exception) {
            $messageStr = $message->getMessage() . "\n" . $message->getTraceAsString();
        } else {
            $messageStr = (string) $message;
        }

        // Format log entry
        $levelName = self::$levelNames[$severity] ?? 'UNKNOWN';
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = sprintf(
            "[%s] [%s] %s\n",
            $timestamp,
            $levelName,
            $messageStr
        );

        // Write to file
        try {
            $result = file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
            return $result !== false;
        } catch (\Exception $e) {
            // If we can't write to log file, fail silently or write to error_log
            error_log("Propel logger: Failed to write to log file: " . $e->getMessage());
            return false;
        }
    }
}
