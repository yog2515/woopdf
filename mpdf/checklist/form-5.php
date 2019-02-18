<?php
	ob_start();
	date_default_timezone_set("Asia/Kolkata");
	include_once("../../includes/connection_main.php");
	$dt=date("d/m/Y");
?>

<?php
	
	//$m=mysql_fetch_array(mysql_query("select * from month where month_name='$_POST[month]'"));
	$m=$_POST['month'];	
	if($m=='January'){$month='01';}
	else if($m=='February'){$month='02';}	
	else if($m=='March'){$month='03';}
	else if($m=='April'){$month='04';}
	else if($m=='May'){$month='05';}
	else if($m=='June'){$month='06';}
	else if($m=='July'){$month='07';}
	else if($m=='August'){$month='08';}
	else if($m=='September'){$month='09';}
	else if($m=='October'){$month='10';}
	else if($m=='November'){$month='11';}
	else if($m=='December'){$month='12';}
	 
	$year=$_POST['year'];
	$dat=$year.$m;	
	$ym=$year.$month;
	
	$grno=$_REQUEST['group_no'];
		
	/*$companyname='rk';
	
	$arr = explode(' ',trim($companyname));
	$company=$arr[0];
	$company1=$arr[1]; 
	$company1=substr($company1,0,2);	
	$tablename="pfw_".$company."_".$company1;;*/
	$brc_main=$_SESSION['b_name'];
	
	$cid=$_SESSION['c_id'];

	if($grno!='')
	{
		
	}
	$x=mysql_fetch_array(mysql_query("select * from new_company where id='$cid'"));
	$cnm=$x['c_name'];
	$state=$x['state'];
	$corp=$x['corp_name'];
		
	/*$arr = explode(' ',trim($cnm));
	$company=$arr[0];
	$company1=$arr[1]; 
	$company1=substr($company1,0,2);*/	
	$company=$_SESSION['company'];;
	$tablename="pfw"."_".$company;
	
/**************************************************************************************************************************/
	
	$rr=mysql_fetch_array(mysql_query("SELECT * FROM pt_master a INNER JOIN new_company c on c.state=a.state INNER JOIN pt_range r on a.id=r.pt_id where c.state='$state' AND c.BRC_NAME='$brc_main'"));
	
	$pt_id=$rr['pt_id'];
	
/**************************************************************************************************************************/	
	
	
	//$sql=mysql_query("select * from pt_range where pt_id='17'");
	
	$html.='<h1 align="center"><u>FORM-5</u></h1>
        <p align="center">Return of tax payable by employer under Sub-section (1) of Section 6 of the Gujarat<br>
state, Tax on Prfessions, Trades, Callings & Employment Act, 1976 (See Rule 11)</p><hr>';
	
	$html.='
    <table>
    	<tr>
        	<td>'.$corp.' REG. No.</td>
            <td>:</td>
            <td>PRC0402944</td>
        </tr>
        <tr>
        	<td>Return of tax payable for the month ending on</td>
            <td>:</td>
            <td>'.date('t/m/Y', strtotime($dat)).'</td>
        </tr>
    </table>
    <table>
			<tr>
				<td>Name of the Employer :</td>
				<td><b>'.$cnm.'</b></td>
			</tr>
			<tr>
				<td></td>
				<td><b>'.$x['c_address1'].'&nbsp;'.$x['c_address2'].'<br>'.$x['c_address3'].'</b></td>
			</tr>
	</table>     

<p>Details of employees during the month in respect of whom tax is payable are as under :<br>
I details for tax calculation for tax payable in respect of salaries for the month ending on &nbsp;'.date('t/m/Y', strtotime($dat)).'</p>';
	
	$html.='
	<table border="1" style="font-size:12px">
     	<tr class="a">
        	<td>Employees whose monthly salaries or wages are</td>
            <td>No. of employees</td>
            <td>Number of employees for whom no tax is payable under provison to section 4</td>
            <td>Number of employees in respect of whom tax is payable (i.e. col.2-col.3)</td>
            <td>Rate of tax per month per employees</td>
            <td>Amount of tax deducted</td>
        </tr>
        <tr class="a">
        	<td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
        </tr>
			';
	 		$x1=mysql_query("select * from pt_range where pt_id='$pt_id'");
			 
			$totalA=0;
			while($row=mysql_fetch_array($x1))
			{
				if($row['start_range']!='')
				{					
					$st=$row['start_range'];
					$ed=$row['end_range'];
					if($ed!=='')
					{
						$y=mysql_query("SELECT COUNT(*) FROM $tablename a INNER JOIN pt_range b ON a.DEDH3=b.pt_rate where MOWN='$ym' and a.FIXAMT>='$st' and a.FIXAMT<='$ed' and b.pt_id='$pt_id'");													
											 
					}
					else
					{
						$y=mysql_query("SELECT COUNT(*) FROM $tablename a INNER JOIN pt_range b ON a.DEDH3=b.pt_rate where MOWN='$ym' and a.FIXAMT>='$st' and b.pt_id='$pt_id'");
												 					 		 												
					}
						echo "SELECT COUNT(*) FROM $tablename a INNER JOIN pt_range b ON a.DEDH3=b.pt_rate where MOWN='$ym' and a.FIXAMT>='$st' and b.pt_id='$pt_id'";
						//exit();				
					$num_row=mysql_result($y,0);
					//$num_row=mysql_num_rows($y);
					
				$html.='
						<tr style="text-align:center" class="a">
							<td>'.$row['start_range'].'&nbsp;to&nbsp;'.$row['end_range'].'</td>
							<td>'.$num_row.'</td>
							<td></td>
							<td>'.$num_row.'</td>
							<td>'.$row['pt_rate'].'</td>
							<td>'.($num_row*$row['pt_rate']).'</td>
        				</tr>
						';
						$totalA=$totalA+($num_row*$row['pt_rate']);
				}
			}
				 
		$html.='<tr>
        	<td colspan="5">Rs.in word :&nbsp;&nbsp;<b>'.getIndianCurrency($totalA).'</b> <span style="float:right">Total A Rs.</span></td>
            <td align="center"><b>'.$totalA.'</b></td>
        </tr>
     </table>
				
				<p>II Details of employees in respect of whom tax is payable at the enhanced rate for previous period on account of arrears salaries or wages paid during the month.</p>
				
				<table border="1" style="font-size:12px" class="a">
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
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>4</td>
						<td>5</td>
						<td>6</td>
					</tr>	
					<tr>
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
				</table>';
				 
				 $ttl=$totalA+$tatalB;
				 
				$html.=' 
				<p>Total Tax payable i.e. TOTAL A + B =    Rs.<u><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$ttl.'&nbsp;&nbsp;&nbsp;&nbsp;</b></u></p>
									
				<p>Add simple interest payable (if any) on the above amount at *[one and a half percent]<br> per monthe or part there of (vice section 9(2) of the Act.)</p>
				
				<p>Total Tax and Interest Payable     Rs.__________________ </p> 
				
				<p>Amount Paid by Receipt No. : _____________________ Dated : _______________</p>
				
				<p>I certify that all the employees who are liable to pay the tax in my employee during the period of return have been covered by the
foregoing particulars. I also certify that the necessary revision in the amount of the tax deductable from the salary or wages of the
employees on account of variation in the salary or wages by them has been made where necessary.</p>				

				<p>I shri <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.strtoupper($x['owner_name']).'<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> solemnly declare that the above statements are true to the best of my knowledge and belief.</p>
				 
				 
				';
				$html.='<table width="100%">
     	<tr>
        	<td class="lf" width="80%">PLACES:</td>
            <td>For,&nbsp;'.$cnm.'</td>
        </tr>
         <tr>
         	<td>&nbsp;</td>
         	<td></td>
         </tr>
        <tr>
        	<td>DATE:</td>
            <td></td>
        </tr>
        <tr>
        	<td></td>
            <td>PARTNER</td>
        </tr>
     </table>
';
?>

<?php

	$html.='</div></body></html>';       				
			
            include("../mpdf.php");
           	$mpdf=new mPDF('c','A4',0,0,10,10,5,0,0);
			$mpdf->SetHeader($hed);
		   	//$mpdf=new mPDF('c',array(400,350));
            //$stylesheet = file_get_contents('../pdf_style.css');
			//$stylesheet = file_get_contents('style.css');
			$stylesheet = file_get_contents('style.css');
            $mpdf->WriteHTML($stylesheet,1);
			
            //$mpdf->SetDefaultBodyCSS('color', '#880000');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
	
	ob_end_flush();
?>

<?php
function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
   
		return strtoupper($Rupees ? $Rupees . 'ONLY ' : '');	

		
}
?>
 