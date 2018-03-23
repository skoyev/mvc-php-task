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
     * Upload task image file function.
     */
    public function uploadTaskFileAction() {

      $currentDir = getcwd();
          $uploadDirectory = "uploads\\";

          $errors = []; // Store all foreseen and unforseen errors here

          $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
          $fileName = $_FILES['fileToUpload']['name'];
          $fileSize = $_FILES['fileToUpload']['size'];
          $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
          $fileType = $_FILES['fileToUpload']['type'];
          $tmp = explode('.', $fileName);
          $fileExtension = end($tmp);

          $uploadPath = ROOT . $uploadDirectory . basename($fileName);

          if (! in_array($fileExtension, $fileExtensions)) {
              $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
          }

          if ($fileSize > 3000000) {
              $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
          }

          $result = array();
          if (empty($errors)) {

              $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

              if ($didUpload) {
                $result = array('status'=>'done', 'message'=>"The file $fileName has been uploaded successfully!.");
              } else {
                $result = array('status'=>'error', 'message'=>"An error occurred somewhere. Try again or contact the admin");
              }
          } else {
            $result = array('status'=>'error', 'message'=>$errors);
          }

          echo json_encode($result);
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
          "status" => "Inactive", "task_image" => $_POST['task-image']);

          $taskModel = new TaskModel("tasks");
          $taskModel->insert( $task );
        }
        header ("location:index.php?p=home&a=home&c=home");

    }
}
