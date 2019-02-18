<?php
include('../includes/connection_main.php');


$sql="SELECT * FROM factory_act_address";
$result=mysql_query($sql);


$html .= '
<div>
<img src="../images/epfo_logo.png">
<h1 align="center">Factory Act Address</h1>
</div>
<table class="tbl" border="1">
<tr>
<th>Office Name</th>
<th>Short Code</th>
<th>Office Address</th>
<th>Office City</th>
<th>Office Dist	</th>
<th>Office State</th>
<th>Office Phone</th>
<th>Office Mobile</th>
</tr>';

while($row = mysql_fetch_array($result)) {
$html.=
'<tr>
	<td>'.$row['office_name'].'</td>
	<td>'.$row['short_code'].'</td>
	<td>'.$row['office_address'].'</td>
	<td>'.$row['office_city'].'</td>
	<td>'.$row['office_dist'].'</td>
	<td>'.$row['office_state'].'</td>
	<td>'.$row['office_phone'].'</td>
	<td>'.$row['office_mobile'].'</td>
</tr>';
}
$html.='</table>';

include("mpdf.php");
$mpdf=new mPDF();
$stylesheet = file_get_contents('pdf_style.css');
$mpdf->WriteHTML($stylesheet,1);
//$mpdf->SetDefaultBodyCSS('color', '#880000');
$mpdf->WriteHTML($html);
$mpdf->Output();
?>
