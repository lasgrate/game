<?php

namespace Game;

class Logger
{
    public function log($message, $level)
    {
        error_log($message, $level);
    }
}
