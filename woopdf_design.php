<?php
echo $order->get_billing_first_name();
echo $order->get_billing_last_name();	
	$html='<html><head></head><body>';     				
	$html.='<table id="customers">
				<tr><th colspan="2"><strong>Customer Detail</strong></th></tr>
				<tr>
					<td>First Name</td>
					<td>'.$order->get_billing_first_name().''.$order->get_billing_last_name().'</td>
				</tr>';
	$html.='</table></body></html>';