<?php
/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
require_once('../../config.php');
require_once($CFG->dirroot.'/blocks/moodleblock.class.php');
require_once($CFG->dirroot.'/blocks/multitext/content_form.php');


require_login();

$systemcontext = context_system::instance();

 
global $PAGE , $DB, $CFG ,$USER;
$PAGE->set_pagelayout('admin');
$PAGE->set_url('/blocks/multitext/content.php');
$PAGE->set_context($systemcontext);

$editform = new content_form(null, $exist);

if ($editform->is_cancelled()) {
    redirect($CFG->wwwroot.'/?redirect=0');
} else if ($data = $editform->get_data()) {


    $data->content = $data->content['text'];
    $data->updated_at = date("d/m/Y h:i:sa");
    if(empty($data->id))
    { 
        //insert new section
        $data->created_at = date("d/m/Y h:i:sa");
        $result = $DB->insert_record('multitext_list', $data, $returnid=true, $bulk=false);
        $msg ="Content Section Created Successfully.";
    }else{
        //update currunt section
        $result = $DB->update_record('multitext_list', $data, $bulk=false);
        $msg ="Content Section Updated Successfully.";

    }

    if ($result) {
    
        $url = $CFG->wwwroot .'/blocks/multitext/content_list.php';
        redirect($url, $msg, 5, \core\output\notification::NOTIFY_SUCCESS);
    }
}

$usercontext = context_user::instance($USER->id);
if (has_capability('mod/folder:managefiles', $usercontext)) {
    $site = get_site();

    $PAGE->set_title(get_string('editpagetitle', 'block_multitext'));
    $PAGE->set_heading($site->fullname . ' - ' .  get_string('pluginname', 'block_multitext'));

    echo $OUTPUT->header(),

     $OUTPUT->heading(get_string('editpagedesc', 'block_multitext')),

     $editform->render(),

     $OUTPUT->footer();
}