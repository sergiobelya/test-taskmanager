<?php

namespace sergiobelya\TestTaskmanager\Controllers;

use sergiobelya\TestTaskmanager\lib\AbstractController;

/**
 * @author Serg
 */
class ErrorController extends AbstractController
{
    protected $layout = 'layouts/main-layout';

    public function error404($message = '')
    {
        $this->content = $this->tpl->render('errors/404', compact('message'));
        return $this->render_content();
    }
}
