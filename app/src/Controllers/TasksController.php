<?php

namespace sergiobelya\TestTaskmanager\Controllers;

use sergiobelya\TestTaskmanager\lib\AbstractController;
use sergiobelya\TestTaskmanager\lib\Request;

/**
 * @author Serg
 */
class TasksController extends AbstractController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->layout = 'layouts/main-layout';
    }

    public function index()
    {
        $this->content = $this->tpl->render('pages/tasks-list');
        return $this->render_content();
    }
}
