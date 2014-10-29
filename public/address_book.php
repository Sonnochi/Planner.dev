<?php

//capture input
if (isset($_POST)) {
	
	//Assign newitem from the form the $itemToAdd.
	//make an array from the input
	
	$newArray = $_POST;
	//Array push that new item onto the existing list.
	//alternate way to do array push
	
}

	//add input array to $addressBook array
		$addressBook[] = $newArray;
	// Save the whole list to file.

	//write to csv file
	$handle = fopen('address_book.csv', 'w');
	foreach ($addressBook as $row) {
	    fputcsv($handle, $row);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
	<h1>Contacts</h1>
		<table>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
				<th>Phone</th>
			</tr>

				<?  foreach ($addressBook as $key => $address): ?>
					<tr>	
					<?foreach ($address as $key => $value): ?>
						<!-- insert each in table row -->
						<td><?=$value?></td>
					<? endforeach; ?>
					</tr>	
				<? endforeach; ?>

		</table>
<form method="POST" name="add-form" action="address_book.php" >
	<label>Name:</label>
	<input id="name" name="name" type="text">

	<label>Address:</label>
	<input id="address" name='address' type="text">

	<label>City:</label>
	<input id="city" name='city' type="text">

	<label>State:</label>
	<input id="state" name='state' type="text">

	<label>Zip:</label>
	<input id="zip" name='zip' type="text">

	<label>Phone:</label>
	<input id="phone" name='phone' type="text">


	<button type="submit">Add</button>
</form>



</body>
</html>