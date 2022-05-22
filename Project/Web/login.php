<?php
  session_start();
 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer Login</title>
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
  </head>
  <body oncontextmenu="return false" class="snippet-body">

    <div class="container mt-5">
      <div class="row d-flex justify-content-center">
      <div class="banner">
	<div class="container">
  <h6 style="text-align:center">Welcome to Makan Club Restaurant POS system!</h6>
		<div class="banner-main">
				<form action="login.php" method="post" id="register-form" autocomplete="off" align="center" onsubmit="return validateRegistrationForm()">
				

				<div id="form-content">
					<fieldset>
            <div class="fieldgroup">
              <label for="tableNum">Table No : </label>
                <select name="tableNum" id="tableNum" required>
                  <script>
                    for(var i=1; i<=20; i++)
                    {
                      document.write("<option value=\""+i+"\">"+i+"</option>");
                    }
                  </script>
                </select>
            </div>
						<div class="fieldgroup">
							<label for="email">Email : </label>
              <input name="email" type="text" id="email" maxlength="50">
						</div>

						<div class="fieldgroup">
							<label for="password">Password : </label><input name="password" type="password" id="password">
						</div>

						<div class="fieldgroup">
							<div class="loginbutton">
								<input type="submit" value="Login" class="submit" name="login" id="loginbutton" align="center">
							</div>
						</div>
            <div class="fieldgroup">
								<input type="submit" value="Login as Guest" class="submit"
									name="guest" id="guest" align="center">
						</div>
					</fieldset>
          <?php
          require_once ("function.php");
          //require_once"Controller/CustomerController.php";
						if ( isset ($_POST["login"])) //check if login button is clicked
						{
							function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
              
              $email = test_input($_POST["email"]);
              $password = test_input($_POST["password"]);


							if(!empty($email) && !empty($password)) //check if input is empty
							{
									if (check_email($email))
									{
										if (check_password($password))
										{
                      require "Controller/CustomerController.php";
                      $cc = new CustomerController($email);
                     
											if ($cc->validateLogin($password)) //check if both matches
											{
                        ?>
                        <script type="text/javascript">
                        alert("Successfully logged in. Redirecting to MakanClub menu page");
                        <?php
                        
                        $_SESSION['cusID']=$cc->getId();
                        $_SESSION['tableid']=$_POST['tableNum'];
                        ?>
                        window.location.href = "home.php";
                        </script>
                      <?php
											}
                      else
                      {
                        ?>
													<script type="text/javascript">
													alert("Invalid email or password");
													window.location.href = "login.php"; 
													</script>
												<?php
                      }
										}
										else
										{
												?>
													<script type="text/javascript">
													alert("Invalid email or password");
													window.location.href = "login.php"; 
													</script>
												<?php
										}
									}
									else
									{
											?>
											<script type="text/javascript">
                      alert("Invalid email or password");
                      window.location.href = "login.php";
                      </script>
											<?php
									}
								}
								else
								{
									?>
										<script type="text/javascript">
										alert("Invalid email or password");
										window.location.href = "login.php";
										</script>
									<?php
								}
						}
            if ( isset ($_POST["guest"])) //check if guest button is clicked
            {?>
              <script type="text/javascript">
                alert("Successfully logged in as Guest. Redirecting to MakanClub menu page");
                window.location.href = "home.php?cusID=1&tableNum="+"<?php echo $_POST['tableNum']?>";
              </script>
              <?php
            }
						?>


				</div>
				<div class="fieldgroup">
					<p>
						<a href="register.php"></br>Not registered? Click here to register</a>
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
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"
    ></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src=""></script>
    <script type="text/Javascript">
      var app = new Vue({
      el: '#form1',
      data: function () {
      return {
      email : "",
      emailBlured : false,
      valid : false,
      submitted : false,
      password:"",
      passwordBlured:false
      }
      },

      methods:{

      validate : function(){
      this.emailBlured = true;
      this.passwordBlured = true;
      if( this.validEmail(this.email) && this.validPassword(this.password)){
      this.valid = true;
      }
      },

      validEmail : function(email) {

      var re = /(.+)@(.+){2,}\.(.+){2,}/;
      if(re.test(email.toLowerCase())){
      return true;
      }

      },

      validPassword : function(password) {
      if (password.length > 7) {
      return true;
      }
      },

      submit : function(){
      this.validate();
      if(this.valid){
      this.submitted = true;
      }
      }
      }
      });
    </script>
  </body>
</html>