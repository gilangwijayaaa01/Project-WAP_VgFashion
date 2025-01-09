<!DOCTYPE html>
<html>
<head>
<title>Warranty Info - VG Fashion</title>
<?php include "header.php";?>

<style>
	.text {
		font-size:18px;
		color:white;
	}
	
	.textbox {
		margin-left:200px;
		margin-right:200px;
	}
	
	.button {
		font-size:18px;
		border:3px solid white;
		cursor:pointer;
		width:140px;
		height:40px;
		background-color:transparent;
		color:white;
		box-shadow:5px 5px 3px 0px;
	}
	
	.button:hover {
		box-shadow:5px 5px 3px 0px green;
	}
	
</style>
</head>

<body>

<div class="page-title background-overlay" style="text-align:center;padding-top: 140px;padding-bottom: 140px">
<h1 style="font-weight:bold">Warranty Info</h1>
<p class="text">VG Fashion/ Warranty Info</p>
</div>

<div class="textbox">
	<p class="text">What a disaster! Your order didn’t turn out as expected, and you’re too busy to handle a return? Lucky for you, VG Fashion has you covered with our Pick-up & Return Service!
	We’ll pick up your fashion items, process an exchange or return, and deliver it back to you at your convenience—saving you time and hassle. Shopping made simple and stress-free!</p>
	<br>
	<ul style="list-style:none;content:bullet;color:white">
		<li class="text">Please complete and submit the form before our team contacts you via Email or WhatsApp.</li>
		<br><li class="text">Carefully pack your fashion items in their original packaging. Make sure delicate items are protected with extra padding. We’ll arrange for our courier to pick up your package at your convenience.
		(Please note: VG Fashion is not responsible for any damage caused during transit due to improper packaging. The customer will be responsible for ensuring items are securely packed).</li>
		<br><li class="text">Shipping and service charges may apply if the item is found to be in working condition or if the issue is caused by products not purchased from VG Fashion.
		The final decision rests with the VG Fashion team.</li>
		<br><li class="text">Please note that the FREE PICKUP AND RETURN SERVICE is only available for products purchased from VG Fashion that are still under warranty.</li>
		<br><li class="text">By submitting the form, you acknowledge and agree to the Terms and Conditions outlined above. </li>
	</ul>
	
	<input class="button" type="button" onclick="window.location.href='warranty_form.php'" value="Warranty Form"></input>
</div>

</body>

<?php include "footer.php";?>
</html>