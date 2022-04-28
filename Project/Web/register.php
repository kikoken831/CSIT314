<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"
    ></script>
    <style>
      body {
        background: #FCA311;
      }

      .card {
        border: none;
        height: 450px;
      }

      .forms-inputs {
        position: relative;
      }

      .forms-inputs span {
        position: absolute;
        top: -18px;
        left: 10px;
        background-color: #fff;
        padding: 5px 10px;
        font-size: 15px;
      }

      .forms-inputs input {
        height: 50px;
        border: 2px solid #eee;
      }

      .forms-inputs input:focus {
        box-shadow: none;
        outline: none;
        border: 2px solid #000;
      }

      .btn {
        height: 50px;
        background-color: #14213D;
      }

      .success-data {
        display: flex;
        flex-direction: column;
      }

      .bxs-badge-check {
        font-size: 90px;
      }

      #register-form {
	
      width:300px;
        margin-top: 10px;
        margin-right: auto;
        margin-bottom: 10px;
        margin-left: auto;
    }

    #register-form .fieldgroup {
      display: inline-block;
      padding: 8px 10px;
      width: 300px;
    }

    #register-form .fieldgroup label {
      float: left;
      padding: 1px 0 0;
      text-align: right;
      width: 100px;
    }

    #register-form .fieldgroup input {
      width: 160px;
    }

    #register-form .fieldgroup input,#register-form .fieldgroup textarea,#register-form .fieldgroup select
      {
      height: 28px;
    }

    #register-form input[type="submit"] {
      font-size: 1em;
      font-weight: 600;
      color: #fff;
      width: 27%;
      outline: none;
      border: none;
      border-radius: 5px;
      margin: 1em 0em 0em 0em;
      background: #34495e;
      cursor: pointer;
    }

    #register-form .fieldgroup span {
      padding-left: 110px;
      text-align: left;
      font-size: 12px;
      width: 300px;
      padding-top: 0px;
      float: left;
    }

    #register-form .fieldgroup input, #register-form .fieldgroup textarea, #register-form .fieldgroup select
    {
      width: 170px;
    }

    #register-form .fieldgroup span img {
      padding-right: 75px;
      width: 185px !important;
      height: 30px !important;
      padding-top: 0px;
      float: left;
      
    }
    </style>


<script type="text/javascript">
$(document).ready(function() {
	$("#password").keyup(function (e) {
		
		var password = $(this).val();
		var pattern = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/);
		if (!pattern.test(password))
		{
			$("#password-result").html('Password must be at least 8 characters long with at least 1 Upper case, 1 Lower case & 1 digit!');
			$('#password').css('border-color', '#FB3A3A');
      var passwordCheck = false;
			return;
		}
		else
		{
			$("#password-result").html('');
			$('#password').css('border-color', '');
      var passwordCheck = true;
			return;
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#retypepassword").keyup(function (e) {
	
		var retypepassword = $(this).val();
		var password = $("#password").val();
		if (password != retypepassword)
		{
			$("#retypepassword-result").html('Password does not match!');
			$('#retypepassword').css('border-color', '#FB3A3A');
      var retypePasswordCheck = false;
			return;
		}
		else
		{
			$("#retypepassword-result").html('');
			$('#retypepassword').css('border-color', '');
      var retypePasswordCheck = true;
			return;
		}
	});	
});
</script>

<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#email").keyup(function (e) {
		
		var email = $(this).val();
		var pattern = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
		if (!pattern.test(email))
		{
			$("#email-result").html('Invalid email format');
			$('#email').css('border-color', '#FB3A3A');
			return;
		}
		else
		{
			$("#email-result").html('<img src="images/ajax-loader.gif" />');
			$.post('emailcheck.php', {'email':email}, function(data) {
			  $("#email-result").html(data);
			});
			$('#email').css('border-color', '');
		}
	});	
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#fullname").keyup(function (e) {

		var fullname = $(this).val();

		var pattern = new RegExp(/^[A-Za-z.-]+(\s*[A-Za-z.-]+)*$/);
		if (!pattern.test(fullname))
		{
			$("#fullname-result").html('It should only contain letters');
			$('#fullname').css('border-color', '#FB3A3A');
			return;
			
		}
		else
		{
			$("#fullname-result").html('');
			$('#fullname').css('border-color', '');
			return;
			
		}
	});	
});
</script>
  </head>
  <body oncontextmenu="return false" class="snippet-body">
	<?php
			$servername="localhost";
			$username="root";
			$serverpw="";
			$dbname="restaurant";
			$dbtable="customer";

			$conn = new mysqli($servername, $username, $serverpw, $dbname);
			if ($conn->connect_error) { die("connection failed"); }
			//print_r($menuArr); //test array set
		?>
  <?php
      include ("function.php");
      if ($_SERVER["REQUEST_METHOD"] == "POST")//check is register button is clicked
      {
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        
        $fullname = test_input($_POST["fullname"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $retypepassword = test_input($_POST["retypepassword"]);

        

        if(!empty($fullname) && !empty($email) && !empty($password) && !empty($retypepassword)) //check if inputs are empty
	      {
          if(check_name($fullname))
          {
            if(check_email($email))
            {
              $query=$conn->prepare("select count(*) from customer where email = ? "); //check if user exists in database
              $query->bind_param('s',$email); //bind parameter
              $query->execute(); //execute query
              $query->bind_result($count);
              $query->fetch(); //fetch query
              $query->close(); //close query
              if($count==0)
              {
                if(check_password($password))
                {
                  if($password == $retypepassword) //check if password match
                  {
                    $passwordencrypt = str_encryptaesgcm("makanClub2022pw", $password, "base64");
                    $query = $conn->prepare("INSERT INTO customer (`EMAIL`, `PASSWORD`, `CUSTOMER NAME`, `FAVOURITE LIST`) VALUES (?,?,?,'')"); //insert into database
                    $query->bind_param('sss', $email, $passwordencrypt, $fullname); //bind parameters
                    
                    if ($query->execute()) //execute query
                    {
                      ?>
                        <script type="text/javascript">
                        alert("You have successfully registered. Redirecting to the login page!");
                        window.location.href = "login.php"; 
                        </script>
                      <?php
                    }
                    else
                    {
                      ?>
												<script type="text/javascript">
												alert("Error!");
												window.location.href = "register.php"; 
												</script>
											<?php
                    }
                  }
                  else
                  {
                    ?>
											<script type="text/javascript">
											alert("Password does not match!");
											window.location.href = "register.php"; 
											</script>
										<?php
                  }
                }
                else
                {
                  ?>
										<script type="text/javascript">
										alert("Password must be at least 8 characters and including at least 1 digit!");
										window.location.href = "register.php"; 
										</script>
									<?php
                }
              }
              else
              {
                ?>
										<script type="text/javascript">
										alert("Email is already registered. Please login with your registered email.");
										window.location.href = "register.php"; 
										</script>
									<?php
              }
            }
            else
            {
              ?>
									<script type="text/javascript">
									alert("Please enter a valid email format.");
									window.location.href = "register.php"; 
									</script>
								<?php
						}
          }
          else
          {
             ?>
							<script type="text/javascript">
							alert("Name should only contain letters");
						  window.location.href = "register.php"; 
							</script>
					  <?php
          }
        }
        else
        {
          ?>
              <script type="text/javascript">
               alert("Please fill in all the blanks");
               window.location.href = "register.php"; 
              </script>
          <?php
        }
      }  

      ?>
    <div class="container mt-5">
      <div class="row d-flex justify-content-center">
      <div class="banner">
	<div class="container">
		<div class="banner-main">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="register-form" autocomplete="off" align="center" onsubmit="return validateRegistrationForm()">
				
				<h2>Registration Form</h2>

				<div id="form-content">
					<fieldset>

						<div class="fieldgroup">
            <div class="fieldgroup">
							<label for="name">Full name : </label><input name="fullname" type="text"
								id="fullname" maxlength="100" required> <span id="fullname-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="email">Email : </label><input name="email" type="text"
								id="email" maxlength="50" required> <span id="email-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="password">Password : </label><input name="password"
								type="password" id="password" required> <span
								id="password-result"></span>
						</div>

						<div class="fieldgroup">
							<label for="retypepassword">Retype Password : </label><input
								name="retypepassword" type="password" id="retypepassword"
								required> <span id="retypepassword-result"></span>
						</div>
						<div class="fieldgroup">
							<div class="registerbutton">
								<input type="submit" value="Register" class="submit"
									name="register" id="registerbutton" align="center">
							</div>
						</div>

					</fieldset>

				</div>
				<div class="fieldgroup">
					<p>
						Already registered? <a href="login.php"></br>Sign in</a>
					</p>
				</div>
			</form>
      <script>
      function validateRegistrationForm(){
          var result = false;
          if (($('#fullname') != "") && (passwordCheck == true) &&
              (retypePasswordCheck == true)) {
                  result = true;
          }
          return result;
      }
      </script>
      
		</div>
	</div>
    


</div>
      </div>
  </div>

    
  </body>
</html>