  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('edit'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('delete'));?></h3>
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('add_bill'));?></h3>
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('payment'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('already'));?></h3>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
.btn
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #BB0069;
}
.bttn
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #00BBB5;
}
.edit
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #00b300;	
}
.delete
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #ff6600;	
}
.bill
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #ffcc00;	
}
.btn:hover {background: #003d99;}
.bill:hover {background: #e6b800;}
.edit:hover {background: #269900;}
.delete:hover {background: #e62e00;}
</style>
<h1 align="center" style="color:#00BBB5">Agency List</h1>
</br></br>
<div class="container">
	<?php
	   if(isset($_COOKIE['aName']))  $aName=$_COOKIE['aName'];
	   if(isset($_COOKIE['aMobile']))  $aMobile=$_COOKIE['aMobile'];
	   if(isset($_COOKIE['aOwner']))  $aOwner=$_COOKIE['aOwner'];
	 ?>
<form class="form-horizontal" method="POST" action="<?php echo base_url('Agency/searchAgency'); ?>">
<div class="form-group row">
	    <div class="col-sm-2">
			<label for="client">Agency Name:</label>
			<input type="text" class="form-control" name="name" value="<?php if(!empty($aName)) echo $aName; ?>"/>
		</div>
		
	    <div class="col-sm-2">
			<label for="client">Mobile Number:</label>
			<input type="number" class="form-control" name="mobile" value="<?php if(!empty($aMobile)) echo $aMobile; ?>"/>
		</div>
		
		<div class="col-sm-2">
			<label for="client">Agency Owner:</label>
			<input type="text" class="form-control" name="owner" value="<?php if(!empty($aOwner)) echo $aOwner; ?>"/>
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

<table id="results">
<thead>
<tr>
          <th><a onclick="SortTable(0);" href="javascript:;">S No.</th>
          <th><a onclick="SortTable(1);" href="javascript:;">Agency Name</a></th>
          <th><a onclick="SortTable(2);" href="javascript:;">Agency Mobile</a></th>
          <th><a onclick="SortTable(3);" href="javascript:;">Agency Address</a></th>
          <th><a onclick="SortTable(4);" href="javascript:;">Agency Owner</a></th>
          <th></th>
          <th></th>          
          <th></th>
          <th></th>          
 </tr></thead>
 <tbody>
          <?php $i=1; if(!empty($agency)) foreach($agency as $ag){?>
        <tr>
		  <td width=""><?php echo $i; $i++;?></td>	
          <td width=""><?php echo ucwords($ag->agency_name); ?></td>		  <td width=""><?php echo $ag->mobile?></td>	
		  <td width=""><?php echo $ag->address?></td>	
		  <td width=""><?php echo $ag->owner;?></td>	
          <td align="center" width="6%">
              <a href="<?php echo base_url().'Agency/edit?id='.base64_encode($ag->id);?>"  >
			     <input type="button" name="submit" class="edit" value="Edit">
			  </a>
		  </td>
          <td align="center" width="8%">
              <a href="<?php echo base_url().'Agency/bill?id='.base64_encode($ag->id);?>"  >
			     <input type="button" name="submit" class="btn" value="Add Bill">
			  </a>
		  </td>	  

          <td  width="8%" align="center">
              <a href="<?php echo base_url().'Agency/view_details?id='.base64_encode($ag->id).'&'.'agency='.base64_encode($ag->agency_name).'&mobile='.base64_encode($ag->mobile).'&address='.base64_encode($ag->address).'&owner='.base64_encode($ag->owner);?>"  >
			     <input type="button" name="submit" class="bttn" value="View Details">
			  </a>
		  </td>	 
          <td align="center" width="8%">
              <a href="<?php echo base_url().'Agency/delete?id='.base64_encode($ag->id);?>"  >
			     <input type="button" name="submit" class="delete" onclick="return confirm('Are You sure You want to delete)" value="Delete">
			  </a>
		  </td>
 		  
        </tr>
        <?php } ?>
</tbody>
</table>
<?php if(!empty($links)) echo $links; ?>

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
