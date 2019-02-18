<?php 
	ob_start();
	date_default_timezone_set("Asia/Calcutta");
	include_once("../../includes/connection_main.php");
	date_default_timezone_set('UTC');
	$dt=date("d/m/Y");
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head> 
 
            <body>
            <?php	
            $id=$_SESSION["c_id"];
            //$b_name=$_SESSION["b_name"];
			$b_name=$_SESSION["company"];
            $x=mysql_fetch_array(mysql_query("select * from branch_master where BRC_NAME='$b_name'"));	
            if($b_name!='')	
            {	
			
			$html1.='<table class="heading" style="width:100%;">
        <tr>
            <td style="width:70%;">
                <h2 class="heading">'.$x['BRCNM'].'</h2><br>
				<h4>Labour, P.F. & Factories Acts Consultant</h4>
                <p class="heading">
                    '.$x['BRCA1'].'&nbsp;'.$x['BRCA2'].'&nbsp;'.$x['BRCA3'].'
                </p>
            </td>
            <td rowspan="2" align="right">
                <table>
               		<tr><td>&nbsp;</td><td></td></tr>
                    <tr><td> Ph M:</td><td width="101">'.$x['MOB'].'</td></tr>
                    <tr><td>Off M:</td><td>'.$x['MOB1'].'</td></tr>
                    <tr><td>Mail:</td><td>'.$x['EMAIL'].'</td></tr>
                </table>
            </td>
        </tr>         
    </table> <hr>';					 
             
                 $html1.='	                          
                        <div align="right">Date:'.$dt.='</div> 
                        
                        <div align="center"><b>DOCUMENT REQUIRED FOR NEW PF REGD. NO </b><br><br></div>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; BUSSINESS : CONTRACTOR - PVT LTD FIRM <br><br>
                    <table>
                        ';
                        $x1=mysql_query("select * from pf_no_contracter_pvt_ltd");
                        $i=1;
                        while($row=mysql_fetch_array($x1))
                        {
                            $html1.='<tr>
                                        <td>'.$i.'&nbsp;&nbsp;&nbsp;</td><br>
                                        <td>'.$row['data'].'</td>
                                    </tr><br><br>';
                                    $i++;
                        }
                        $html1.='
                    </table>'; 		
                   $html1.='THANKING YOU <br> FOR &nbsp;'.$x['BRCNM'].'<br>';
                  
                           
                   $html1.='<br><hr></div>';
                   $x=mysql_query("select * from branch_master");
                   $html1.='<table style="font-size:12px">
                   <tr>
                                    <th></th>
                                    <th>ADDRESS</th>
                                    <th>Mob.</th>
                                    <th>E-mail</th>
                                </tr>';
                   while($r=mysql_fetch_array($x))
                   {               
                        $html1.='
                                <tr>
                                    <td>'.$r['BRCDT'].' :</td>
                                    <td>'.$r['BRCA1'].$r['BRCA2'].$r['BRCA3'].'</td>
                                    <td>'.$r['MOB'].'</td>
                                    <td>'.$r['EMAIL'].'</td>
                                </tr>';                         	 
                   }
                   $html1.='</table>';
                   
                    include("../mpdf.php");
                    $mpdf=new mPDF('b','A4','','' , 15 , 15 , 7 , 0 , 0 , 0,'');
                    $stylesheet = file_get_contents('pdf_style.css');
                    $mpdf->WriteHTML($stylesheet,1);
                    //$mpdf->SetDefaultBodyCSS('color', '#880000');
					
					//$mpdf->WriteHTML(file_get_contents('a.php'));
                    $mpdf->WriteHTML($html1);
                    $mpdf->Output();
                }
                else
                {
                    ?>
                    <script type="text/ecmascript"	>
                        confirm("First Select Company");				 			
                        window.location="../../dashbord.php";
                        //swal("Here's a message!");
                    </script>
                    <?php		 
                }
                ?>      
                <?php
                    ob_flush();
                ?>
            </body>
</html>