<?php
/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
require_once('../../config.php');

global $DB,$CFG;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sessions = $DB->get_record("multitext_list", ['id'=>$id]);
    if(!empty($sessions))
    {
        $DB->delete_records('multitext_list',  ['id'=>$id]);
    }

    $url = $CFG->wwwroot.'/blocks/multitext/content_list.php';
    redirect($url, 'Content Section Deleted Successfully..', 5, \core\output\notification::NOTIFY_ERROR);

   
}