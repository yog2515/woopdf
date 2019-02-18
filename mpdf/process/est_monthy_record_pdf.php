<?php	 
	date_default_timezone_set("Asia/Calcutta");
	include_once("../../includes/connection_main.php");	 
	ob_start();
	
	//$to=$_POST['to_year'].date('m',strtotime($_POST['to_month']));
	//$frm=$_POST['frm_year'].date('m',strtotime($_POST['frm_month']));
	$year=$_REQUEST['frm_yr'];
	$n_year=$year+1;
	$to=$_REQUEST['to_year'];
	$frm=$_REQUEST['frm_year'];
	
	$frm_dt='APR-'.$year;
	$to_dt='MAR-'.$n_year;
	echo $frm.'<br>'.$to ;
	$x=mysql_fetch_array(mysql_query("select * from new_company where id='$_SESSION[c_id]'"));
	
	$company=$_SESSION['company'];
	$tablename="PFMER_".$company;
	$sql=("select * from $tablename ORDER BY NYYMM ASC");
	echo $sql;
?>
<?php
	$head.='<h3 align="center">EMPLOYEE WAGES STATEMENT FROM '.$frm_dt.' TO '.$to_dt.'</h3>
		<table width="100%">
			<tr>
				<td width="68%">
					<table width="75%">
						<tr>
							<td width="18%">EST NAME</td>
							<td width="2%">:</td>
							<td width="80%">'.$x['c_name'].'</td>
						</tr>
						<tr>
							<td>EST CITY</td>
							<td>:</td>
							<td>'.$x['city'].'</td>
						</tr>
					</table>
				</td>
				<td width="32%">
					<table width="100%">
						<tr>
							<td width="26%">EST CODE</td>
							<td width="6%">:</td>
							<td width="68%">'.$x['pf_code'].'</td>
						</tr>
						<tr>
							<td>PAGE NO</td>
							<td>:</td>
							<td>{PAGENO}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<hr>
	';
	$html.='
			<table class="SP fnt">
				<tr>
					<th>MONTH</th>
					<th>PF</th>
					<th>NPF</th>
					<th>ESI</th>
					<th>NESI</th>
					<th>PT</th>
					<th>NPT</th>
					<th>TOT</th>
					<th>FIX</th>
					<th>DAI</th>
					<th>GR=0</th>
					<th>GR!=0</th>
					<th>NET=0</th>
					<th>NET!=0</th>					 					
					<th>PRE</th>
					<th>ABS</th>
					<th>T_DAY</th>
				</tr>
				<tr>
					<td colspan="17">&nbsp;</td>
				</tr>';
				$i=4;			 
				for($j=1;$j<=12;$j++)
				{					
					$xx=mysql_fetch_array(mysql_query("select * from month where month_no='$i'"));
					$mnt=strtoupper(date('M',strtotime($xx['month_name']))).'-'.$year; 
					$row=mysql_fetch_array(mysql_query("select * from $tablename where CM='$mnt'"));					 
				$html.='
				
				<tr>
					<td>'.$mnt.'</td>';
					if($row['CM']==$mnt)
					{ 
					$html.='
					<td>'.$row['SUBPF'].'</td>
					<td>'.$row['SUBNPF'].'</td>
					<td>'.$row['SUBESI'].'</td>
					<td>'.$row['SUBNESI'].'</td>
					<td>'.$row['SUBPT'].'</td>
					<td>'.$row['SUBNPT'].'</td>
					<td>'.$row['SUBTOT'].'</td>
					<td>'.$row['SUBFIX'].'</td>
					<td>'.$row['SUBDAI'].'</td>
					<td>'.$row['SUBGZ'].'</td>
					<td>'.$row['SUBGNZ'].'</td>
					<td>'.$row['SUBNZ'].'</td>
					<td>'.$row['SUBNNZ'].'</td>					 
					<td>'.$row['DAYOP'].'</td>
					<td>'.$row['DAYOA'].'</td>
					<td>'.$row['TDAYOP'].'</td>					 			 
					
				</tr>';
					$SUBPF+=$row['SUBPF'];
					$SUBNPF+=$row['SUBNPF'];
					$SUBESI+=$row['SUBESI'];
					$SUBNESI+=$row['SUBNESI'];
					$SUBPT+=$row['SUBPT'];
					$SUBNPT+=$row['SUBNPT'];
					$SUBTOT+=$row['SUBTOT'];
					$SUBFIX+=$row['SUBFIX'];
					$SUBDAI+=$row['SUBDAI'];
					$SUBGZ+=$row['SUBGZ'];
					$SUBGNZ+=$row['SUBGNZ'];
					$SUBNZ+=$row['SUBNZ'];
					$SUBNNZ+=$row['SUBNNZ'];
					$DAYOP+=$row['DAYOP'];
					$DAYOA+=$row['DAYOA'];
					$TDAYOP+=$row['TDAYOP'];
				 }	
				 else
				 {
					 $html.='
					 	<td colspan="16">&nbsp;</td>
					 ';
				 }
					 if($i>='12')
					 { 
						$i=0;
						$year++;
					 }					 
					 if($i=='3')
					 {
						 $year=$year-1;
						 break;
					 } 
					$i++;	 
				}
				$html.='
				<tr>
					<td colspan="17">&nbsp;</td>
				</tr>
				<tr>
					<td>TOTAL</td>	
					<td>'.$SUBPF.'</td>						
					<td>'.$SUBNPF.'</td>	
					<td>'.$SUBESI.'</td>	
					<td>'.$SUBNESI.'</td>	
					<td>'.$SUBPT.'</td>	
					<td>'.$SUBNPT.'</td>
					<td>'.$SUBTOT.'</td>
					<td>'.$SUBFIX.'</td>
					<td>'.$SUBDAI.'</td>
					<td>'.$SUBGZ.'</td>
					<td>'.$SUBGNZ.'</td>
					<td>'.$SUBNZ.'</td>
					<td>'.$SUBNNZ.'</td>
					<td align="right">'.number_format((float)$DAYOP,'2','.','').'</td>
					<td align="right">'.number_format((float)$DAYOA,'2','.','').'</td>
					<td align="right">'.number_format((float)$TDAYOP,'2','.','').'</td>					
				</tr>
			</table>
			<hr><br><br>';
			$html.='
			<table class="SP fnt">
				<tr>
					<th>MONTH</th>
					<th>M</th>
					<th>F</th>
					<th>PR_M</th>
					<th>PR_F</th>
					<th>AB_M</th>
					<th>AB_F</th>
					<th>T_PR_M</th>
					<th>T_PR_F</th>
					<th>WD</th>
					<th>GROSS</th>
					<th>GR_M</th>
					<th>GR_F</th>
					<th>NETAMT</th>					 					
					<th>NETAMTM</th>
					<th>NETAMTF</th>
					<th></th>
				</tr>
				<tr>
					<td colspan="16">&nbsp;</td>
				</tr>';
				$i=4;			 
				for($j=1;$j<=12;$j++)
				{					
					$xx=mysql_fetch_array(mysql_query("select * from month where month_no='$i'"));
					$mnt=strtoupper(date('M',strtotime($xx['month_name']))).'-'.$year; 
					$r=mysql_fetch_array(mysql_query("select * from $tablename where CM='$mnt'"));					 
				$html.='
				<tr>
					<td>'.$mnt.'</td>';
					if($r['CM']==$mnt)
					{ 
					$html.='
					<td>'.$r['SUBM'].'</td>
					<td>'.$r['SUBF'].'</td>
					<td align="right">'.$r['DAYOPM'].'</td>
					<td align="right">'.$r['DAYOPF'].'</td>
					<td align="right">'.$r['DAYOAM'].'</td>
					<td align="right">'.$r['DAYOAF'].'</td>
					<td align="right">'.$r['TDAYOPM'].'</td>
					<td align="right">'.$r['TDAYOPF'].'</td>
					<td align="right">'.$r['WDAY'].'</td>
					<td align="right">'.$r['GROSS'].'</td>
					<td align="right">'.$r['GROSSM'].'</td>
					<td align="right">'.$r['GROSSF'].'</td>
					<td align="right">'.$r['NETAMT'].'</td>
					<td align="right">'.$r['NETAMTM'].'</td>
					<td align="right">'.$r['NETAMTF'].'</td>
				</tr>';
					$SUBM+=$r['SUBM'];
					$SUBF+=$r['SUBF'];
					$DAYOPM+=$r['DAYOPM'];
					$DAYOPF+=$r['DAYOPF'];
					$DAYOAM+=$r['DAYOAM'];
					$DAYOAF+=$r['DAYOAF'];
					$TDAYOPM+=$r['TDAYOPM'];
					$TDAYOPF+=$r['TDAYOPF'];
					$WDAY+=$r['WDAY'];
					$GROSS+=$r['GROSS'];
					$GROSSM+=$r['GROSSM'];
					$GROSSF+=$r['GROSSF'];
					$NETAMT+=$r['NETAMT'];
					$NETAMTM+=$r['NETAMTM'];
					$NETAMTF+=$r['NETAMTF'];										
				}				 
				 else
				 {
					 $html.='
					 	<td colspan="16">&nbsp;</td>
					 ';
				 }
					 if($i>='12')
					 { 
						$i=0;
						$year++;
					 }					 
					 if($i=='3')
					 {
						 $year--;
						 break;
					 } 
					$i++;	 
				}
				$html.='
				<tr>
					<td colspan="16">&nbsp;</td>
				</tr>
				<tr>
					<td>TOTAL</td>
					<td>'.$SUBM.'</td>
					<td>'.$SUBF.'</td>
					<td>'.number_format((float)$DAYOPM,'2','.','').'</td>
					<td>'.number_format((float)$DAYOPF,'2','.','').'</td>
					<td>'.number_format((float)$DAYOAM,'2','.','').'</td>
					<td>'.number_format((float)$DAYOAF,'2','.','').'</td>
					<td>'.number_format((float)$TDAYOPM,'2','.','').'</td>
					<td>'.number_format((float)$TDAYOPF,'2','.','').'</td>
					<td>'.number_format((float)$WDAY,'2','.','').'</td>
					<td>'.number_format((float)$GROSS,'2','.','').'</td>
					<td align="right">'.number_format((float)$GROSSM,'2','.','').'</td>
					<td align="right">'.number_format((float)$GROSSF,'2','.','').'</td>
					<td align="right">'.number_format((float)$NETAMT,'2','.','').'</td>
					<td align="right">'.number_format((float)$NETAMTM,'2','.','').'</td>
					<td align="right">'.number_format((float)$NETAMTF,'2','.','').'</td>
				</tr>
			</table>
			<hr><br><br>
			';
			$html.='
			<table class="SP fnt">
				<tr>
					<th>MONTH</th>
					<th>H.R.A.</th>
					<th>PTA</th>
					<th>TRAVA</th>
					<th>CHIEA</th>
					<th>MEDIA</th>
					<th>OA</th>
					<th>MISCA</th>
					<th>MISCA1</th>
					<th>MISCA2</th>
					<th>MISCA3</th>
					<th>PFGR</th>
					<th>NPFGR</th>
					<th>PFGROSS</th>					 					
					<th>OTGROSS</th>
					<th>OGROSS</th>
				</tr>
				<tr>
					<td colspan="16">&nbsp;</td>
				</tr>';
				$i=4;			 
				for($j=1;$j<=12;$j++)
				{					
					$xx=mysql_fetch_array(mysql_query("select * from month where month_no='$i'"));
					$mnt=strtoupper(date('M',strtotime($xx['month_name']))).'-'.$year; 
					$r=mysql_fetch_array(mysql_query("select * from $tablename where CM='$mnt'"));					 
				$html.='
				<tr>
					<td>'.$mnt.'</td>';
					if($r['CM']==$mnt)
					{ 
					$html.='
					<td>'.$r['HRA'].'</td>
					<td>'.$r['PTA'].'</td>
					<td>'.$r['TRAVA'].'</td>
					<td>'.$r['CHIEA'].'</td>
					<td>'.$r['MEDIA'].'</td>
					<td>'.$r['MISCA'].'</td>
					<td>'.$r['MISCA1'].'</td>
					<td>'.$r['MISCA2'].'</td>
					<td>'.$r['MISCA3'].'</td>
					<td>'.$r['PFGR'].'</td>
					<td>'.$r['NPFGR'].'</td>
					<td>'.$r['PFGROSS'].'</td>
					<td>'.$r['OTGROSS'].'</td>
					<td>'.$r['OGROSS'].'</td>
				</tr>
					';
					$HRA+=$r['HRA'];
					$PT+=$r['PTA'];
					$TRAVA+=$r['TRAVA'];
					$CHIEA+=$r['CHIEA'];
					$MEDIA+=$r['MEDIA'];
					$MISCA+=$r['MISCA'];
					$MISCA1+=$r['MISCA1'];
					$MISCA2+=$r['MISCA2'];
					$MISCA3+=$r['MISCA3'];
					$PFGR+=$r['PFGR'];
					$NPFGR+=$r['NPFGR'];
					$PFGROSS+=$r['PFGROSS'];
					$OTGROSS+=$r['OTGROSS'];
					$OGROSS+=$r['OGROSS'];
				}			 
				 else
				 {
					 $html.='
					 	<td colspan="16">&nbsp;</td>
					 ';
				 }
					 if($i>='12')
					 { 
						$i=0;
						$year++;
					 }					 
					 if($i=='3')
					 {
						 $year--;
						 break;
					 } 
					$i++;	 
				}
				$html.='
				<tr>
					<td colspan="16">&nbsp;</td>
				</tr>
				<tr>
					<td>TOTAL</td>
					<td>'.$HRA.'</td>
					<td>'.$PT.'</td>
					<td>'.$TRAVA.'</td>
					<td>'.$CHIEA.'</td>
					<td>'.$MEDIA.'</td>
					<td>'.$MISCA.'</td>
					<td>'.$MISCA1.'</td>
					<td>'.$MISCA2.'</td>
					<td>'.$MISCA3.'</td>
					<td>'.$PFGR.'</td>
					<td>'.$NPFGR.'</td>
					<td>'.$PFGROSS.'</td>
					<td>'.$OTGROSS.'</td>
					<td>'.$OGROSS.'</td>					
				</tr>
				</table>
				<hr> 
				';
				$html.='
				<br><br><table class="SP fnt">
					<tr>
						<th>MONTH</th>
						<th>PFD</th>
						<th>ESID</th>
						<th>PTD</th>
						<th>ITD</th>
						<th>ADVD</th>
						<th>LOAND</th>
						<th>GLWF</th>
						<th>MISCD</th>
						<th>MISCD1</th>
						<th>MISCD2</th>
						<th>DGROSS</th>
						<th> </th>
						<th> </th>					 					
						<th> </th>
						<th> </th>
					</tr>
					<tr>
						<td colspan="15"></td>
					</tr>
					';
					$i=4;			 
					for($j=1;$j<=12;$j++)
					{					
						$xx=mysql_fetch_array(mysql_query("select * from month where month_no='$i'"));
						$mnt=strtoupper(date('M',strtotime($xx['month_name']))).'-'.$year; 
						$r=mysql_fetch_array(mysql_query("select * from $tablename where CM='$mnt'"));					 
					$html.='
					<tr>
						<td>'.$mnt.'</td>';
						if($r['CM']==$mnt)
						{ 
						$html.='
						<td>'.$r['PFD'].'</td>
						<td>'.$r['ESID'].'</td>
						<td>'.$r['PTD'].'</td>
						<td>'.$r['ITD'].'</td>
						<td>'.$r['ADVD'].'</td>
						<td>'.$r['LOAND'].'</td>
						<td>'.$r['GLWF'].'</td>
						<td>'.$r['MISCD'].'</td>
						<td>'.$r['MISCD1'].'</td>
						<td>'.$r['MISCD2'].'</td>
						<td>'.$r['DGROSS'].'</td>
					</tr>';
						$PFD+=$r['PFD'];
						$ESID+=$r['ESID'];
						$PTD+=$r['PTD'];
						$ITD+=$r['ITD'];
						$ADVD+=$r['ADVD'];
						$LOAND+=$r['LOAND'];
						$GLWF+=$r['GLWF'];
						$MISCD+=$r['MISCD'];
						$MISCD1+=$r['MISCD1'];
						$MISCD2+=$r['MISCD2'];
						$DGROSS+=$r['DGROSS'];
					}								 
					 else
					 {
						 $html.='
							<td colspan="16">&nbsp;</td>
						 ';
					 }
						 if($i>='12')
						 { 
							$i=0;
							$year++;
						 }					 
						 if($i=='3')
						 {
							 $year--;
							 break;
						 } 
						$i++;	 
					}
					$html.='					 
					<tr>
						<td>TOTAL</td>
						<td>'.$PFD.'</td>
						<td>'.$ESID.'</td>
						<td>'.$PTD.'</td>
						<td>'.$ITD.'</td>
						<td>'.$ADVD.'</td>
						<td>'.$LOAND.'</td>
						<td>'.$GLWF.'</td>
						<td>'.$MISCD.'</td>
						<td>'.$MISCD1.'</td>
						<td>'.$MISCD2.'</td>
						<td>'.$DGROSS.'</td>
					</tr>
					</table>
					<hr>
					';	
					$html.='
			<table class="SP fnt">
				<tr>
					<th>MONTH</th>
					<th>H.R.A.</th>
					<th>PTA</th>
					<th>TRAVA</th>
					<th>CHIEA</th>
					<th>MEDIA</th>
					<th>OA</th>
					<th>MISCA</th>
					<th>MISCA1</th>
					<th>MISCA2</th>
					<th>MISCA3</th>
					<th>PFGR</th>
					<th>NPFGR</th>
					<th>PFGROSS</th>					 					
					<th>OTGROSS</th>
					<th>OGROSS</th>
				</tr>
				<tr>
					<td colspan="16">&nbsp;</td>
				</tr>';
				$i=4;			 
				for($j=1;$j<=12;$j++)
				{					
					$xx=mysql_fetch_array(mysql_query("select * from month where month_no='$i'"));
					$mnt=strtoupper(date('M',strtotime($xx['month_name']))).'-'.$year; 
					$r=mysql_fetch_array(mysql_query("select * from $tablename where CM='$mnt'"));					 
				$html.='
				<tr>
					<td>'.$mnt.'</td>';
					if($r['CM']==$mnt)
					{ 
					$html.='
					<td>'.$r['HRA'].'</td>
					<td>'.$r['PTA'].'</td>
					<td>'.$r['TRAVA'].'</td>
					<td>'.$r['CHIEA'].'</td>
					<td>'.$r['MEDIA'].'</td>
					<td>'.$r['MISCA'].'</td>
					<td>'.$r['MISCA1'].'</td>
					<td>'.$r['MISCA2'].'</td>
					<td>'.$r['MISCA3'].'</td>
					<td>'.$r['PFGR'].'</td>
					<td>'.$r['NPFGR'].'</td>
					<td>'.$r['PFGROSS'].'</td>
					<td>'.$r['OTGROSS'].'</td>
					<td>'.$r['OGROSS'].'</td>
				</tr>
					';
					$HRA+=$r['HRA'];
					$PT+=$r['PTA'];
					$TRAVA+=$r['TRAVA'];
					$CHIEA+=$r['CHIEA'];
					$MEDIA+=$r['MEDIA'];
					$MISCA+=$r['MISCA'];
					$MISCA1+=$r['MISCA1'];
					$MISCA2+=$r['MISCA2'];
					$MISCA3+=$r['MISCA3'];
					$PFGR+=$r['PFGR'];
					$NPFGR+=$r['NPFGR'];
					$PFGROSS+=$r['PFGROSS'];
					$OTGROSS+=$r['OTGROSS'];
					$OGROSS+=$r['OGROSS'];
				}			 
				 else
				 {
					 $html.='
					 	<td colspan="16">&nbsp;</td>
					 ';
				 }
					 if($i>='12')
					 { 
						$i=0;
						$year++;
					 }					 
					 if($i=='3')
					 {
						 $year--;
						 break;
					 } 
					$i++;	 
				}
				$html.='
				<tr>
					<td colspan="16">&nbsp;</td>
				</tr>
				<tr>
					<td>TOTAL</td>
					<td>'.$HRA.'</td>
					<td>'.$PT.'</td>
					<td>'.$TRAVA.'</td>
					<td>'.$CHIEA.'</td>
					<td>'.$MEDIA.'</td>
					<td>'.$MISCA.'</td>
					<td>'.$MISCA1.'</td>
					<td>'.$MISCA2.'</td>
					<td>'.$MISCA3.'</td>
					<td>'.$PFGR.'</td>
					<td>'.$NPFGR.'</td>
					<td>'.$PFGROSS.'</td>
					<td>'.$OTGROSS.'</td>
					<td>'.$OGROSS.'</td>					
				</tr>
				</table>
				<hr> 
				';
				$html.='
				<br><br><table class="SP fnt">
					<tr>
						<th>MONTH</th>
						<th>GR_F</th>
						<th>GR_L</th>
						<th>GR_EE</th>						 
					</tr>
					<tr>
						<td colspan="15"></td>
					</tr>
					';
					$i=4;			 
					for($j=1;$j<=12;$j++)
					{					
						$xx=mysql_fetch_array(mysql_query("select * from month where month_no='$i'"));
						$mnt=strtoupper(date('M',strtotime($xx['month_name']))).'-'.$year; 
						$r=mysql_fetch_array(mysql_query("select * from $tablename where CM='$mnt'"));					 
					$html.='
					<tr>
						<td>'.$mnt.'</td>';
						if($r['CM']==$mnt)
						{ 
						$html.='
						<td>'.$r['GRNOF'].'</td>
						<td>'.$r['GRNOL'].'</td>
						<td>'.$r['GR_EE'].'</td>
						 
					</tr>';
						$PFD+=$r['PFD'];
						$ESID+=$r['ESID'];
						$PTD+=$r['PTD'];
						$ITD+=$r['ITD'];
						$ADVD+=$r['ADVD'];
						$LOAND+=$r['LOAND'];
						$GLWF+=$r['GLWF'];
						$MISCD+=$r['MISCD'];
						$MISCD1+=$r['MISCD1'];
						$MISCD2+=$r['MISCD2'];
						$DGROSS+=$r['DGROSS'];
					}								 
					 else
					 {
						 $html.='
							<td colspan="16">&nbsp;</td>
						 ';
					 }
						 if($i>='12')
						 { 
							$i=0;
							$year++;
						 }					 
						 if($i=='3')
						 {
							 $year--;
							 break;
						 } 
						$i++;	 
					}
					$html.='					 
					<tr>
						<td>TOTAL</td>						 
					</tr>
					</table>
					<hr>
					';								
?>	
<?php 
            include("../mpdf.php");
            $mpdf=new mPDF();
		 //  $mpdf = new mPDF('', '', 0, '', 15, 15, 15, 15, 8, 8);		    
            $stylesheet = file_get_contents('../pdf_style.css');
            $mpdf->SetHTMLHeader($head);
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->AddPage('','','','','',5,5,25,25,5,0); 
            //$mpdf->SetDefaultBodyCSS('color', '#880000');
			
			$mpdf->SetTitle('WAGE STATEMENT');
            
            $mpdf->WriteHTML($html);		 			
            $mpdf->Output();
			
			ob_end_flush();
     ?> 