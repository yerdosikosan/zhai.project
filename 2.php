<?php 
	if(!empty($_POST["email"]) && !empty($_POST["password"])) 
	{     
		$email = $_POST["email"];     
		$pass = $_POST["password"]; 
 
    $conn = new Database( DB_SERVER , DB_USER , DB_PASS , DB_DATABASE ); 
 
    $link = $conn->connect(); 
	

	$stmt = $link->prepare("SELECT * FROM users WHERE email = ? AND password = ?"); $stmt->bind_param("ss", $email, $pass);
	 /* execute query */ 
	 $stmt->execute(); 
 
	/* Get the result */ 
	$result = $stmt->get_result(); 
 
	/* fetch value */ 
	$row = $result->fetch_assoc();

	if ($row != null) {     
		$return = array('fullname' => $row['name'] . ' ' . $row['surname'],         
			'img' => $row['img'],         
			'email' => $row['email'],         
			'url' => $row['url'],         
			'address' => $row['address'],         
			'birthday' => $row['birthday']);}}

 ?>
 <script>
 $('#submitbtn').click(function() {	
	$.ajax('2.php', {     type: 'POST',  // http method     
	data: { email: $( "#exampleInputEmail1" ).val(),         
	password:  $( "#exampleInputPassword1" ).val()},  // data to submit     
	accepts: 'application/json; charset=utf-8',     
	success: function (data) {         
		$("#user_info").show();         
		$("#errormsg").hide();         
		$( "#email" ).text(data.email);         
		$( "#fullname" ).text(data.fullname);         
		$( "#birthday" ).text(data.birthday);         
		$( "#url" ).text(data.url);         
		$( "#address" ).text(data.address);         
		$("#photo").attr("src", data.img);     
	}};
	</script>