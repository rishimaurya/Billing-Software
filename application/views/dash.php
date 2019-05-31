<?php if(isset($_GET['close'])) echo base64_decode($_GET['close']); ?>
<style>
.bttn

{

   border: none;    

   padding: 8px 20px;

   cursor: pointer;

   font-size: 16px;

   color:white;

   background-color: #00BBB5;

}

</style>
<h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
<div class="row">
	<div class="col-md-6">
		<h2 style="padding-left:20px;">Dashboard</h2>
	</div>
	<!--<div class="col-md-2 col-md-offset-4">
		<a target="_blank" href="<?php echo base_url('Mysql/Take');?>"  >
			<input type="button" name="submit" class="bttn" value="Upload Data">
        </a>
	</div>-->
</div>

</br>
		<div class="market-updates" >
			<div class="col-md-3 market-update-gd" >
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Todays Sell</h4>
					<h3><?php if(!empty($sale))echo " Rs. ".round($sale,2); else echo " Rs. 0";?></h3>
					<p><?php echo "Total Invoices  <strong>".$invoice."</strong>";?></p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		
		

			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Todays Profit</h4>
						<h3><?php if(!empty($profit))echo " Rs. ".round($profit,2); else echo " Rs. 0";?></h3>
					<p><?php echo "Total Invoices  <strong>".$invoice."</strong>";?></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Monthly Sell</h4>
						<h3><?php echo " Rs. ".round($msale,2);?></h3>
					<p><?php echo "Total Invoices  <strong>".$minvoice."</strong>";?></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Monthly Profit</h4>
						<h3><?php echo " Rs. ".round($mprofit,2);?></h3>
					<p><?php echo "Total Invoices  <strong>".$minvoice."</strong>";?></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		</br>
		</br>
		</br>
		<h2 style="padding-left:20px;">Sell Record</h2>
       		</br></br>
       <table>
<tr>
          <th>S No.</th>
          <th>Month</th>
          <th>Total Invoice</th>
          <th>Profit</th>
          <th>Total Sell</th>          
 </tr>
          <?php for($i=1; $i<=12; $i++) { ?>
        <tr>

		  <td><?php echo $i;?></td>	
          <td><?php echo date("Y - F", strtotime( date( 'Y-m-01' )." -$i months"));?></td>
          <td><?php if($linvoice[$i]=='') echo "0";else echo round($linvoice[$i],2);?></td>
          <td><?php if($lprofit[$i]=='') echo "0";else echo round($lprofit[$i],2);?></td>
          <td><?php if($lsale[$i]=='') echo "0";else echo round($lsale[$i],2);?></td>
        </tr>
        <?php } ?>

</table>
    
</br>
</br>
</br>
