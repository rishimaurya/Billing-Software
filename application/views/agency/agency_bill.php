     <script src="<?php echo base_url('jquery-3.2.1.min.js'); ?>"></script>
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
    <div class="main-content">

  <script>
	 
	function changetextbox(a)
	{ 
	   if(a==0)
	    {
	       document.getElementById("c_number").disabled='true';
	    }
	   else
	   {
		   document.getElementById("c_number").disabled='';
	   } 
	} 
 </script>        
        <!-- You only need this form and the form-basic.css -->

         <form action="bill_insert" method="post" id="form-basic" onsubmit="return check()" class="form-basic">   
            <div class="form-title-row">
                <h1>Add Bill Details</h1>
            </div>
            <input type="hidden" value="<?php foreach($agency as $name) { echo $name->id; } ?>" name="agency_id">
            <div class="form-row">
                <label>
                    <span>Agency Name</span>
                   <input type="text" name="agency_name" id="agency_name" value="<?php foreach($agency as $name) { echo $name->agency_name; } ?>" disabled required>
                </label> 
                                          
            </div>

            <div class="form-row">
                <label>
                    <span>Bill Number</span>
                   <input type="number" name="bill_no" id="bill_no" min="1" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Bill Amount</span>
                   <input type="tel" name="bill_amount" id="bill_amount" min="1" required>
                </label>
            </div>
           <!--update -->
            <div class="form-row">
                <label>
                    <span>Payment Mode</span>
                    <select name="mode" id="mode" style="width:300px;" onChange="changetextbox(this.value);" required>
						<option value="">Select Mode</option>
						<option value="0">Cash</option>
						<option value="1">Cheque</option>
					</select>	
                </label>
            </div>
            
            
             <div class="form-row">
                <label>
                    <span>Cheque Number</span>
                   <input type="number" id="c_number" name="cheque_number" id="">
                </label>
            </div>
           
            <!--update -->

            <div class="form-row">
                <label>
                    <span>Payment Done</span>
                 <input type="tel" name="payment" id="payment" min="0" required>
                </label>
            </div>      
            
            <div class="form-row">
                <label>
                    <span>Date</span>
                 <input type="date" name="date" id="" value="<?php echo DATE('Y-m-d');?>" required>
                </label>
            </div>      

            <div class="form-row">
                <button type="submit" >Add</button>
            </div>

        </form>

    </div>

</body>

</html>

