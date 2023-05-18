<html>
<head>
	<title>Add</title>
</head>

<body>
	<h2>Add Guest</h2>
	<p>
		<a href="index.php"><button type='button' class='btn btn-warning'>Home</button></a>
	</p>

	<form action="addAction.php" method="post" name="add">
		<table width="25%" border="0">
			<tr> 
				<td>Last Name</td>
				<td><input type="text" name="last_name"></td>
			</tr>
            <tr> 
				<td>First Name</td>
				<td><input type="text" name="first_name"></td>
			</tr>
            <tr> 
				<td>Middle Name</td>
				<td><input type="text" name="mid_name"></td>
			</tr>
			<tr> 
				<td>Type</td>
				<td><input type="number" name="type" min="0" max="1"></td>
			</tr>
			<tr> 
				<td></td>
				<td><button type='submit' name="submit" class='btn btn-success'>Add</button></td>
			</tr>
		</table>
	</form>
</body>
</html>