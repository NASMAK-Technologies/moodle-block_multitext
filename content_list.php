<?php
/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
require_once('../../config.php');

require_login();

$systemcontext = context_system::instance();

 
global $PAGE , $DB, $CFG ,$USER;
$PAGE->set_pagelayout('admin');
$PAGE->set_url('/blocks/multitext/content_list.php');
$PAGE->set_context($systemcontext);

$site = get_site();

$PAGE->set_title("MultiText - List");
$PAGE->set_heading($site->fullname . ' - ' .  'MultiText');

//dashboard countersr

echo $OUTPUT->header();

$model = $DB->get_records('multitext_list', []);

 
?>
        <div class="">
        
        
   <?php       
    $head = ['#','Title','Institute','Updated at','Action'];
    $table = new html_table();
    $table->head = array();
    $table->colclasses = array();
    $table->attributes['class'] = 'admintable generaltable table-sm text-center';

    $table->head = $head;


    if (isset($model)) {
        $count = 1;
        foreach ($model as $model) {
      
            $row = array();
            $row[] = $count++;
            $row[] = $model->title;
            $row[] = $model->institute;
            $row[] = $model->updated_at;
           
            $row[] = '<a href="'.$CFG->wwwroot.'/blocks/multitext/content.php?id='.$model->id .'"> <img style="    width: 20px;" src="'.$CFG->wwwroot.'/blocks/multitext/icon/edit.svg"/> </a>
                      <a href="'.$CFG->wwwroot.'/blocks/multitext/delete.php?id='.$model->id .'"  onClick="javascript:return confirm(\'are you sure you want to delete this?\');"> <img style="    width: 20px;" src="'.$CFG->wwwroot.'/blocks/multitext/icon/delete.svg"/> </a>
            ';

            // echo '<td class="icon" align="right"><a title="'.$strdelete.'" href="TL_CORE_viewfile.php?delete='.$re->id.'"  onClick="javascript:return confirm(\'are you sure you want to delete this?\');"><img'.
            //  ' src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a></td>';
          


            $table->data[] = $row;
    //        $excelData[] = $row;
        }
    }

    $usercontext = context_user::instance($USER->id);
if (has_capability('mod/folder:managefiles', $usercontext)) {
    // Do or display something.
    
    if (!empty($table)) {
        echo '<h2> '.get_string('sectionslist', 'block_multitext').'</h2><br>';
       
        if (!empty($model)) {
            //  echo' <button type="submit"  name="export_report" id="export_report" class="btn btn-info"> '.get_string('download_report', 'block_internal_credit') .' </button>
            //  ';
            echo html_writer::start_tag('div', array('class'=>'no-overflow','id'=>'report_table'));
            echo html_writer::table($table);
            echo html_writer::end_tag('div');
        } else {
            echo'<br> <p style=" color: red;text-align: center;"> Content Not Found</p>';
        }

        echo'<a href="'. $CFG->wwwroot .'/blocks/multitext/content.php" class="btn btn-secondary" style="margin-bottom:1%;"> Add New Content Block </a>';
    }
} 

?>

        </div>
<?php
echo $OUTPUT->footer();

?>

 <!-- Textual POst Modal -->
 <div class="modal fade" id="myTModal" role="dialog">
    <div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
	<div class="modal-header">
	<h4 class="modal-title">Sessions Detail</h4>
	  <button type="button" class="md-close" data-dismiss="modal">&times;</button>
	</div>
	
	<div class="modal-body container">

     <div id="session-content"> </div> 		
	   

	</div>
	<div class="modal-footer">
	 
	</div>
	
	  
  </div>
  
</div>
</div>



