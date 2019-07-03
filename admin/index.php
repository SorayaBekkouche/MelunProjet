<?php 

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
	
		<title>Melun - Administration</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body>
		<div>

			<div>
			
				<?php require 'partials/nav.php'; ?>

			</div>
			
		</div>
	</body>
</html>

