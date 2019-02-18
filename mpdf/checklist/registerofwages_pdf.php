<?php
	ob_start();
	date_default_timezone_set("Asia/Kolkata");
	include_once("../../includes/connection_main.php");
	$dt=date("d/m/Y");
?>

<?php
	$sql=mysql_fetch_array(mysql_query("select * from new_company where c_name='w3nuts'"));
	
	$cnm=$sql['c_name'];
	$hed.='
			<h3 align="center">REGISTER OF WAGES</h3>
   			<p align="center">FORM NO IV - [MINIMUM WAGES ACT]</p>
    
    <table width="100%" style="font-size:12px" class="tbl">
    	<tr>
        	<td width="42%">
            	<table width="100%">
                	<tr>
                    	<td width="23%">NAME:</td>
                        <td width="77%"><b>'.strtoupper($sql['c_name']).'</b></td>
                    </tr>
                    <tr>
                    	<td>ADDRESS:</td>
                        <td><b>'.$sql['c_address'].'</b></td>
                    </tr>
                    <tr><td> </td></tr>
                    <tr><td> </td></tr>
                    <tr><td> </td></tr>                   
                </table>
            </td>
            <td width="34%">
            	<table width="100%">
                	<tr>
                    	<td width="21%">Group</td>
                        <td width="79%"></td>
                    </tr>
                    <tr>
                    	<td>DEPT.</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td width="24%">
            	<table width="100%">
                	<tr>
                    	<td>MONTH :</td>
                        <td><b>'.date('M-Y').'</b></td>
                    </tr>
                    <tr>
                        <td>PP CODE :</td>
                      	<td>'.$sql['pin_no'].'</td>
                    </tr>
                    <tr>
                        <td>ESI CODE :</td>
                        <td><b>E.S.I Not Applicable</b></td>
                    </tr>
                    <tr>
                        <td>PAGE NO :</td>
                        <td><b>{PAGENO}</b></td>
                    </tr>
                    <tr>
                        <td>DATE OF PAYMENT :</td>                        
                        <td><b>07-'.date('M-Y').'</b></td>                    
                    </tr>
                </table>
            </td>
        </tr>	
    </table>';   
 
 	$html.='<html><body>
	<table border="1" style="font-size:12px class="tbl"">
    	<tr>
        	<td rowspan="3">Sr. No</td>
            <td rowspan="3">NAME OF EMPLOYEE<br>Emp No.&nbsp;&nbsp;&nbsp;UAN No</td>                          	
            <td rowspan="2">Working Day</td>
            <td colspan="3">SALARY PER MONTH</td>
            <td rowspan="3">OVER TIME AMT. HOUR</td>
            <td colspan="10">ALLOWANCES PER MONTH DEDUCTIONS PER MONTH</td>
            <td>GROSS EARNING</td>
            <td rowspan="3">NET AMOUNT PAYABLE</td>
            <td rowspan="3">SIGNATURE OR THUMB IMPRESSION OF EMPLOYEE</td>             
        </tr>        
        <tr>        	 
            <td rowspan="2">ACTUAL SALARY</td>
            <td rowspan="2">BASIC + DA</td>
            <td rowspan="2">SALARY AMOUNT</td>
            <td>H.R.A</td>
            <td>CONV.</td>
            <td>MEDICAL</td>
            <td>INCENT</td>
            <td>FOOD</td>
            <td>ALL.-1</td>
            <td>ALL.-2</td>
            <td>ALL.-3</td>
            <td>SP. A.</td>
            <td>BONUS</td>   
            <td rowspan="2">TOTAL DEDUCTION</td>         
        </tr>
         <tr>
        	<td>Leave day</td>
            <td>P.F</td>
            <td>E.S.I</td>
            <td>P.T</td>
            <td>I.T</td>
            <td>L.W.F.</td>
            <td>AB.DED.</td>
            <td>LOAN</td>
            <td>DEDU.-1</td>
            <td>DEDU.-2</td>
            <td>DEDU.-3</td>           
        </tr>
        <tr>
        	<td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td>15</td>
            <td>16</td>
            <td>17</td>
            <td>18</td>
            <td>19</td>
            <td>20</td>
        </tr>';
		
		 
		 
			$cnt='1';
			$sql=mysql_query("select * from pfw_rk_ where MOWN='201505'");
			$male='0';
			$female='0';
			$dayop='0';
			$fixamt='0';
			$hra='0';
			$pt='0';
			$grossearning='0';
			$netamt='0';
			$prsM='0';
			$prsF='0';
			$wageM='0';
			$wageF='0';
			 
			while($row=mysql_fetch_array($sql))
			{
				 
                	$html.='
                	<tr>
                    	<td rowspan="2">'.$cnt.'</td>
                        <td rowspan="2">'.$row['EMP_NAME'].'<br>'.$row['EN'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td rowspan="2">'.$row['DAYOP'].'</td>
                        <td rowspan="2">'.$row['FIXAMT'].'</td>
                        <td rowspan="2"></td>
                        <td rowspan="2">'.$row['FIXAMT'].'</td>
                        <td rowspan="2"></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>   
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>'.$row['FIXAMT'].'</td>
                        <td rowspan="2">'.$row['NETAMT'].'</td>
                        <td rowspan="2">'.$row['SBAC'].'<br>'.$row['BKNM'].'<br>'.$row['BKA1'].'</td>                     
                    </tr>
                    <tr>
                    	<td>0</td>
                        <td>0</td>
                        <td>'.$row['DEDH3'].'</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>'.$row['DGROSS'].'</td>
                    </tr>';    
					
					$dayop=$dayop+$row['DAYOP'];
					$fixamt=$fixamt+$row['FIXAMT'];
					$hra=$hra+$row[''];
					$pt=$pt+$row['DEDH3'];
					$grossearning=$grossearning+$row['FIXAMT'];
					$netamt=$netamt+$row['NETAMT'];					
					
					if($row["SEX"]=="M")            
					{
						$prsM=$prsM+$row['DAYOP'];
						$wageM=$wageM+$row['NETAMT'];
						$male++;
					}
					else if($row['SEX']=='F')
					{
						$prsF=$prsF+$row['DAYOP'];
						$wageF=$wageF+$row['NETAMT'];
						$female++;
					}
				$cnt++;
			}
			$html.='  
				<tr class="aa">
					<td></td>
					<td>GRAND TOTAL>></td>
					<td>'.$dayop.'</td>
					<td></td>
					<td></td>
					<td>'.$fixamt.'</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>0<br>'.$pt.'</td>
					<td>11</td>
					<td>12</td>
					<td>13</td>
					<td>14</td>
					<td>15</td>
					<td>16</td>
					<td>17</td>
					<td>'.$grossearning.' <br> '.$pt.' </td>
					<td>'.$netamt.'</td>
					<td> </td>
				</tr>
    </table> 	
			';
			
			$html.='<b>Male</b>: '.$male.'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pre.: '.$prsM.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Wage: '.$wageM.' <br><b>Female</b>: '.$female.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pre.: '.$prsF.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Wage: '.$wageF.'
			
			<div align="right">
				for, '.strtoupper($cnm).'
				  <br><br>
				  PARTNER
			</div>';
?>
<?php
 include("../mpdf.php");
           	$mpdf=new mPDF('c','A4-L');
		//	$mpdf->SetHeader($hed);
		   	//$mpdf=new mPDF('c',array(400,350));
            //$stylesheet = file_get_contents('../pdf_style.css');
		 	$stylesheet = file_get_contents('style.css');
			$mpdf->SetHTMLHeader($hed);
			$mpdf->AddPage('','','','','',5,5,45,30,0,0);
            $mpdf->WriteHTML($stylesheet,1); 			 
			
            //$mpdf->SetDefaultBodyCSS('color', '#880000');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
	
	ob_end_flush();
?>