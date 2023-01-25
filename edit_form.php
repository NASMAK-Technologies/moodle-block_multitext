<?php
/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
class block_multitext_edit_form extends block_edit_form {
        
    protected function specific_definition($mform) {
        global $CFG , $USER;	
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $usercontext = context_user::instance($USER->id);
        if (has_capability('mod/folder:managefiles', $usercontext)) {
                $mform->addElement('html', ' <div style="padding-left: 3%; padding-bottom: 1%;">
                    <a class="btn btn-primary" style=" width: max-content; " href="'. $CFG->wwwroot .'/blocks/multitext/content.php"> Add Content </a>
                    <a class="btn btn-primary" style=" width: max-content; " href="'. $CFG->wwwroot .'/blocks/multitext/content_list.php">  Content List </a>
                </div>
                ');
        }else{

            $mform->addElement('html', ' <div style="padding-left: 3%; padding-bottom: 1%;">
                <button class="btn btn-primary" title="Only admin can access the configration settings." style=" width: max-content; "  disabled> Add Content </button>
                <button class="btn btn-primary" title="Only admin can access the configration settings." style=" width: max-content; "  disabled>  Content List </button>
                </div>
                ');
        }

	
   

        // $mform->addElement('text', 'config_text', get_string('blockstring', 'block_multitext'));
        // $mform->setDefault('config_text', 'default value');
        // $mform->setType('config_text', PARAM_RAW);        

    }
}