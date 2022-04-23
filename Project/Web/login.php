<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer Login</title>
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
        height: 320px;
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
    </style>
  </head>
  <body oncontextmenu="return false" class="snippet-body">
	<?php
		$servername="localhost";
		$username="root";
		$serverpw="";
		$dbname="CSIT 314";
		$dbtable="CUSTOMER";

		$conn = new mysqli($servername, $username, $serverpw, $dbname);
		if ($conn->connect_error) { die("connection failed"); }

		$sql = "select * from $dbtable";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			while ($row=$result->fetch_assoc())
				{
					$menuArr[] = array('item id' => $row["ITEM ID"],'item name' => $row["ITEM NAME"], 'price' => $row["PRICE"], 'imageurl' => $row["IMAGEURL"], 'category' => $row["CATEGORY"] );
				}
		}
		//print_r($menuArr); //test array set
	?>
    <div class="container mt-5">
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <h6 style="text-align:center">Welcome to Makan Club Restaurant POS system!</h6>
          <div class="card px-5 py-5" id="form1">
            <div class="form-data" v-if="!submitted">
              <div class="forms-inputs mb-4">
                <span>Email or username</span>
                <input
                  autocomplete="off"
                  type="text"
                  v-model="email"
                  v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}"
                  v-on:blur="emailBlured = true"
                />
                <div class="invalid-feedback">A valid email is required!</div>
              </div>
              <div class="forms-inputs mb-4">
                <span>Password</span>
                <input
                  autocomplete="off"
                  type="password"
                  v-model="password"
                  v-bind:class="{'form-control':true, 'is-invalid' : !validPassword(password) && passwordBlured}"
                  v-on:blur="passwordBlured = true"
                />
                <div class="invalid-feedback">
                  Password must be 8 character!
                </div>
              </div>
              <div class="mb-3">
                <button
                  v-on:click.stop.prevent="submit"
                  class="btn btn-dark w-100"
                >
                  Login
                </button>
              </div>
            </div>
            <div class="success-data" v-else>
              <div class="text-center d-flex flex-column">
                <i class="bx bxs-badge-check"></i>
                <span class="text-center fs-1"
                  >You have been logged in <br />
                  Successfully</span
                >
              </div>
            </div>
          </div>
        </div>
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