<?php
Class IndexController
{
    public function IndexAction()
    {
	return 'INDEX';
    }

    public function ErrorAction()
    {
	trigger_error("ERROR!!!");
	return "do someting....";
    }

    public function ExceptionAction()
    {
	throw new \Exception("EXCEPTION!!!");
    }
}

