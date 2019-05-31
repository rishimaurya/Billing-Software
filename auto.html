<!DOCTYPE html>
<html>
 <head>
   <title>Invoice</title>
    <!-- Latest compiled and minified CSS --
	<link rel="stylesheet" href="bs.min.css">-->
	<link rel="stylesheet" href="<?php echo base_url('bs.min.css'); ?>">

	<!-- jQuery library -->
	<script src="<?php echo base_url('jquery-3.2.1.min.js'); ?>"></script>

	<!-- Popper JS -->
	<script src="<?php echo base_url('popper.min.js'); ?>"></script>

	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url('bs.min.js'); ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('jquery-ui.css'); ?>">

    <script src="<?php echo base_url('jquery-1.12.4.js'); ?>"></script>
    <script src="<?php echo base_url('jquery-ui.js'); ?>"></script>
    
    <script>
  $( function() {
      function setData(n,m)
      {
           $('#mobile').val(m);
           $('#client').val(n);
      }
      
    $( "#client" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "<?php echo base_url('Invoice/Autocomplete'); ?>",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function (data) {
	                 response($.map(data, function (el) { 
	                     return {
	                         value: el.name,
	                         cName: el.name,
	                         cMobile: el.mobile
	                     };
	                 }));
	             }
        } );
      },
      minLength: 1,
      select: function (event, ui) {
           setData(ui.item.cName,ui.item.cMobile);
        }
    } );
    
    
    $( "#mobile" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "<?php echo base_url('Invoice/Autocomplete'); ?>",
          dataType: "json",
          data: {
            term: request.term, maxResults: 2
          },
          success: function (data) {
	                 response($.map(data, function (el) { 
	                     return {
	                         value: el.mobile,
	                         cName: el.name,
	                         cMobile: el.mobile
	                     };
	                 }));
	             }
        } );
      },
      minLength: 1,
      select: function (event, ui) {
           setData(ui.item.cName,ui.item.cMobile);
        }
    } );
  } );
  </script>
	<script>
	  $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {da
        event.preventDefault();
       }
     });
     
     $(document).ready ( function(){
       $("#cheque_no").attr("disabled","true");
     });

		function getVal(sel)
		{
			var mode = sel.value;
			if(mode==0)
			{
				document.getElementById("cheque_no").disabled = true;
			}
			else
			{
				document.getElementById("cheque_no").disabled = '';
			}
			
		}
	</script>
	<style>
	.form-control
	{
	    font-size:1.4rem;
	}
	/* For Firefox */
input[type='number'] {
    -moz-appearance:textfield;
}
/* Webkit browsers like Safari and Chrome */
input[type=date]::-webkit-inner-spin-button,
input[type=date]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
	</style>
 </head>
 <body style="font-size:1.4rem;">
   <div class="container">
    <h2>Invoice</h2>
    <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
    <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
    <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
    <form class="form-horizontal" method="POST" action="<?php echo base_url('Invoice/submitInvoice'); ?>">
    <div class="form-group row">
        <div class="col-sm-2">
			<label for="client">Client Name:</label>
			<input type="text" class="form-control client" id="client" name="client" value="<?php if(!empty($_GET['name'])) echo base64_decode($_GET['name']);?>"/>
		</div>
	
	    <div class="col-sm-2">
			<label for="Mobile">Mobile :</label>
			<input type="number" onblur="phoneno()" class="form-control col-xs-2 client" id="mobile" value="<?php if(!empty($_GET['mobile'])) echo base64_decode($_GET['mobile']);?>" name="mobile" maxlength="10" required/>
		</div>
		
        <div class="col-sm-2">
			<label for="invoicen">Invoice No.:</label>
			<input type="text" class="form-control col-xs-2" id="invoicen" name="invoicen" tabIndex="-1" readonly="true" value="<?php echo $inv_id+1; ?>" />
		</div>
	
        <div class="col-sm-2">
			<label for="IDate">Invoice Date:</label>
			<input type="date" class="form-control col-xs-2" id="invoice_date" name="invoice_date" value="<?php echo date('Y-m-d'); ?>" />
		</div>
	
        <div class="col-sm-2">
			<label for="IDate">Net-Total:</label>
			<input type="number" class="form-control col-xs-2" id="netTotal" name="netTotal" tabIndex="-1" readonly="true" />
		</div>
	</div>

<div class="form-group row">
        <div class="col-sm-2">
			<label for="client">Payment Amount:</label>
			<input type="text" class="form-control" id="payment" name="payment" />
		</div>
	
	    <div class="col-sm-2">
			<label for="obile">Payment Mode :</label>
			<select class="form-control col-xs-2" id="mode" onchange="getVal(this);" style="height:35px;" name="mode" required>
				<option value="0"> Cash </option>
				<option value="1"> Cheque </option>
			</select>
		</div>
		
        <div class="col-sm-2">
			<label for="invoicen">Cheque No.:</label>
			<input type="text" class="form-control col-xs-2" id="cheque_no" name="cheque_no" />
		</div>
		
		<div class="col-sm-2">
			<label for="invoicen">Seller Profit :</label>
			<input type="text" class="form-control col-xs-2" id="sprofit" name="sprofit" readonly="true"/>
		</div>
		
		<div class="col-sm-2">
			<label for="invoicen"> Customer Discount :</label>
			<input type="text" class="form-control col-xs-2" id="cdiscount" name="cdiscount" readonly="true" />
		</div>
	
	
        <div class="col-sm-2" style="margin-top: 30px;">
			
			<button type="submit" style="margin-left: 10px;" class="btn btn-primary" name="create" id="btn" >Submit</button>
		</div>
	</div>


<!--   <div class="form-group">
        <div class="col-sm-12">
			<label for="IDate" style="">:</label>
			<button type="submit" class="btn btn-primary" name="create" id="btn" >Submit</button>
		</div>
	</div>-->
	<br/>
  <table id="mytable" class="table table-bordered">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Item Code</th>
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
        <td><input type="text"   class="form-control" id="im_1" name="itemName[]" tabIndex="-1"  required="true" /></td>
        <td><input type="tel" class="form-control" id="qt_1" name="quantity[]" onkeyup="calculateSb(1)" onchange="calculateSb(1)"    min="0"  required="true" /></td>
        <td><input type="number" class="form-control" id="up_1" name="uPrice[]"   onkeyup="calculateSb(1)" onchange="calculateSb(1)"  min="1" required="true" /></td>
        <td><input type="number" class="form-control" id="st_1" name="subTotal[]" readonly="true" tabIndex="-1"  /></td>
      
              <input type="hidden" id="mrp_1" name="mrp[]"/>
              <input type="hidden" id="cp_1" name="cPrice[]"/>
              <input type="hidden" id="profit_1" name="prof[]"/>
              <input type="hidden" id="custD_1" name="custD[]"/>
      </tr>
    </tbody>
  </table>
  <input type="hidden" id="tItem" name="totalItems" value="1" />
  <input type="hidden" id="netProfit" name="profit" value="0" />
     </form>
     <!-- <button type="submit" class="btn btn-primary col-sm-32" id="addRow" onclick="addRow()">Add Row</button>-->
   </div>
 </body>
 <script>
		$(document).keypress(function(e) {
			var keycode = (e.keyCode ? e.keyCode : e.which);
			if (keycode == '13') {
                                e.preventDefault();
				addRow();
			}
			
		});
	 var j=2;
	 //Function for adding Row of Table.
	 function addRow()
	 {
	   var rowCount = $('#mytable tr').length;
	   var i = rowCount;	
	   $('#mytable tbody').append('<tr id="'+j+'"><td><span style="color:blue" onclick="removeRow('+j+')"><img src="<?php echo base_url('d3.png'); ?>" /></span></td>\
	                                <td><input type="text" class="form-control" id="br_'+j+'" name="br[]" required="true"   onkeyup="searchBarcode('+j+',this.value)" /></td>\
	                                <td><input type="text"   class="form-control" id="im_'+j+'" name="itemName[]" tabIndex="-1"  required="true" /></td>\
	                                <td><input type="tel" class="form-control" id="qt_'+j+'" name="quantity[]" onkeyup="calculateSb('+j+')" onchange="calculateSb('+j+')"  min="1" required="true" required="true" /></td>\
	                                <td><input type="number" class="form-control" id="up_'+j+'" name="uPrice[]"   onkeyup="calculateSb('+j+')" onchange="calculateSb('+j+')"  min="1" required="true" /></td>\
	                                <td><input type="number" class="form-control" id="st_'+j+'" name="subTotal[]" tabIndex="-1" required="true" readonly="true" /></td>\
	                                <input type="hidden" id="cp_'+j+'" name="cPrice[]"/>\
	                                <input type="hidden" id="mrp_'+j+'" name="mrp[]"/>\
	                                <input type="hidden" id="profit_'+j+'" name="profit[]"/>\
	                                <input type="hidden" id="custD_'+j+'" name="custD[]"/></tr>'); 
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
	     if(digit >= 0)
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
			     $('#mrp_'+i).val(myObj.mrp);
			     $('#up_'+i).val(myObj.mrp);
			     $('#cp_'+i).val(myObj.cp);
			     $('#qt_'+i).attr({
                        "max" : myObj.unitsLeft
                     });
                 $('#profit_'+i).val(myObj.mrp - myObj.cp);
                 $('#custD_'+i).val(0);
			     calculateSb(i);
			     //addRow();
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
			     $('#cp_'+i).val('');
			     $('#st_'+i).val('');
			     $('#mrp_'+i).val('');
			     $('#profit_'+i).val('');
                 $('#custD_'+i).val('');
			     calculateSb(i);
			     
			 }
		  }
        })
	   }
	   else {
			     $('#im_'+i).val('');
			     $('#qt_'+i).val('');
			     $('#up_'+i).val('');
			     $('#cp_'+i).val(''); 
			     $('#st_'+i).val('');
			     $('#mrp_'+i).val('');
			     $('#profit_'+i).val('');
                 $('#custD_'+i).val('');
			     calculateSb(i);
			}
	  }
	  
	  //Function for calculating SubTotal.
	  function calculateSb(i)
	   {
          var quantity = $('#qt_'+i).val();quantity=quantity*1;
          var unitprice = $('#up_'+i).val();unitprice=unitprice*1;
          var costprice = $('#cp_'+i).val();costprice=costprice*1;
          
          var mrp = $('#mrp_'+i).val();mrp=mrp*1;
          if(mrp >= unitprice)
          {
              var discount = mrp - unitprice;
              $('#custD_'+i).val(discount*quantity);
          }
          else
          {
              $('#custD_'+i).val(0);
          }
          
          var pro = unitprice - costprice;
          var profit = pro * quantity;
          
          $('#st_'+i).val(unitprice*quantity);
          $('#profit_'+i).val(profit);
          calculateTotal();
          var imax = $('#qt_'+i).attr('max');imax=imax*1;
          if(imax < quantity )
          {
			  $('#qt_'+i).val('');
			  calculateSb(i);
			  alert('No such Quantity of product is available.');
          }
	   }
	   
	  //Function for calculating Total.
     function calculateTotal()
	  { 
	      var rowCount = $('#mytable tr').length;
		  var itemNumber = rowCount - 1;var i=1;var total=0;var sb=0;var netProfit=0;var rprofit=0;var cDiscount=0;var netDiscount = 0;
		  while(i <= j)
    	   {
	    	   if($('#'+i).length)
	    	    {
				   sb = $('#st_'+i).val();
		           sb = sb * 1;
		           total = total + sb;
		           
		           rprofit = $('#profit_'+i).val();
		           rprofit = rprofit * 1;
		           netProfit = netProfit + rprofit;
		           
		           cDiscount = $('#custD_'+i).val();
		           cDiscount = cDiscount * 1;
		           netDiscount = netDiscount + cDiscount;
		           
		           i++;	
				}
			   else i++; 
		   }
		 $('#netTotal').val(total);
		 $('#netProfit').val(netProfit);
		 $('#sprofit').val(netProfit);
		 $('#cdiscount').val(netDiscount);
	  }
	  
	  
 </script>
<script type="text/javascript">
    $(document).ready(function () {
 
      $('input').keyup(function (e) {
        if (e.which == 39) { // right arrow
          $(this).closest('td').next().find('input').focus();
 
        } else if (e.which == 37) { // left arrow
          $(this).closest('td').prev().find('input').focus();
 
        } else if (e.which == 40) { // down arrow
          $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find('input').focus();
 
        } else if (e.which == 38) { // up arrow
          $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find('input').focus();
        }
      });
 
    // un-comment to display key code
    // $("input").keydown(function (e) {
    //   console.log(e.which);
    // });
    });
  </script>

</html><br/><br/>
