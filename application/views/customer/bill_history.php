<style>

.btn

{

   border: none;    

   padding: 8px 20px;

   cursor: pointer;

   font-size: 16px;

   color:white;

   background-color: #0052cc;

}

.btn:hover {background: #003d99;}

</style>
</br>
<h3 align="center"><?php if(!empty($name)) echo "Customer :- ".strtoupper($name); ?></h3>
<h4 align="center"><?php if(!empty($nickname)) echo "Customer Nickname :- ".strtoupper($nickname); ?></h4>
<h4 align="center"><?php if(!empty($mobile)) echo "Mobile No. :- ".strtoupper($mobile); ?></h4>
<h4 align="center"><?php if(!empty($reference)) echo "Reference :- ".strtoupper($reference); ?></h4>
<h4 align="center"><?php if(!empty($intrest)) echo "Intrest :- ".strtoupper($intrest); ?></h4>
<h4 align="center"><?php if(!empty($address)) echo "Address :- ".strtoupper($address); ?></h4>

</br>



<table>

<tr>

          <th>S No.</th>

          <th>Bill No.</th>

          <th>Bill Amount</th>

          <th>Payment Done</th>

          <th>Payment Left</th>   

          <th>Payment Mode</th>

          <th>Cheque Number</th>       

          <th>Bill Date</th>          

 </tr>

          <?php if(!empty($count)) $i=$count+1; else $i=1; if(!empty($history)) foreach($history as $ag){?>

        <tr>

		  <td><?php echo $i; $i++;?></td>	

          <td><?php echo $ag->sale_id; ?></td>

          <td><?php echo $ag->bill_total;?></td>

          <td><?php echo $ag->payment; ?></td>

          <td><?php echo $ag->bill_total - $ag->payment; ?></td>

           <td><?php if($ag->payment_mode == 1) echo "Cheque"; else echo "Cash";?></td>

          <td><?php echo $ag->cheque_no; ?></td>

          <td><?php echo $ag->date; ?></td>

        </tr>

        <?php } ?>



</table>

<br/><div style="align:center"><?php if(!empty($links)) echo $links; ?>

     </div>







