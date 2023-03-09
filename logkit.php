<?php

/**
 * Logkit - The single function logger.
 *
 * @version 0.1.0
 * @author Tobias Röder
 */

/**
 * Log data into a log file.
 *
 * @param string $level Log level.
 *  - Emergency (EMERG): system is unusable.
 *  - Alert (ALERT): immediate action required.
 *  - Critical (CRIT): critical conditions.
 *  - Error (ERROR): error conditions.
 *  - Warning (WARN): warning conditions.
 *  - Notice (NOTICE): normal but significant conditions.
 *  - Informational (INFO): informational messages.
 *  - Debug (DEBUG): messages helpful for debugging.
 * @param string $message Log message.
 * @param array|null $data Optional. Additional data.
 *
 * @return int|false Returns the number of bytes that were written to the file, or false on failure.
 */
function logkit(string $level, string $message, ?array $data = null)
{
    $log_dir = __DIR__ . '/logs';
    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0777, true);
    }
    $logFile = $log_dir . '/logkit_log-' . $today . '.log';

    $logData = '[' . $now . '-' . $level . '] ' . $message . "\n";

    if ($data) {
        $dataString = print_r($data, true) . "\n";
        $logData .= $dataString;
    }

    return file_put_contents($logFile, $logData, FILE_APPEND);
}
