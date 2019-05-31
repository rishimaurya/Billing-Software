<?php

 class LoginModel extends CI_Model
 { 
 	public function select_users($data)
	 {
       $row=$this->db->query("select * from users where username='".$data->username."'");
		$row=$row->result();
		        
		   if($row!=null)
		     {	
                  $hash=$row[0]->password;
		          if(password_verify($data->password,$hash))
			        {
				        return $row;
			        }
			      else
			        {
			            return false;
			        }
		         }
		     else
			       return false;				
	}	
	
 }
