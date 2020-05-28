<script type="text/javascript">
$(document).ready(function() {
	$('#btn-place-order').click(function(event) {
		event.preventDefault();

		$.ajax({
			headers: {
				'Authorization':'Basic m8Qgm3ceLycXH6aZoH9n6yRTkqtwBBi4IQcAo7gdr6Fd9DLquVnp6xGP4AUF6gol'
			},
			success: function (data) {
				alert(data['message']);
			},
			error: function() {
				alert("An error occurred");
			}
		});
	});
});
</script>
<!DOCTYPE html>
<html>
<head>
	<title>tester</title>
</head>
<body>
	<main>
		<h3>form 1</h3>
		<hr>

<form name="order_form" id="order_form" method="post" action="index.php">
		<fieldset>
			<legend>Place order</legend>
			<input type="text" name="name_of_food" id="name_of_food" placeholder="name of food" required><br>
			<input type="number" name="number_of_units" id="number_of_units" placeholder="number of units" required><br>
			<input type="number" name="unit_price" id="unit_price" placeholder="unit price" required><br>
			<input type="hidden" name="status" id="status" required><br><br>

			<button type="submit" id="btn-place-order" class="btn btn-primary">Place order >></button>
		</fieldset>
	</form>



		<hr>
		<h3>form 2</h3>
		<hr>




		<hr>
	</main>
</body>
</html>