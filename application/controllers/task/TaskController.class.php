<?php

/**
 * @author Sergiy Koyev
 * Task Home Controller.
 */
class TaskController extends Controller{

    public function viewTaskAction(){
        $taskModel = new TaskModel("tasks");
        $task = $taskModel->getTaskById( $_GET['taskId'] );
        include CURR_VIEW_PATH . "viewTask.html";
    }

    public function modifyTaskAction(){
      $taskModel = new TaskModel("tasks");
      $task = $taskModel->getTaskById( $_GET['taskId'] );
      include CURR_VIEW_PATH . "modifyTask.html";
    }

    public function createTaskAction(){
        include CURR_VIEW_PATH . "createTask.html";
    }

    /**
     * Update an existing tag by task id
     */
    public function updateTaskAction(){
      if (isset($_POST['userName'])) {
        $task = array("user_name" => $_POST['userName'], "id" => $_POST['taskId'],
        "email" => $_POST['email'], "task_details" => $_POST['task-details'],
        "status" => "Inactive");

        $taskModel = new TaskModel("tasks");
        $taskModel->update( $task );
      }
      header ("location:index.php?p=home&a=home&c=home");
    }

    /**
     * Create a new task record.
     */
    public function saveTaskAction() {
        if (isset($_POST['userName'])) {
          $task = array("user_name" => $_POST['userName'],
          "email" => $_POST['email'], "task_details" => $_POST['task-details'],
          "status" => "Inactive");

          $taskModel = new TaskModel("tasks");
          $taskModel->insert( $task );
        }
        header ("location:index.php?p=home&a=home&c=home");

    }
}
