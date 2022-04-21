<?php

if (isset($_SESSION['sess_user_id']))
{
	if (!isset($_SESSION['timeout']))
	{
		$_SESSION['timeout'] = time();
	}
	else if (time() - $_SESSION['timeout'] > 1800)
	{
		?>
		<script type="text/javascript">
		alert("Your session have expired");
		window.location.href = "logout.php"; //direct to Logout.php
		</script>
		<?php
	}
	else
	{
		session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
		$_SESSION['timeout'] = time();
	}
}

?>