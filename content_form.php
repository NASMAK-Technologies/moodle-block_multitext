<?php
/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
use tool_usertours\local\filter\course;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');

/**
 * The form for handling featured courses.
 */
class content_form extends moodleform
{

    /**
     * Form definition.
     */
    public function definition()
    {
        global $CFG, $USER, $OUTPUT,$DB,$PAGE;
        
        $sql='SELECT  DISTINCT institution FROM {user} WHERE institution != ""';
        $institute_data = $DB->get_records_sql($sql, []);
        $options_inst = array();
        $options_inst[-1] = "Select Institute";
        // $options_inst['gernal'] = 'Gernal';
        foreach($institute_data as $key=>$value){
           
            $options_inst[$value->institution] =  $value->institution;
          }

        if(isset($_GET['id']))
        {
           $c_data =  $DB->get_record('multitext_list', ['id'=>$_GET['id']], $fields='*', $strictness=IGNORE_MISSING);

         }

        $mform = $this->_form;
       
        
       
        $mform->addElement('hidden', 'id', $c_data->id)->setValue(($c_data->id) ? $c_data->id : '');

        $mform->addElement('text', 'title', get_string('title', 'block_multitext'), 'size="50"')->setValue(($c_data->title) ? $c_data->title : '');
        // $mform->addRule('title', get_string('required'), 'required');
        $mform->setType('title', PARAM_TEXT);

        $mform->addElement('editor', 'content', get_string('description', 'block_multitext'), null, $this->_customdata->event->editoroptions)->setValue( array('text' => ($c_data->content) ? $c_data->content : ''));
        $mform->setType('content', PARAM_RAW);
        $mform->addRule('content', get_string('required'), 'required');

        // $mform->addElement('text', 'institute', get_string('institute', 'block_multitext'), 'size="50"')->setValue(($c_data->institute) ? $c_data->institute : '');;
        $mform->addElement('select', 'institute', get_string('institute', 'block_multitext'), $options_inst, $attributes)->setValue(($c_data->institute) ? $c_data->institute : '');
        $mform->addRule('institute', get_string('required'), 'required');
        $mform->setType('name', PARAM_TEXT);
       
        // $mform->addElement('submit', 'save', get_string("submit", "block_multitext"));
        $buttonarray=array();
        $buttonarray[] = $mform->createElement('submit', 'save', get_string("submit", "block_multitext"));
        // $buttonarray[] = $mform->createElement('reset', 'resetbutton', get_string('revert'));
        $buttonarray[] = $mform->createElement('html','<a class="btn btn-secondary" style=" width: max-content; " href="'. $CFG->wwwroot .'/blocks/multitext/content_list.php">  Cancel </a>');
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);

        // $mform->addElement('html', '  <a class="btn btn-danger" style=" width: max-content; " href="'. $CFG->wwwroot .'/blocks/multitext/content_list.php">  Cancel </a> ');

        $mform->closeHeaderBefore('save');
    }

    function validation($data, $files) {
        global $DB, $CFG;
       
        $errors = parent::validation($data, $files);

        if($data['institute'] == -1)
        {
         $errors['institute'] = "Please select the Institue";
        }
        $sql='SELECT  *  FROM {multitext_list} WHERE institute="'.$data['institute'].'"';
        $inst = $DB->get_record_sql($sql, []);
        if(!empty($inst))
        {
            if(isset($data['id']))
            {
                $c_data =  $DB->get_record('multitext_list', ['id'=>$data['id']], $fields='*', $strictness=IGNORE_MISSING);
                if($data['institute']  != $c_data->institute)
                {
                    $errors['institute'] = "Component of ".$data['institute']." is already exist.";
               
                }
                
            }
           
        }

        
        return $errors;
    }
}


