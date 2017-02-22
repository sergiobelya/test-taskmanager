<?php

namespace sergiobelya\TestTaskmanager\Controllers;

use sergiobelya\TestTaskmanager\lib\AbstractController;

/**
 * @author Serg
 */
class TasksController extends AbstractController
{

    public function index()
    {
        return $this->tpl->render('pages/tasks-list');
    }
}
