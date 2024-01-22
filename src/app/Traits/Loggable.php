<?php

namespace App\Traits;

trait Loggable
{
    public function logMessage($message)
    {
        echo "Log: $message\n";
    }

    public function logError($error)
    {
        echo "Error Log: $error\n";
    }
}
