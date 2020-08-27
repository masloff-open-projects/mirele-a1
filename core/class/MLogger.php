<?php

/**
 * A class for logging errors inside the system. Supports several error types:
 * 1. information - low level error.
 * 2. Warning - middle level error
 * 3. Error is a high level error.
 * 4. Fatal - an error that caused the software to fail.
 */

class MLogger
{

    private $time;
    private $file;
    private $line_mask;
    private $time_mask;
    private $welcome_message;

    public function __construct($file='./logger.log') {

        $this->file = $file;
        $this->line_mask = "{{type}} {{time}} >>> {{text}}";
        $this->time_mask = "Y-m-d H:i";
        $this->time = date($this->time_mask, time());
        $this->welcome_message = join("\n", [
            "# Welcome to the system action log file.",
            "# The file was created: $this->time",
            "# Mirele Core Version: " . MIRELE_VERSION,
            "# Rosemary Core Version: " . ROSEMARY_VERSION,
            "",
            ""
        ]);

        # File exists
        if (!MFile::exist ($file)) {
            MFile::write ($file, $this->welcome_message);
        }

    }

    public function log ($level='info', $text="") {

        $text = is_array($text) ? join(" ", $text) : $text;

        if ($text) {
            return MFile::append ($this->file, str_replace(['{{type}}', '{{time}}', '{{text}}'], [strtoupper($level), date($this->time_mask, time()), $text], $this->line_mask) . PHP_EOL, function () {
                if (file_exists(MIRELE_ERROR_FILE)) {
                    file_put_contents(MIRELE_ERROR_FILE, "$this->file - can't be write" . PHP_EOL, FILE_APPEND);
                }
            });
        } else {
            return false;
        }

    }

    public function info ($text) {

        return $this::log('info', $text);

    }


    public function warning ($text) {

        return $this::log('warning', $text);

    }


    public function error ($text) {

        return $this::log('error', $text);

    }

}