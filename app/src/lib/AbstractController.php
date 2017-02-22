<?php

namespace sergiobelya\TestTaskmanager\lib;

/**
 * @author Serg
 */
class AbstractController
{
    protected $request;

    protected $tpl;

    protected $layout;

    protected $content;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->tpl = new View();
    }

    protected function render_content()
    {
        if (!$this->content) {
            return '';
        }
        if ($this->request->isAjax() || !$this->layout) {
            return $this->content;
        }
        return $this->tpl->render($this->layout, ['content' => $this->content]);
    }
}
