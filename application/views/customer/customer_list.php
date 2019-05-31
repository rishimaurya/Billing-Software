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



<h1 align="center" style="color:#00BBB5">Customer List</h1><br/>
<div class="container">
	<?php
	   if(isset($_COOKIE['cName']))  $cName=$_COOKIE['cName'];
	   if(isset($_COOKIE['cMobile']))  $cMobile=$_COOKIE['cMobile'];
	   if(isset($_COOKIE['cRef']))  $cRef=$_COOKIE['cRef'];
	 ?>
<form class="form-horizontal" method="POST" action="<?php echo base_url('Customer/searchCustomers'); ?>">
<div class="form-group row">
	    <div class="col-sm-2">
			<label for="client">Customer Name:</label>
			<input type="text" class="form-control" name="name" value="<?php if(!empty($cName)) echo $cName; ?>"/>
		</div>
		
	    <div class="col-sm-2">
			<label for="client">Mobile Number:</label>
			<input type="number" class="form-control" name="mobile" value="<?php if(!empty($cMobile)) echo $cMobile; ?>"/>
		</div>
		

	    <div class="col-sm-2">
			<label for="client"> Customer Reference:</label>
			<input type="text" class="form-control" name="ref" value="<?php if(!empty($cRef)) echo $cRef; ?>" />
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

          <th><a onclick="SortTable(0);" href="javascript:;">S No.</a></th>

          <th class="" ><a onclick="SortTable(0);" href="javascript:;">Customer Name</a></th>
          <th class="" >Customer Mobile</th>
          <th>Customer Nickname</th>
          <th>Customer Address</th>
          <th>Customer reference</th>
          <th>Customer Intrest</th>
          <th></th>
          <th></th>
          <th></th>

          <th></th>          

 </tr>
</thead>
<tbody>
          <?php $i=1; if(!empty($customer)) foreach($customer as $ag){?>

        <tr>

		  <td width=""><?php echo $i; $i++;?></td>	

          <td width=""><?php echo ucwords($ag->customer_name); ?></td>
          <td width=""><?php echo ucwords($ag->mobile); ?></td>
          <td width=""><?php echo ucwords($ag->nickname); ?></td>
          <td width=""><?php echo ucwords($ag->address); ?></td>
          <td width=""><?php echo ucwords($ag->reference); ?></td>
          <td width=""><?php echo ucwords($ag->intrest); ?></td>

          <td align="center" width="6%">

              <a href="<?php echo base_url().'Customer/edit?id='.base64_encode($ag->customer_id);?>"  >

			     <input type="button" name="submit" class="edit" value="Edit">

			  </a>

		  </td>
          <td  width="8%" align="center">

              <a href="<?php echo base_url().'Invoice/index?name='.base64_encode($ag->customer_name).'&'.'&mobile='.base64_encode($ag->mobile);?>"  >

			     <input type="button" name="submit" class="bttn" value="Create Invoice">

			  </a>

		  </td>	 
          <td  width="8%" align="center">

              <a href="<?php echo base_url().'Customer/view_details?id='.base64_encode($ag->customer_id).'&'.'name='.base64_encode($ag->customer_name).'&mobile='.base64_encode($ag->mobile)
              .'&nickname='.base64_encode($ag->nickname).'&address='.base64_encode($ag->address).'&intrest='.base64_encode($ag->intrest).'&reference='.base64_encode($ag->reference);?>"  >

			     <input type="button" name="submit" class="bttn" value="View Details">

			  </a>

		  </td>	 

          <td align="center" width="8%">
              <a href="<?php echo base_url().'Customer/delete?id='.base64_encode($ag->customer_id);?>"  >
			     <input type="button" name="submit" class="delete" onclick="return confirm('Are You sure You want to delete)" value="Delete">
			  </a>
		  </td>
        </tr>

        <?php } ?>


<tbody>
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

