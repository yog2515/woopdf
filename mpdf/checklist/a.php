<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <style>        
        body
        {
            width:100%;
            font-family:Arial;
            font-size:10pt;
            margin:0;
            padding:0;
        }                
        table
        {             
            border-spacing:0;
            border-collapse: collapse;              
        }         
        table td 
        {            
            padding: 0mm;
        }         
        table.heading
        {
            height:50mm;
        }
         
        h1.heading
        {
            font-size:14pt;
            color:#000;
            font-weight:normal;
        }         
        h2.heading
        {
            font-size:9pt;
            color:#000;
            font-weight:normal;
        }               
    </style>
</head>
<body>
<?php 
	include_once("../../includes/connection_main.php");
	$x=mysql_query("sle");
?>
  
    <table class="heading" style="width:100%;">
        <tr>
            <td style="width:70%;">
                <h1 class="heading">RAJ CONSULTANCY</h1>
                <h2 class="heading">
                    Labour, P.F. & Factories Act's Consultant<br />
                    H.O. : 205, Business Bay, 6-Royal Park Corner, Kalawad Rd, Nr Atmiya Collage, RAJKOT - 360 005<br />
                </h2>
            </td>
            <td rowspan="2" align="right">
                <table>
               		<tr><td>&nbsp;</td><td></td></tr>
                    <tr><td> Ph M : </td><td width="101"> 94286 98101</td></tr>
                    <tr><td>Off M : </td><td>75750 79002</td></tr>
                    <tr><td>Mail : </td><td> rajconrjt@gmail.com</td></tr>
                </table>
            </td>
        </tr>         
    </table>       
</body>
</html>