  <script src="<?php echo base_url('jquery-3.2.1.min.js'); ?>"></script>
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>

  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>

  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>

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

   

  

  

    <div class="main-content">



        <!-- You only need this form and the form-basic.css -->



         <form action="payment_insert" method="post" id="form-basic"  class="form-basic">   

            <div class="form-title-row">

                <h1>Add Payment</h1>

            </div>           



           <?php if(!empty($bill)){?> 

            <div class="form-row">

                <label>

                    <span>Customer Name</span>

                   <input type="text" name="customer_name" id="customer_name" value="<?php echo $name;?>"  readonly required />

                </label> 

                                          

            </div>
            <div class="form-row">

                <label>

                    <span>Customer Name</span>

                   <input type="text" name="mobile" id="mobile" value="<?php echo $mobile;?>"  readonly required />

                </label>
            </div>
            <div class="form-row">

                <label>

                    <span>Bill Number</span>

                   <input type="number" name="sale_id" id="sale_id" min="1" value="<?php foreach($bill as $b) { echo $b->sale_id;}?>" readonly required>
                </label>

            </div>



            <div class="form-row">

                <label>

                    <span>Bill Amount</span>

                   <input type="tel" name="bill_total" id="bill_total" value="<?php foreach($bill as $b) { echo $b->bill_total; }?>" min="1" readonly required>

                </label>

            </div>



             <div class="form-row">

                <label>

                    <span>Payment Done</span>

                 <input type="tel" name="payment_d" id="payment_d" min="0" value="<?php foreach($bill as $b) { echo $b->payment; }?>" required readonly>

                </label>

            </div>  

            

            <div class="form-row">

                <label>

                    <span>Payment</span>

                 <input type="tel" name="payment" id="payment" min="0" value="<?php echo $b->bill_total-$b->payment;?>" required>

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

                   <input type="number" id="c_number" name="cheque_no" id="">

                </label>

            </div>

           

            <!--update -->

                <?php //foreach($bill as $b) { echo $b->payment_remaining; }?>

        

    

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



