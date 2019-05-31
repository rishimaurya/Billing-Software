<style>
.edit
{
   border: none;    
   padding: 8px 20px;
   cursor: pointer;
   font-size: 16px;
   color:white;
   background-color: #00b300;	
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
.btn:hover {background: #003d99;}
</style></br>
<h3 align="center"><?php 
       if(!empty($agency)) 
          echo "Agency Name :- ".strtoupper($agency);
         
?></h3>
<h4 align="center"><?php if(!empty($owner)) echo "Owner :- ".$owner; ?></h4>
<h4 align="center"><?php if(!empty($mobile)) echo "Mobile :- ".$mobile;?></h4>
<h4 align="center"><?php if(!empty($address)) echo "    Address :- ".$address; ?></h4>
</br></br>

<table>
<tr>
          <th>S No.</th>
          <th>Bill No.</th>
          <th>Bill Amount</th>
          <th>Payment Done</th>
          <th>Payment Left</th>          
          <th>Bill Date</th>          
          <th></th>          
          <th></th>          
          <th></th>          
 </tr>
          <?php if(!empty($count)) $i=$count+1; else $i=1;  if(!empty($bill)) foreach($bill as $ag){?>
        <tr>
		  <td><?php echo $i; $i++;?></td>	
          <td><?php echo $ag->bill_no; ?></td>
          <td><?php echo $ag->bill_amount;?></td>
          <td><?php echo $ag->payment; ?></td>
          <td><?php echo $ag->payment_remaining; ?></td>
          <td><?php echo $ag->date; ?></td>
          <td align="center" width="10%">
              <a href="<?php echo base_url().'Agency/bill_edit?id='.base64_encode($ag->agency_id).'&'.'bill_no='.base64_encode($ag->bill_no).'&'.'agency='.base64_encode($agency);?>"  >
			     <input type="button" name="submit" style="background-color:#ff3333;"class="edit" value="Edit">
			  </a>
		  </td>
          <td align="center" width="15%">
              <a href="<?php echo base_url().'Agency/payment?id='.base64_encode($ag->agency_id).'&'.'bill_no='.base64_encode($ag->bill_no).'&'.'agency='.base64_encode($agency);?>"  >
			     <input type="button" name="submit" class="edit" value="Add Payment">
			  </a>
		  </td>	  

          <td  width="15%" align="center">
              <a href="<?php echo base_url().'Agency/payment_history?id='.base64_encode($ag->agency_id).'&'.'bill_no='.base64_encode($ag->bill_no).'&'.'agency='.base64_encode($agency);?>"  >
			     <input type="button" name="submit" class="bttn" value="View Details">
			  </a>
		  </td>	  		  
        </tr>
        <?php } ?>

</table>
<br/><div style="align:center"><?php if(!empty($links)) echo $links; ?>
     </div>
