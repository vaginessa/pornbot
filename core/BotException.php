<?php

namespace PornBOT\Exception;

class BOTException extends \Exception
{
	public function __toString()
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}