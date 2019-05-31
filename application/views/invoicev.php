<!DOCTYPE html>
<html>
 <head>
   <title>Invoice</title>
    <!-- Latest compiled and minified CSS --
	<link rel="stylesheet" href="bs.min.css">-->
	<link rel="stylesheet" href="<?php echo base_url('bootstrap.css'); ?>">

	<!-- jQuery library -->
	<script src="<?php echo base_url('jquery-3.2.1.min.js'); ?>"></script>

	<!-- Popper JS -->
	<script src="<?php echo base_url('popper.min.js'); ?>"></script>

	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url('bs.min.js'); ?>"></script>
	<script>
	  $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
       }
     });

	</script>
 </head>
 <body>
   <div class="container">
    <h2>Invoice</h2>
    <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
    <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
    <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
    <form class="form-horizontal" method="POST" action="<?php echo base_url('Invoice/submitInvoice'); ?>">
    <div class="form-group row">
        <div class="col-sm-3">
			<label for="client">Client Name:</label>
			<input type="text" class="form-control" id="client" name="client" />
		</div>
	
        <div class="col-sm-3">
			<label for="invoicen">Invoice No.:</label>
			<input type="text" class="form-control col-xs-2" id="invoicen" name="invoicen" tabIndex="-1" readonly="true" value="<?php echo $inv_id+1; ?>" />
		</div>
	
        <div class="col-sm-3">
			<label for="IDate">Invoice Date:</label>
			<input type="date" class="form-control col-xs-2" id="invoice_date" name="invoice_date" value="<?php echo date('Y-m-d'); ?>" />
		</div>
	
        <div class="col-sm-3">
			<label for="IDate">Net-Total:</label>
			<input type="number" class="form-control col-xs-2" id="netTotal" name="netTotal" tabIndex="-1" readonly="true" />
		</div>
	</div>
   <div class="form-group">
        <div class="col-sm-12">
			<button type="submit" class="btn btn-primary" name="create" id="btn" >Submit</button>
		</div>
	</div>
	<br/><br/>
  <table id="mytable" class="table table-bordered">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Item Barcode</th>
        <th>Item-Name</th>
        <th>Quantity</th>
        <th>Unit-Price</th>
        <th>Sub-Total</th>
      </tr>
    </thead>
    <tbody>
      <tr id="1">
        <td><span style="color:blue" onclick="removeRow(1)"><img src="<?php echo base_url('d3.png'); ?>" /></span></td>
        <td><input type="text" class="form-control" id="br_1" name="br[]" 	  onkeyup="searchBarcode(1,this.value)" autofocus="true" required="true" /></td>
        <td><input type="text"   class="form-control" id="im_1" name="itemName[]" tabIndex="-1" readonly="true" required="true" /></td>
        <td><input type="number" class="form-control" id="qt_1" name="quantity[]" onkeyup="calculateSb(1)" onchange="calculateSb(1)"   tabIndex="-1" min="1"  required="true" /></td>
        <td><input type="number" class="form-control" id="up_1" name="uPrice[]"   onkeyup="calculateSb(1)" onchange="calculateSb(1)" tabIndex="-1" min="1" required="true" /></td>
        <td><input type="number" class="form-control" id="st_1" name="subTotal[]" tabIndex="-1" readonly="true" required="true" /></td>
      </tr>
    </tbody>
  </table>
  <input type="hidden" id="tItem" name="totalItems" value="1" />
     </form>
      <button type="submit" class="btn btn-primary col-sm-32" id="addRow" onclick="addRow()">Add Row</button>
   </div>
 </body>
 <script>
	 var j=2;
	 //Function for adding Row of Table.
	 function addRow()
	 {
	   var rowCount = $('#mytable tr').length;
	   var i = rowCount;	
	   $('#mytable tbody').append('<tr id="'+j+'"><td><span style="color:blue" onclick="removeRow('+j+')"><img src="<?php echo base_url('d3.png'); ?>" /></span></td><td><input type="number" class="form-control" id="br_'+j+'" name="br[]" required="true"   onkeyup="searchBarcode('+j+',this.value)" /></td><td><input type="text"   class="form-control" id="im_'+j+'" name="itemName[]" tabIndex="-1" readonly="true" required="true" /></td><td><input type="number" class="form-control" id="qt_'+j+'" name="quantity[]" onkeyup="calculateSb('+j+')" onchange="calculateSb('+j+')" tabIndex="-1" min="1" required="true" required="true" /></td><td><input type="number" class="form-control" id="up_'+j+'" name="uPrice[]"   onkeyup="calculateSb('+j+')" onchange="calculateSb('+j+')" tabIndex="-1" min="1" required="true" /></td><td><input type="number" class="form-control" id="st_'+j+'" name="subTotal[]" tabIndex="-1" readonly="true" required="true" /></td> </tr>'); 
	   j++;
	   var rowCount = $('#mytable tr').length;
	   var itemNumber = rowCount - 1;$('#tItem').val(itemNumber);
	 }
	 
	 //Function for removing Row of Table.
     function removeRow(i)
	  {
		 $('#'+i).remove();
		 var rowCount = $('#mytable tr').length;
	     var itemNumber = rowCount - 1;$('#tItem').val(itemNumber);
		 calculateTotal();  
	  }
	  
	 //Function for searching Product using Barcode.
	 function searchBarcode(i,bdata)
	 {
	     var digit = $('#br_'+i).val().length;
	     if(digit >= 12)
	   { 
        $.ajax({
         url:"<?php echo base_url();?>Invoice/searchItem?barcode_id="+bdata,
         method:"POST",
		 success:function(data)
		  { 
			if(data!='')
			 { 
			     var myObj = JSON.parse(data);
			   if(myObj.unitsLeft != 0)
			   {
			     $('#im_'+i).val(myObj.pname);
			     $('#qt_'+i).val('1');
			     $('#up_'+i).val(myObj.sp);
			     $('#qt_'+i).attr({
                        "max" : myObj.unitsLeft
                     });
			     calculateSb(i);
			     addRow();
			   }
			   else {
				      alert(' '+myObj.pname+' is Out of Stock..');
				      $('#br_'+i).val('');
				    }
			 }
			 else {
			     $('#im_'+i).val('');
			     $('#qt_'+i).val('');
			     $('#up_'+i).val(''); 
			     $('#st_'+i).val('');
			     calculateSb(i);
			     
			 }
		  }
        })
	   }
	   else {
			     $('#im_'+i).val('');
			     $('#qt_'+i).val('');
			     $('#up_'+i).val(''); 
			     $('#st_'+i).val('');
			     calculateSb(i);
			}
	  }
	  
	  //Function for calculating SubTotal.
	  function calculateSb(i)
	   {
          var quantity = $('#qt_'+i).val();quantity=quantity*1;
          var unitprice = $('#up_'+i).val();unitprice=unitprice*1;
          $('#st_'+i).val(unitprice*quantity);
          calculateTotal();
          var imax = $('#qt_'+i).attr('max');imax=imax*1;
          if(imax < quantity )
          {
			  $('#qt_'+i).val('');
			  calculateSb(i);
			  alert('No such Quantity of product is available.');
          }//alert(quantity);
	   }
	   
	  //Function for calculating Total.
     function calculateTotal()
	  { 
	      var rowCount = $('#mytable tr').length;
		  var itemNumber = rowCount - 1;var i=1;var total=0;var sb=0;
		  while(i <= j)
    	   {
	    	   if($('#'+i).length)
	    	    {
				   sb = $('#st_'+i).val();
		           sb = sb * 1;
		           total = total + sb;i++;	
				}
			   else i++; 
		   }
		 $('#netTotal').val(total);
	  }
	  
	  
 </script>
</html>
