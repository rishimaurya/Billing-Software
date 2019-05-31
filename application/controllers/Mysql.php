<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
  class Mysql extends CI_Controller
  {
	public function Take()
	{
		/*	$this->load->dbutil();
		$prefs = array(
			'tables'        => array('agency',
										'agency_bill',
										'agency_bill_record',
										'customer',
										'customer_bill',
										'customer_bill_detail',
										'inventory',
										'invoice',
										'invoice_detail',
										'new_inventory',
										'users'),   // Array of tables to backup.
			'ignore'        => array(),                     // List of tables to omit from the backup
			'format'        => 'gzip',                       // gzip, zip, txt
			'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
			'newline'       => "\n"                         // Newline character used in backup file
		);

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup($prefs);

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file(base_url('mybackup.zip'), $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('mybackup.zip', $backup);
	}*/
	$this->load->model('Mysqlm');
	$this->Mysqlm->insert();
	$this->session->set_flashdata('success','Succesfully Updated data to Server.');
	redirect(base_url('Dashboard?close='.base64_encode('<script>setTimeout("window.close();",5000);</script>')));
	}
  }  
