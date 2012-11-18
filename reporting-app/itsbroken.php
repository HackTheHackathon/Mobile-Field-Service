<?php

$servicenow_email = "dev022@service-now.com";
$from_email = "neo@cortexel.us";

if($n && $status){

	$good_response = '{"what":"YAY"}';
	$bad_response = '{"what":"NAY"}';
	$w2 = "at $w";
	$subject = "$n $w2: $status";
	$mail_success = mail ( $servicenow_email, $subject, "...", "From: $from_email (UtiliMom)");
	
	header("HTTP/1.1 201 OK\r\n");
	header('Content-type: application/json; charset=utf-8\r\n');
	
	die($mail_success?$good_response:$bad_response);
}else if($t && !$n){
	$n = "some $t";
}else if(!$n){
	die("<body style='background-color:black;color:red;font-family:tahoma'>666 bad request</body>");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>It's Broken!!!!!!!!!!</title>
</head>

<script src="http://zeptojs.com/zepto.min.js"></script> 

<script>

Zepto(function($){
	resetHeight();
	resetHeight();
	resetHeight();	
	
	<?php 
	if(!$w){
		echo "$('#where').hide()\n";
		echo "$('#at').hide()";
	}
	?>
	
	$(window).resize(function() {
		resetHeight();
	});
});

function resetHeight(){
	h = $('body').height();
	// SET the size of everything depending on the window size
	//alert(h)
	px = h/80;
	$('body').css("font-size",px + "px");
	//alert(h + " " + px);
}
function submitit(status){
	$('#status').append("Updating <?=$n?> status. . .<br>")
	$('#form').hide()
	$.ajax({
	  type: 'POST',
	  url: './',
	  data: {"t":"<?=$t?>","w":"<?=$w?>","n":"<?=$n?>","status":status},
	  dataType: 'json',
	  timeout: 300,
	  complete: function(data){
		$('#status').append("SUCCESS!")
		$('#form').hide()
		$('#thankyou').show()
		//jobj = JSON.parse(data.response)
		//alert(jobj["what"])
	  },
	  error: function(xhr, type){
		d = 3
		//alert("errro")
		//$('body').append("Error:(")
	  }
	})
}

</script>

<style>
input {font-size: 6em; padding: 0.1em; width: 93%; background-color: #7C5852; color: white}
body { background-color: black; color: white; font-family: tahoma; margin: 20px; font-size: 16px} 
#name { font-size: 6em; }
#at { font-size: 4em; }
#where { font-size: 6em; }

#form { position: absolute; bottom: 0px; margin-bottom: 10px; width: 96%; }
.text {font-size: 2em; margin: 0px; color: #bbb}
#status {font-size: 2em; margin: 10px; color: #777}
#thankyou { display: none; }
.smiley { font-size: 6em; }
</style>
</head>


<body>

<span id="name"><?=$n?></span><br>
<span id="at">at </span>
<span id="where"><?=$w?></span><br>

<div id="welcome" class="text">
<p>Hello concerned citizen! Here you can send a message to the good folks who fix machines. Let them know the status of this <?=$n?>:</p>
</div>
<div id="form">
<?php
$statuses = array(
	"coffee" => array("Broken", "Needs Cleaning", "Change Filter", "Tastes Bad"),
	"speaker" => array("Broken", "Biased Spectrum", "Turn that up \m/", "Bad Music"),
	"fire-ext" => array("Needs Refill", "Expired", "Too Anthropomorphic", "Everyone is Dead"),
	"av" => array("Broken", "Missing Cable", "Microphone problem", "Presentation Too Awesome"),
	"toilet" => array("Broken", "Grotesque", "Overflowing", "Locked Inside"),
	"fountain" => array("Broken", "Low Pressure", "Not Alcoholic Enough", "Uncomfortably Warm")
);
if(array_key_exists($t, $statuses)){
	$status_list = $statuses[$t];
}else{
	$status_list = array("Broken", "Missing");
}
foreach($status_list as $status){
	if(strlen($status)<15){
		$fontsize = "6em";
		$padding = "0.1em";
	}else if(strlen($status)<18){
		$fontsize = "5em";
		$padding = "0.25em";
	}else if(strlen($status)<22){
		$fontsize = "4.5em";
		$padding = "0.38em";
	}else{
		$fontsize = "4em";
		$padding = "0.4em";
	}
	echo "<input type='button' value='$status' style='font-size: $fontsize; padding-top: $padding; padding-bottom: $padding' onclick='submitit(\"$status\")' /><br/>";
}
?>

</div>

<div id="status">
 
</div>

<div id="thankyou" class="text">
<p>The Empire thanks you for doing your civic duty! </p>
<p class="smiley">(:</p>
</div>
