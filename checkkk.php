<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="sihcodecss.css">
</head>
<body>
	<div class="container">
		<form name="form1" id="labnol" method="post"><center><h1><b>Login Form</b></h1></center>
			<label><b>Username</b></label> 
			<input type="text" placeholder="Enter Username" required> 
			<label><b>Password</b></label> 
			<input type="password" placeholder="Enter Password" required><br>
			<label><b><h3>Captcha</h3></b></label>
			<table style="position:absolute;left:0%;top:44%;" align="left" border="1" width="10px" height="10px">
				<?php
					$conn = mysqli_connect("localhost","root","","sih");
					if (mysqli_connect_errno()) {
						die(sprintf("Connect failed: %s\n", mysqli_connect_error()));
					}
					$query="select image,audio from info order by rand() limit 2";
					$result = mysqli_query($conn, $query);
					while($row=mysqli_fetch_array($result))
					{
				?>
				<td>
					<div align="center" class="image1" >
						<?php echo "<img src='images/".$row['image']."' width=350 height=200>";?>
						<audio controls="controls" preload="metadata" >
							<?php echo "<source  src='audio/".$row['audio']."'  >";?>
						</audio><br>
					</div>
				</td>
				<?php 
					}
				?>
				<tr>
					<td><input type="text" width="80%" name="s" id="1" placeholder="IMAGE NAME"/>
						<img onclick="startDictation('1')" src="https://i.imgur.com/cHidSVu.gif" />
					</td>
					<div class="speech1">
						<td><input type="text" name="p" id="2" placeholder="IMAGE NAME"/>
							<img onclick="startDictation('2')" src="https://i.imgur.com/cHidSVu.gif"/>
						</td>
					</div>
				</tr>
			</table>
		</form>
		<button style="position:absolute;top:100%;left:20%;" type="submit">Login</button>
	</div>
</body>
</html>
<script>
    function startDictation(x){
        if (window.hasOwnProperty('webkitSpeechRecognition')){
			var recognition = new webkitSpeechRecognition();
			recognition.continuous = false;
			recognition.interimResults = false;
			recognition.lang = "en-US";
			recognition.start();
			recognition.onresult = function (e) {
				document.getElementById(x).value = e.results[0][0].transcript;
				recognition.stop();
				document.getElementById('transcript').submit();
			};
			recognition.onerror = function(e) {
				recognition.stop();
			}
        }
    }
</script>