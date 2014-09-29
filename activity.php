<?php
include_once "config.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_activity.php";

$class_session=new class_session();
if(!$class_session->check_login())
{
   $class_session->changePage(BASE_URL."error.php");
}

$class_user=new class_user();

$current_user = $class_user->get_current_user();

$class_activity=new class_Activity();

$new_activity=$class_activity->get_activity();

include 'view/activity_page.php';