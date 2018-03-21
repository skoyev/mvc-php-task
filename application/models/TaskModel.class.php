<?php

/**
 * @author Sergiy Koyev
 * Task Model. It contains CRUD Task operations.
 */
class TaskModel extends Model {
    public $userName;
    public $email;
    public $taskDetails;
    public $status;

    /**
     * Fetch all task records with total records = totalPerPage,
     * for pageNum and sort them by sortBy param.
     */
    public function getTasks($sortBy=ORDER_BY_ID, $pageNum=1, $totalPerPage=3) {
        $params = array("maxRecords" => array("type" => PDO::PARAM_INT, "value" => $totalPerPage),
                        "offset"     => array("type" => PDO::PARAM_INT, "value" => ($pageNum - 1) * $totalPerPage));
        $sql   = constant( "FETCH_ALL_TASKS_QUERY_" . strtoupper($sortBy));
        $tasks = $this->db->getAll($sql, $params);
        $data = array();
        foreach ($tasks as $task) {
          $d = new StdClass();
          $d->id = $task['id'];
          $d->userName = $task['user_name'];
          $d->email = $task['email'];
          $d->taskDetails = $task['task_details'];
          $d->status = $task['status'];
          array_push( $data, $d );
        }
        return $data;
    }

    /**
     * Get total task pages.
     */
    public function getTotalTaskPages($totalPerPage = 3) {

        $totalRecordsObj = $this->db->querySingle(FETCH_TOTAL_TASKS_COUNT);

        return ceil(intval($totalRecordsObj->total)/$totalPerPage);
    }

    public function getTaskById($id) {
      $task = $this->db->getOne(str_replace("?", $id, FETCH_ONE_TASK_BY_ID_QUERY));
      return $task;
    }
  }
