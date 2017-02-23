<?php

namespace sergiobelya\TestTaskmanager\Controllers;

use sergiobelya\TestTaskmanager\lib\AbstractController;
use sergiobelya\TestTaskmanager\lib\Request;
use sergiobelya\TestTaskmanager\Models\Task;
//use sergiobelya\TestTaskmanager\model\Task;

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
        $tasks = Task::all();
        $this->content = $this->tpl->render('pages/tasks-list', compact('tasks'));
        return $this->render_content();
    }
}
