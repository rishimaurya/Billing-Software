<style>
.btn
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #00BBB5;
}
.btn:hover {background: #003d99;}
</style><br/><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<h1 align="center" style="color:#00BBB5">Invoice List</h1>
<h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
<div class="container">
<?php
	   if(isset($_COOKIE['bill']))  $bill=$_COOKIE['bill'];
	   if(isset($_COOKIE['customer']))  $customer=$_COOKIE['customer'];
	   if(isset($_COOKIE['mobile']))  $mobile=$_COOKIE['mobile'];
	   if(isset($_COOKIE['date']))  $date=$_COOKIE['date'];
	?>
	<form class="form-horizontal" method="POST" action="<?php echo base_url('ViewInvoice/searchBil'); ?>">
<div class="form-group row">
	    <div class="col-sm-2">
			<label for="client">Bill-No.</label>
			<input type="number" class="form-control" name="billNo" value="<?php if(!empty($bill)) echo $bill; ?>"/>
		</div>
		
	    <div class="col-sm-2">
			<label for="client">Customer-Name:</label>
			<input type="text" class="form-control" name="custName" value="<?php if(!empty($customer)) echo $customer; ?>"/>
		</div>
		
	    <div class="col-sm-2">
			<label for="client">Mobile:</label>
			<input type="number" class="form-control" name="mobile" value="<?php if(!empty($mobile)) echo $mobile; ?>" />
		</div>

	    <div class="col-sm-3">
			<label for="client">Date:</label>
			<input type="date" class="form-control" name="date" value="<?php if(!empty($date)) echo $date; ?>" />
		</div>
		
		<div class="col-sm-2">
			<label for="client"></label>
          <div class="col-sm-12">
			<button type="submit" class="btn btn-primary" name="search" id="btn" >Search</button>
		  </div>
	   </div>

</div>
</form>
</div><br/>
<table id="results"><thead>
<tr>
          <th><a onclick="SortTable(0);" href="javascript:;">S No.</a></th>
          <th><a onclick="SortTable(1);" href="javascript:;">Bill No.</a></th>
          <th><a onclick="SortTable(2);" href="javascript:;">Customer-Name</a></th>
          <th><a onclick="SortTable(3);" href="javascript:;">Mobile</a></th>
          <th><a onclick="SortTable(4);" href="javascript:;">Total</a></th> 
          <th><a onclick="SortTable(5);" href="javascript:;">Discount</a></th>
          <th><a onclick="SortTable(6);" href="javascript:;">Net Amount</a></th>          
          <th><a onclick="SortTable(7);" href="javascript:;">Date</a></th>
          <th></th>          
 </tr></thead>
<tbody>
          <?php if(!empty($count)) $i=$count+1; else $i=1; if(!empty($detail)) foreach($detail as $ag){?>
        <tr>
		  <td><?php echo $i; $i++;?></td>	
          <td><?php echo $ag->sale_id; ?></td>
	  <td><?php echo ucwords($ag->client_name); ?></td>
          <td><?php echo $ag->client_mobile; ?></td>
          <td><?php echo $ag->total;?></td>
          <td></td>
          <td></td>
          <td><?php echo $ag->sale_date;?></td>
          <td align="" width="15%">
              <a href="<?php echo base_url().'Invoice/printInvoice?InvoiceId='.base64_encode($ag->sale_id);?>"  >
			     <input type="button" name="submit" class="btn" value="View">
			  </a>
		  </td>	   		  
        </tr>
        <?php } ?>
</tbody>
</table>
<br/><div style="align:center"><?php if(!empty($links)) echo $links; ?>
</div>



<script>

var sortedOn = 0;
function SortTable(sortOn) {
var table = document.getElementById('results');
var tbody = table.getElementsByTagName('tbody')[0];
var rows = tbody.getElementsByTagName('tr');
var rowArray = new Array();
for (var i=0, length=rows.length; i<length; i++) {
rowArray[i] = new Object;
rowArray[i].oldIndex = i;
rowArray[i].value = rows[i].getElementsByTagName('td')[sortOn].firstChild.nodeValue;
}
if (sortOn == sortedOn) { rowArray.reverse(); }
else {
sortedOn = sortOn;
/*
Decide which function to use from the three:RowCompareNumbers,
RowCompareDollars or RowCompare (default).
For first column, I needed numeric comparison.
*/
if (sortedOn == 0) {
rowArray.sort(RowCompareNumbers);
}
else {
rowArray.sort(RowCompare);
}
}
var newTbody = document.createElement('tbody');
for (var i=0, length=rowArray.length ; i<length; i++) {
newTbody.appendChild(rows[rowArray[i].oldIndex].cloneNode(true));
}
table.replaceChild(newTbody, tbody);
}
function RowCompare(a, b) {
var aVal = a.value;
var bVal = b.value;
return (aVal == bVal ? 0 : (aVal > bVal ? 1 : -1));
}
// Compare number
function RowCompareNumbers(a, b) {
var aVal = parseInt( a.value);
var bVal = parseInt(b.value);
return (aVal - bVal);
}
// compare currency
function RowCompareDollars(a, b) {
var aVal = parseFloat(a.value.substr(1));
var bVal = parseFloat(b.value.substr(1));
return (aVal - bVal);
}
</script>
