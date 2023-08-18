<?php include 'inc/header.php';?>
<?php
	$login = Session::get("userlogin");
	if ($login == true) {
		header("Location:index.php");
	}
?>
					<?php
						if ($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['login'])) {
							$userLogin = $user->userLogin($_POST);
						}
					?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
		 <?php
				if (isset($userLogin)) {
					echo $userLogin;
				}
			?>
        	<h3>Existing Users</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" >
                	<input name="email" placeholder="Email" type="text" />
                    <input name="pass" type="password" placeholder="Password" />
					<div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>
                 </form>
                    

					<?php
						if ($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['register'])) {
							$userReg = $user->userRegistration($_POST);
						}
					?>
    	<div class="register_account">
			<?php
				if (isset($userReg)) {
					echo $userReg;
				}
			?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name" />
							</div>
							
							<div>
							<input type="text" name="city" placeholder="City" />
							</div>
							
							<div>
							<input type="text" name="zip" placeholder="Zip-Code" />
							</div>
							<div>
							<input type="text" name="email" placeholder="Email" />
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address" />
							</div>
		    		<div>
					       <input type="text" name="country" placeholder="Country" />
				 </div>		        
	
		           <div>
				  		  <input type="text" name="phone" placeholder="Phone" />
		          </div>
				  
				  <div>
						 <input type="text" name="pass" placeholder="Password" />
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php';?>