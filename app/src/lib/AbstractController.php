<?php

namespace sergiobelya\TestTaskmanager\lib;

/**
 * @author Serg
 */
class AbstractController
{
    protected $request;

    protected $tpl;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->tpl = new View();
    }

}
