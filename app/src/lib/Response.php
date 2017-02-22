<?php

namespace sergiobelya\TestTaskmanager\lib;

/**
 * @author Serg
 */
class Response
{
    protected $code = 200;

    protected $headers = array();

    protected $body = '';

    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @todo
     */
    public function sendHeaders()
    {
        
        return $this;
    }

    public function setBody($content)
    {
        $this->body = $content;
    }

    public function getBody()
    {
        return $this->body;
    }
    
}
