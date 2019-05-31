

  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>

  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>

  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>

    <div class="main-content">



        <!-- You only need this form and the form-basic.css -->



         <form action="edit_customer" method="post" id="form-basic" class="form-basic">   

            <div class="form-title-row">

                <h1>Edit Customer</h1>

            </div>

       <?php if(!empty($customer)) foreach($customer as $a){?>

         <input type="hidden" name="customer_id" value="<?php echo $a->customer_id;?>"/>

            <div class="form-row">

                <label>

                    <span>Customer Name</span>

                   <input type="text" name="customer_name" id="customer_name" value="<?php echo $a->customer_name;?>" required>

                </label>

            </div>
            <div class="form-row">

                <label>

                    <span>Customer Mobile</span>

                   <input type="text" name="mobile" id="mobile" value="<?php echo $a->mobile;?>" required>

                </label>

            </div>
           
                       <div class="form-row">
                <label>
                    <span>Customer NickName</span>
                   <input type="text" name="nickname" id="nickname" value="<?php echo $a->nickname;?>" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Customer Address </span>
                   <input type="text" name="address" id="address" value="<?php echo $a->address;?>" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Reference</span>
                   <input type="text" name="reference" id="reference" value="<?php echo $a->reference;?>" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Customer Intrest</span>
                   <input type="text" name="intrest" id="intrest" value="<?php echo $a->intrest;?>" >
                </label>
            </div>


      <?php } ?>

            <div class="form-row">

                <button type="submit">Update</button>

            </div>



        </form>



    </div>



</body>



</html>

