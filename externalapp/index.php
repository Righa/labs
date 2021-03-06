<!DOCTYPE html>
<html>
<head>
	<title>external app</title>
	<script src="jquery-3.5.1.js"></script>
	<script type="text/javascript" src="placeorder.js"></script>
	<!--bootstrap js -->
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!--bootstrap css -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.min.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.min.css.map">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<h3>It is time to communicate with the exposed API key to be passed in the header</h3>
	<hr>
	<h4>1. Feature 1 - Placing an order</h4>
	<hr>
	<form name="order_form" id="order_form">
		<fieldset>
			<legend>Place order</legend>
			<input type="text" name="name_of_food" id="name_of_food" placeholder="name of food" required><br>
			<input type="number" name="number_of_units" id="number_of_units" placeholder="number of units" required><br>
			<input type="number" name="unit_price" id="unit_price" placeholder="unit price" required><br>
			<input type="hidden" name="status" id="order_status" value="received"><br><br>

			<button type="submit" id="btn-place-order" class="btn btn-primary">Place order >></button>
		</fieldset>
	</form>
	<hr>
	<h4>1. Feature 2 - Checking order status</h4>
	<hr>
	<form name="order_status_form" id="order_status_form">
		<fieldset>
			<legend>Check order status</legend>
			<input type="number" name="order_id" id="order_id" placeholder="order id" required><br><br>

			<button id="btn-check-status" class="btn btn-warning" type="submit">Check order status</button>
		</fieldset>
	</form>
</body>
</html>