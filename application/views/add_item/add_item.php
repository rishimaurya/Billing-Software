    <script src="<?php echo base_url('jquery-3.2.1.min.js'); ?>"></script>
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
 <script type="text/javascript">
  $(document).ready(function(){
	  $('#percent').on('keyup',function(){
		  var per = $('#percent').val();per=per*1;
		  var mrp = $('#mrp').val();mrp=mrp*1;
		  var dis = (mrp*per)/100;
		  $('#cost_price').val(mrp-dis);
	  });
  });
 </script>
 <script>
	  $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
       }
     });

	</script>
    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

         <form action="Add_item/insert" method="post" id="form-basic" class="form-basic">   
            <div class="form-title-row">
                <h1>Add Item</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Item Code</span>
                    <input type="text" name="barcode" id="barcode"  autofocus required="true" />
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Item Name</span>
                   <input type="text" name="description" id="description" required="true" />
                </label>
            </div>

            
            <div class="form-row">
                <label>
                    <span>Units</span>
                    <input type="number" name="units" id="units" min="1" required="true" />
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Purchase Price</span>
                 <input type="tel" name="cp" id="cp" min="1" required="true" />
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Min Price</span>
                 <input type="tel" name="min_price" id="min_price" min="1" required="true" />
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Max MRP</span>
                 <input type="tel" name="mrp" id="mrp" min="1" required="true" />
                </label>
            </div>

            
            <div class="form-row">
                <label>
                    <span>Alert on</span>
                 <input type="number" name="alert" id="alert" min="1" value="2" required="true" />
                </label>
            </div>            

            <div class="form-row">
                <label>
                    <span>Agency</span>
                    <select name="category" >
                        
                        <!-- <option></option> -->
                        <?php if(!empty($agency))foreach($agency as $a) {?>
                        <option value="<?php echo $a->agency_name;?>"><?php echo $a->agency_name;?></option>
                         <?php } ?>
                    </select>
                </label>
            </div>
            
            <div class="form-row">
                <button type="submit">Add</button>
            </div>

        </form>

    </div>

</body>

</html>
