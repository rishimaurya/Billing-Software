       <script src="<?php echo base_url('jquery-3.2.1.min.js'); ?>"></script>

  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
   <script>
	 
   function check() 
   {
        var x;
        var y;
        x = document.getElementById("bill_amount").value;
        y = document.getElementById("payment").value;
        if(y > x)
        {
           alert('payment should be more than bill');
           return false;
        }   
        else
        {
		   return true;	
		}
  }
 </script>        
   
  
  
    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

         <form action="bill_update" method="post" id="form-basic" onsubmit="return check()" class="form-basic">   
            <div class="form-title-row">
                <h1>Update Bill</h1>
            </div>           

           <?php if(!empty($bill)){?> 
            <div class="form-row">
                <label>
                    <span>Agency Name</span>
                   <input type="text" name="agency_name" id="agency_name" value="<?php echo $agency;?>"  readonly required />
                </label> 
                                          
            </div>

            <input type="hidden" name="agency_id" value="<?php foreach($bill as $b) { echo $b->agency_id; } ?>">
            <input type="hidden" name="prev_bill" value="<?php foreach($bill as $b) { echo $b->bill_no; } ?>">
            <input type="hidden" name="prev_bill_amount" value="<?php foreach($bill as $b) { echo $b->bill_amount; } ?>">

            <div class="form-row">
                <label>
                    <span>Bill Number</span>
                   <input type="number" name="bill_no" id="bill_no" min="1" value="<?php foreach($bill as $b) { echo $b->bill_no;}?>"  required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Bill Amount</span>
                   <input type="tel" name="bill_amount" id="bill_amount" value="<?php foreach($bill as $b) { echo $b->bill_amount; }?>" min="1" readonly required>
                </label>
            </div>

 
                
             <input type="hidden" name="prevdate" value="<?php foreach($bill as $b) { echo $b->date; }?>">

         <div class="form-row">
                <label>
                    <span>Date</span>
                 <input type="date" name="date" id="date" value="<?php echo date('Y-m-d')?>" required>
                </label>
            </div>      
			<?php }	?>
            <div class="form-row">
                <button type="submit">Add</button>
            </div>

        </form>

    </div>

</body>

</html>


