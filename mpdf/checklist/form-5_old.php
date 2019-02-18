<?php
	ob_start();
	date_default_timezone_set("Asia/Kolkata");
	include_once("../../includes/connection_main.php");
	$dt=date("d/m/Y");
?>

<?php
 	$companyname='rk';
	//$c_id=$_SESSION['c_id'];
	
	//$x=mysql_fetch_array(mysql_query("select * from new_company where id='$c_id'"));
	
//	$companyname=$x['c_name'];
	
	$arr = explode(' ',trim($companyname));
	$company=$arr[0];
	$company1=$arr[1]; 
	$company1=substr($company1,0,2);	
	$tablename="pfw_".$company."_".$company1;;

	$x=mysql_fetch_array(mysql_query("select * from new_company where c_name='$companyname'"));
	$sql=mysql_query("select * from pt_range");
	
	$hed.='<html><body><h2 align="center" style="margin-top:0px"><u>FORM -5</u></h2>
			<p align="center" style="font-size:12px">Return of tax payable by employer under Sub-section (1) of Section 6 of the 								Gujarat<br>
state, Tax on Prfessions, Trades, Callings & Employment Act, 1976 (See Rule 11)</p>';
	
	$html.='<br><br><br>		
			<table>
				<tr>
					<td colspan="2">RAJKOT MUNICIPAL CORPORATION REGD. NO. :PRC0402944</td>
				</tr>
				<tr>
					<td colspan="2">Return of tax payable for the month ending on : 31/'.date('m/Y').'</td>
				</tr>
				<tr>
					<td>Name of the Employer :</td>
					<td style="font-size:12px"><b>'.strtoupper($x['c_name']).'<br>'.$x['c_address'].'</b>
						</td>
				</tr>
			</table>
			
			<p style="font-size:12px">Details of employees during the month in respect of whom tax is payable are as under :<br>
I details for tax calculation for tax payable in respect of salaries for the month ending on <u> 31/'.date('m/Y').'</u></p>

			<table border="1" style="font-size:12px">
				<tr>
					<td align="center">Employees whose monthly salaries or wages are</td>
					<td align="center">No. of employees</td>
					<td align="center">Number of employees for whom no tax is payable under provison to section 4</td>
					<td align="center">Number of employees in respect of whom tax is payable (i.e. col.2-col.3)</td>
					<td align="center">Rate of tax per month per employees</td>
					<td align="center">Amount of tax deducted</td>
				</tr>
				<tr>
					<td align="center">1</td>
					<td align="center">2</td>
					<td align="center">3</td>
					<td align="center">4</td>
					<td align="center">5</td>
					<td align="center">6</td>
				</tr>
				';
				$ttl='';
				while($row=mysql_fetch_array($sql))
				{					
					$ptr=$row['pt_rate'];
					$s=mysql_query("select COUNT(*) from $tablename where MOWN='201505' AND DEDH3='$ptr'");																													
						$total=0;
						if($s)
						{
							$total=mysql_result($s,0);
							$ttl=$ttl+($ptr*$total);
						}
					$html.='
					<tr>
						<td align="center">Rs. '.$row['start_range'].'to'.$row['end_range'].'</td>
						<td>'.$total.'</td>
						<td></td>
						<td>'.$total.'</td>
						<td align="right">'.$row['pt_rate'].'</td>
						<td align="right">'.($ptr*$total).'</td>						
					</tr>				
							';
					
				}
		$html.='<tr>
					<td colspan="5">Rs.in word :<p>Total A Rs.</p></td>
					<td align="right"><b>'.$ttl.'</b></td>
				</tr>	
				</table>
				
				<p style="font-size:12px">II Details of employees in respect of whom tax is payable at the enhanced rate for previous period on account of arrears salaries or wages paid during the month.</p>
				
				<table border="1" style="font-size:12px">
					<tr>
						<td rowspan="2">Number of employees liable to tax at enhanced rate to be shown separately according to column 4 and column 5</td>
						<td colspan="2" align="center">RATE OF TAX</td>		
						<td rowspan="2">Difference of Rate (Col. 2 minus Col. 3)</td>					 
						<td rowspan="2">No. of month for which arrears is paid col. 5)</td>
						<td rowspan="2">Additional tax payable (Col. 1 and col 4.)</td>
					</tr>
					<tr>
						<td>payable on account of arrears salaries and wages</td>
						<td>salaries and wages was paid</td>												 
					</tr>		
					<tr>
						<td align="center">1</td>
						<td align="center">2</td>
						<td align="center">3</td>
						<td align="center">4</td>
						<td align="center">5</td>
						<td align="center">6</td>
					</tr>	
					<tr >
						<td><br><br><br><br></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>						 
						<td colspan="2" align="center">Total B Rs....................................</td>
					</tr>		 					 
				</table>
				 
				<p>Total Tax payable i.e. TOTAL A + B =    Rs.<u><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$ttl.'&nbsp;&nbsp;&nbsp;&nbsp;</b></u></p>
									
				<p style="font-size:12px">Add simple interest payable (if any) on the above amount at *[one and a half percent]<br> per monthe or part there of (vice section 9(2) of the Act.)</p>
				
				<p>Total Tax and Interest Payable     Rs.__________________ </p> 
				
				<p>Amount Paid by Receipt No. : _____________________ Dated : _______________</p>
				
				<p style="font-size:12px">I certify that all the employees who are liable to pay the tax in my employee during the period of return have been covered by the
foregoing particulars. I also certify that the necessary revision in the amount of the tax deductable from the salary or wages of the
employees on account of variation in the salary or wages by them has been made where necessary.</p>				

				<p>I shri <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($x['owner_name']).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> solemnly declare that the above statements are true to the best of my knowledge and belief.</p>
				 
				 
				';
?>

<?php

	$html.='</div></body></html>';       				
			
            include("../mpdf.php");
           	$mpdf=new mPDF('c','A4');
			$mpdf->SetHeader($hed);
		   	//$mpdf=new mPDF('c',array(400,350));
            //$stylesheet = file_get_contents('../pdf_style.css');
			$stylesheet = file_get_contents('style.css');
            $mpdf->WriteHTML($stylesheet,1);
			
            //$mpdf->SetDefaultBodyCSS('color', '#880000');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
	
	ob_end_flush();
?>