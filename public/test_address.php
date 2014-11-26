<?php 

	define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'adress_book_db');
    define('DB_USER', 'adress_user');
    define('DB_PASS', 'charlie3');

    require '../inc/db_connect.php';
    
    if(isset($_GET['page'])){
        $pageNumber = $_GET['page'];
    } else{
        $pageNumber = 1;
    }

    $limit = 4;
    $offset = ($pageNumber - 1) * $limit;
    $query = "SELECT street_name, city, state, zip, phone FROM address LIMIT :limit OFFSET :offset";

    $stmt = $dbc->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $address = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $numberOfPeople = $dbc->query('SELECT count(*) FROM address')->fetchColumn();
    
    if($_POST) {
    if(empty($_POST['street_name']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['zip']) || empty($_POST['phone'])) {
         echo "<div class='alert alert-info' role='alert'> Please fill in all fields. </div>";
    } else {
        if(strlen($_POST['phone'] < 125)) {
            $query = $dbc->prepare('INSERT INTO address (street_name, city, state, zip, phone) 
                                    VALUES(:street_name, :city, :state, :zip, :phone)');
            $query->bindValue(':street_name', $_POST['street name'], PDO:: PARAM_STR);
            $query->bindValue(':city', $_POST['city'], PDO:: PARAM_STR);
            $query->bindValue(':state', $_POST['state'], PDO:: PARAM_STR);
            $query->bindValue(':zip', $_POST['zip'], PDO:: PARAM_STR);
            $query->bindValue(':phone', $_POST['phone'], PDO:: PARAM_STR);
            $query->execute();
        }
    }
}






?>


<!DOCTYPE html>
<html>
<head>
	<title>Address Book</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>
<body>
	<div align="center">
			<h1>Address Book</h1>
				<table class="table table-striped">
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
						<th>Phone</th>
						<th>Remove</th>
					</tr>
					<tr>	
					<?php foreach ($address as $addresses): ?>
			            <tr>
			                <td><?= $address['street_name'] ?></td>
			                <td><?= $address['city'] ?></td>
			                <td><?= $address['state']; ?></td>
			                <td><?= $address['zip'] ?></td>
			                <td><?= $address['phone'] ?></td>
			            </tr>
        			<?php endforeach; ?>
				</table>
				
		<!-- Create a Form to Accept New Items -->
		<form method="POST" name="add-form" action="test_address.php" >
			<h2>Add New Contact</h2>
			<label>Name:</label>
			<input id="name" name="name" placeholder="John Smith" autofocus>

			<label>Address:</label>
			<input id="address" name='address' placeholder="123 New st">

			<label>City:</label>
			<input id="city" name='city' placeholder="City">

			<div class="col-xs-2">
			 <select name="state" class="form-control" autofoucus>
	            <option value="AL">AL</option>
	            <option value="AK">AK</option>
	            <option value="AZ">AZ</option>
	            <option value="AR">AR</option>
	            <option value="CA">CA</option>
	            <option value="CO">CO</option>
	            <option value="CT">CT</option>
	            <option value="DE">DE</option>
	            <option value="DC">DC</option>
	            <option value="FL">FL</option>
	            <option value="GA">GA</option>
	            <option value="HI">HI</option>
	            <option value="ID">ID</option>
	            <option value="IL">IL</option>
	            <option value="IN">IN</option>
	            <option value="IA">IA</option>
	            <option value="KS">KS</option>
	            <option value="KY">KY</option>
	            <option value="LA">LA</option>
	            <option value="ME">ME</option>
	            <option value="MD">MD</option>
	            <option value="MA">MA</option>
	            <option value="MI">MI</option>
	            <option value="MN">MN</option>
	            <option value="MS">MS</option>
	            <option value="MO">MO</option>
	            <option value="MT">MT</option>
	            <option value="NE">NE</option>
	            <option value="NV">NV</option>
	            <option value="NH">NH</option>
	            <option value="NJ">NJ</option>
	            <option value="NM">NM</option>
	            <option value="NY">NY</option>
	            <option value="NC">NC</option>
	            <option value="ND">ND</option>
	            <option value="OH">OH</option>
	            <option value="OK">OK</option>
	            <option value="OR">OR</option>
	            <option value="PA">PA</option>
	            <option value="RI">RI</option>
	            <option value="SC">SC</option>
	            <option value="SD">SD</option>
	            <option value="TN">TN</option>
	            <option value="TX">TX</option>
	            <option value="UT">UT</option>
	            <option value="VT">VT</option>
	            <option value="VA">VA</option>
	            <option value="WA">WA</option>
	            <option value="WV">WV</option>
	            <option value="WI">WI</option>
	            <option value="WY">WY</option>
	        	</select>
	        </div>

			<label>Zip:</label>
			<input id="zip" name='zip' placeholder="12345">

			<label>Phone:</label>
			<input id="phone" name='phone' placeholder="(555)-555-5555">


			<button type="submit">Submit</button>
		</form>

	</div>
</body>
</html>
