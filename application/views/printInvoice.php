		<title>Invoice || Billing</title>
		<style>
			.button {
			background-color: #00BBB5; /* Green */
			border: none;
    		color: white;
    		padding: 16px 32px;
    		text-align: center;
    		text-decoration: none;
    		display: inline-block;
    		font-size: 16px;
    		margin: 4px 2px;
    		-webkit-transition-duration: 0.4s; /* Safari */
    		transition-duration: 0.4s;
    		cursor: pointer;
		}
		.button {
			display:inline;
		}
		</style>
		<script>
			function printDiv(divName) {
			  var printContents = document.getElementById(divName).innerHTML;
			  w=window.open();
 			  w.document.write(printContents);
   			  w.print();
			  w.close();
           }
           function redirect()
           {
			   window.open("<?php echo base_url('Invoice/updateInvoice/?InvoiceId='.$_GET['InvoiceId']); ?>","_self");
		   }
		</script>
	</head>
	<body>
		<div id="print-content" style="">
			<b><p style="text-align: center;line-height:8px;font-family: Arial, Helvetica, sans-serif !important;font-weight:900 !important;">Agarwal Stores</p></b>
			<b><p style="text-align: center;line-height:8px;font-family: Arial, Helvetica, sans-serif !important;font-weight:900 !important;">MG Road, Dewas (M.P.)</p></b>
			<hr style="font-family: Arial, Helvetica, sans-serif !important;font-weight:300 !important;" size="2">
			<p style="line-height:8px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">Invoice No. : <?php if(!empty($_GET['InvoiceId'])) echo base64_decode($_GET['InvoiceId']); ?><span style="padding-left:100px;">Date : <?php $date=date_create($iv[0]->sale_date); echo date_format($date,"d-m-Y"); ?></span></p>
			
			
			<p style="line-height:8px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">Client : <?php echo $iv[0]->client_name; ?><span style="padding-left:100px;">Mobile : <?php echo $iv[0]->client_mobile; ?></span></p>
			

		    <hr size="2">
		    <table>
				<tr style="line-height:8px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">
					<td style="min-width:20px;">Sr.</td>
					<td style="min-width:160px;">Product</td>
					<td style="margin-left:30px; min-width:40px;max-width:50px;">MRP</td>
					<td style="min-width:30px;max-width:30px;">Qty</td>
					<td style="min-width:45px;max-width:45px;">Amount</td>
				</tr>
		    </table><hr style="font-family: Arial, Helvetica, sans-serif !important;font-weight:300 !important;" size="2">
		    <table>
				<?php 
					  if(!empty($item)) 
					  { $i=1;$mrpNetTotal=0;$total=0;
						  foreach($item as $idata)
						  {
				?>
				<tr style="line-height:16px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">
					<td style="vertical-align:text-top;text-align:left;max-width:20px;min-width:20px;"><?php echo $i++; ?></td>
					<td style="max-width:180px;min-width:180px;"><?php echo strtoupper($idata->description); ?></td>
					<td style="min-width:40px;max-width:50px;"><?php $mrp = $idata->price; echo number_format((float)$mrp, 2, '.', '');?></td>
					<td style="vertical-align:text-top;text-align:left;min-width:30px;max-width:30px;"><?php echo $qt = $idata->quantity;$mrpNetTotal=$mrpNetTotal + ($idata->price * $idata->quantity); ?></td>
					<td style="vertical-align:text-top;text-align:left;min-width:45px;max-width:45px;"><?php $total = $idata->price * $idata->quantity; echo number_format((float)$total, 2, '.', ''); ?></td>
				</tr>
				<?php
					      }
					  }
				?>
			</table>
			<table><br/><hr style="font-family: Arial, Helvetica, sans-serif !important;font-weight:300 !important;" size="2">
				<!--<tr><td style="padding-left:200px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">Gross AMT</td>
				<td style="padding-right:20px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">: <?php echo $mrpNetTotal; ?></td></tr>
				<tr><td style="padding-left:200px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">Discount    </td>
				<td style="padding-right:20px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">: <?php echo $mrpNetTotal -  $total; ?></td></tr>
				--><tr><td style="padding-left:200px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;"> Disccount </td>
				<td style="padding-right:20px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">: <?php echo $iv[0]->discount; ?> Rs.</td></tr>
				<tr><td style="padding-left:200px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">Net Amount  </td>
				<td style="padding-right:20px;font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">: <?php echo $mrpNetTotal; ?> Rs.</td></tr>
		    </table>
		    <br/>
		    <span style="font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">
		    <?php echo "In Words - ".ucwords(digits_to_words($mrpNetTotal)); ?>
		    </span>
		    <hr style="font-family: Arial, Helvetica, sans-serif !important;font-weight:300 !important;" size="2">
		    <center><span style="font-family: Arial, Helvetica, sans-serif !important;font-weight:600 !important;">Thank You for Shopping with us.<br/>Regards : Agarwal Stores</span></center><br/>
		</div>
		<br/>
		<button type="submit" class="button" onclick="printDiv('print-content')">Print Bill</button>
	    <button type="submit" class="button" onclick="redirect()" >Update Invoice</button>
	    <br/><br/>
	</body>
</html>
<?php 
function digits_to_words($number)
{
	$no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';if($point==0)
  return $result . "Rupees Zero Paise Only";
  else
  return $result . "Rupees  " . $points . " Paise Only";
 }
?>
