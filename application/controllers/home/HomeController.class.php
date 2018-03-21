<?php

/**
 * User Task Home Controller.
 */
class HomeController extends Controller{
    public $tasks;
    private $pageNum = 1; // default page num.
    private $sortBy = ORDER_BY_ID; // default sorting
    private $totalPerPage = 3; // default total per page

    public function homeAction(){

        $taskModel = new TaskModel("tasks");

        $this->sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : ORDER_BY_ID;

        $this->pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : $this->pageNum;

        $totalPages = $taskModel->getTotalTaskPages($this->totalPerPage);

        $this->tasks = $taskModel->getTasks($this->sortBy, $this->pageNum, $this->totalPerPage);

        include CURR_VIEW_PATH . "home.html";
    }

    public function taskPaginationAction(){

        $taskModel = new TaskModel("tasks");

        $direction = isset($_GET['dir']) ? $_GET['dir'] : "next";

        $this->pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : $this->pageNum;

        $totalPages = $taskModel->getTotalTaskPages($this->totalPerPage);

        if($direction === "next" && $totalPages > $this->pageNum) {
          $this->pageNum++;
        } else if($this->pageNum > 1) {
          $this->pageNum--;
        }

        $this->tasks = $taskModel->getTasks($this->sortBy, $this->pageNum, $this->totalPerPage);

        include CURR_VIEW_PATH . "home.html";
    }
}
