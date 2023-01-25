<?php

/**
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 */
class block_multitext extends block_base {
    public function init() {
        $this->title = get_string('multitext', 'block_multitext');
    }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.
    public function get_content() {
		if ($this->content !== null) {
		  return $this->content;
		}

		global $USER,$DB;	
		
		$sql='SELECT  *  FROM {multitext_list} WHERE institute="'.$USER->institution.'"';
		$data = $DB->get_record_sql($sql, []);

		//Select gernal if institute component not found.
		//  if(empty($data))
		//  {
		// 	 $sql='SELECT  *  FROM {multitext_list} WHERE institute="gernal"';
		//    $data = $DB->get_record_sql($sql, []);
		//  }
		// echo"<pre>";
		// print_r($USER);
		// exit;

		 $this->content  =  new stdClass;

	if(isset($data) && !empty($data))
	{
		$this->title = $data->title;
		$this->content->text   = $data->content;

	}else{
		$this->title = "";
		$this->content->text   = "";

	}
		return $this->content;

	  }
	
	}