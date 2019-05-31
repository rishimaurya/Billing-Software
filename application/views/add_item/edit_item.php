  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

         <form action="update" method="post" id="form-basic" class="form-basic">   
            <div class="form-title-row">
                <h1>Edit Item</h1>
            </div>
           <?php if(!empty($items)) foreach($items as $it) {?>
            <div class="form-row">
                <label>
                    <span>Item Code</span>
                    <input type="text" name="barcode" id="barcode" value="<?php echo $it->barcode_id;?>" readonly/>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Item Name</span>
                   <input type="text" name="description" id="description" value="<?php echo $it->description;?>" required>
                </label>
            </div>

                        <div class="form-row">
                <label>
                    <span>Category</span>
                    <select name="category" >
                        
                        <option></option>
                        <?php if(!empty($agency))foreach($agency as $a) {?>
                        <option value="<?php echo $a->agency_name;?>" <?php if($a->agency_name == $it->category) echo "selected";?>><?php echo $a->agency_name;?></option>
                         <?php } ?>
                    </select>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Units</span>
                    <input type="number" name="units" id="units" min="1" value="<?php echo $it->units;?>" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>MRP</span>
                 <input type="tel" name="mrp" id="mrp" min="1"  value="<?php echo $it->mrp;?>" required>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Purchase Price</span>
                 <input type="tel" name="cp" id="cp" min="1"  value="<?php echo $it->cost_price;?>" required>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Alert on</span>
                 <input type="number" name="alert" id="alert" min="1" value="<?php echo $it->low_units;?>" required>
                </label>
            </div>            

            <div class="form-row">
                <button type="submit">Update</button>
            </div>
			<?php }?>
        </form>

    </div>

</body>

</html>

