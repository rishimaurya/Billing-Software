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
<h1 align="center" style="color:red">Quantity Alert</h1>
<h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
<div class="container">
<?php
	   if(isset($_COOKIE['barcode']))  $barcode=$_COOKIE['barcode'];
	   if(isset($_COOKIE['agency']))  $agencys=$_COOKIE['agency'];
	   if(isset($_COOKIE['productName']))  $productName=$_COOKIE['productName'];
	   if(isset($_COOKIE['units']))  $units=$_COOKIE['units'];
	?>
	<form class="form-horizontal" method="POST" action="<?php echo base_url('ViewInvoice/searchItems'); ?>">
<div class="form-group row">
	    <div class="col-sm-2">
			<label for="client">Barcode:</label>
			<input type="number" class="form-control" name="barcode" value="<?php if(!empty($barcode)) echo $barcode; ?>"/>
		</div>
		
	    <div class="col-sm-2">
			<label for="client">Product Name:</label>
			<input type="text" class="form-control" name="productName" value="<?php if(!empty($productName)) echo $productName; ?>"/>
		</div>
		
	    <div class="col-sm-2">
			<label for="client">Agency:</label>
			<select name="agency" class="form-control">
                        
                        <option></option>
                        <?php if(!empty($agency))foreach($agency as $a) {?>
                        <option value="<?php echo $a->agency_name;?>" <?php if(!empty($agencys)) { if($agencys==$a->agency_name) echo "selected"; } ?> ><?php echo ucwords($a->agency_name);?></option>
                         <?php } ?>
            </select>
		</div>

	    <div class="col-sm-2">
			<label for="client">Units:</label>
			<input type="number" class="form-control" name="units" value="<?php if(!empty($units)) echo $units; ?>" />
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
<table>
<tr>
          <th><a onclick="SortTable(0);" href="javascript:;">S No.</a></th>
          <th><a onclick="SortTable(1);" href="javascript:;">Barcode</a></th>
          <th><a onclick="SortTable(2);" href="javascript:;">Item Name</a></th>
          <th><a onclick="SortTable(3);" href="javascript:;">Units Left</a></th>
          <th><a onclick="SortTable(4);" href="javascript:;">Category</a></th> 
 </tr>
          <?php if(!empty($count)) $i=$count+1; else $i=1; if(!empty($detail)) foreach($detail as $ag){?>
        <tr>
		  <td><?php echo $i; $i++;?></td>	
          <td><?php echo $ag->barcode_id; ?></td>
          <td><?php echo ucwords($ag->description); ?></td>
          <td><?php echo $ag->units;?></td>
          <td><?php echo ucwords($ag->category);?></td>	   		  
        </tr>
        <?php } ?>

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




