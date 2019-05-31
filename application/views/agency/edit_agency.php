
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

         <form action="edit_agency" method="post" id="form-basic" class="form-basic">   
            <div class="form-title-row">
                <h1>Edit Agency</h1>
            </div>
       <?php if(!empty($agency)) foreach($agency as $a){?>
         <input type="hidden" name="agency_id" value="<?php echo $a->id;?>"/>
            <div class="form-row">
                <label>
                    <span>Agency Name</span>
                   <input type="text" name="agency_name" id="agency_name" value="<?php echo $a->agency_name;?>" required>
                </label>
            </div>            
            <div class="form-row">
                <label>
                    <span>Agency Mobile</span>
                   <input type="text" name="mobile" id="mobile" value="<?php echo $a->mobile;?>" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Agency Address</span>
                   <input type="text" name="address" id="address" value="<?php echo $a->address;?>" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Agency Owner</span>
                   <input type="text" name="owner" id="owner" value="<?php echo $a->owner;?>" >
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
