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

</style>
</br></br>
<h3 align="center"><?php if(!empty($name)) echo "Customer :- ".strtoupper($name); ?></h3>
<h4 align="center"><?php if(!empty($nickname)) echo "Customer Nickname :- ".strtoupper($nickname); ?></h4>
<h4 align="center"><?php if(!empty($mobile)) echo "Mobile No. :- ".strtoupper($mobile); ?></h4>
<h4 align="center"><?php if(!empty($reference)) echo "Reference :- ".strtoupper($reference); ?></h4>
<h4 align="center"><?php if(!empty($intrest)) echo "Intrest :- ".strtoupper($intrest); ?></h4>
<h4 align="center"><?php if(!empty($address)) echo "Address :- ".strtoupper($address); ?></h4>


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

          <td><?php echo $ag->sale_id; ?></td>

          <td><?php echo $ag->bill_total;?></td>

          <td><?php echo $ag->payment; ?></td>

          <td><?php echo ($ag->bill_total - $ag->payment); ?></td>

          <td><?php echo $ag->date; ?></td>

          <td align="center" width="10%">

              <a href="<?php echo base_url().'Invoice/updateInvoice?InvoiceId='.base64_encode($ag->sale_id);?>"  >

			     <input type="button" name="submit" style="background-color:#ff3333;"class="edit" value="Edit">

			  </a>

		  </td>

          <td align="center" width="15%">
              <?php 
                if(empty($nickname))
                $nickname="";
                if(empty($reference))
                $nickname="";
                if(empty($intrest))
                $nickname="";
                if(empty($address))
                $nickname="";
              ?>
              <a href="<?php echo base_url().'Customer/payment?id='.base64_encode($ag->sale_id).'&'.'name='.base64_encode($name).'&mobile='.base64_encode($mobile);?>"  >

			     <input type="button" name="submit" class="edit" value="Add Payment">

			  </a>

		  </td>	  



          <td  width="15%" align="center">

              <a href="<?php echo base_url().'Customer/payment_history?id='.base64_encode($ag->sale_id).'&'.'name='.base64_encode($name).'&mobile='.base64_encode($mobile).'&nickname='.base64_encode($nickname).'&address='.base64_encode($address).'&intrest='.base64_encode($intrest).'&reference='.base64_encode($reference);?>"  >

			     <input type="button" name="submit" class="bttn" value="View Details">

			  </a>

		  </td>	  		  

        </tr>

        <?php } ?>



</table>

<br/><div style="align:center"><?php if(!empty($links)) echo $links; ?>

     </div>

