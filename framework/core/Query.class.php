<?php

// Task query
define("ORDER_BY_ID", "ORDER_BY_ID");
define("ORDER_BY_EMAIL", "ORDER_BY_EMAIL");
define("ORDER_BY_USER_NAME", "ORDER_BY_USER_NAME");

define("FETCH_ALL_TASKS_QUERY_ORDER_BY_ID", "select id, user_name, email, task_details, status from tasks order by id desc limit :maxRecords offset :offset");
define("FETCH_ALL_TASKS_QUERY_ORDER_BY_EMAIL", "select id, user_name, email, task_details, status from tasks order by email asc limit :maxRecords offset :offset");
define("FETCH_ALL_TASKS_QUERY_ORDER_BY_USER_NAME", "select id, user_name, email, task_details, status from tasks order by user_name asc limit :maxRecords offset :offset");
define("FETCH_ONE_TASK_BY_ID_QUERY", "select id, user_name, email, task_details, status from tasks where id = ?");
define("FETCH_TOTAL_TASKS_COUNT", "select count(id) total from tasks limit 5000");
