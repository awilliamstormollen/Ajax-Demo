<html>
<head>
<style>
h1 {
    text-align: center;
    color: blue;
}

h2 {
    text-align: center;
}

canvas {
    border: 1px solid black;
}

</style>

<link rel="stylesheet" href="../mystyle.css" type="text/css"/>


<title>Ajax Demo</title>
<link rel="stylesheet" href="mystyle.css" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<h1>Ajax Demo</h1>
<h2>Alexander Williams</h2>

<script>
        function deleteRecord()
        {
                document.myForm.action='delete.php';
                document.myForm.submit();
        }
        function changeRecord()
        {
                document.myForm.action='change.php';
                document.myForm.submit();
        }
</script>

<?php

        error_reporting(1);

        $mysql_access = mysql_connect('localhost','n00678108', 'summer2018678108');

        if(!$mysql_access)
        {
                die('Could not connect: ' . mysql_error());
        }

        mysql_select_db('n00678108');

        $query = "SELECT * FROM student";

        $result = mysql_query($query, $mysql_access);
?>



</head>
<body>

<script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById("output").innerHTML = ajaxRequest.responseText;
		}
	}
	
	var selection = document.myForm.listPersons.value;

	ajaxRequest.open("GET", "getData.php?selection=" + selection, true);
	ajaxRequest.send(null); 
}

//-->
</script>



<form name='myForm'>
<select name="listPersons" onChange="ajaxFunction()">
<?php

	$mysql_access = mysql_connect("localhost", "n00678108", "summer2018678108");

	if (!$mysql_access)
	{
		echo "Connection failed.";
		exit;
	}

	mysql_select_db("n00678108");

	$query = "select personFirstName, personLastName, personID from student";

	$result = mysql_query($query);

	while ($record = mysql_fetch_array($result) ) {
		
		echo "<option value='$record[2]'>$record[0] $record[1]</option>";

	}

	mysql_close($mysql_access);

?>
</select>
</form>
<br><br>
<p id="output"></p>
<br>
<a href="../assign6/index.php"><h3>Make changes to Database</h3></a>

<a href="../index.html"><h3>Link back to ePortfolio</h3></a>

</body>
</html>

<?php
        $personID = $_GET['selection'];

        $mysql_access = mysql_connect('localhost', 'n00678108', 'summer2018678108'); 
        if (!$mysql_access)
        {
                echo "Connection failed.";
                exit;
        }
        mysql_select_db("n00678108");

        $query = "Select * from student where personID=" . $personID;

        $result = mysql_query($query);
        $record = mysql_fetch_array($result);

        $personID = $record[0];
	$email = $record[1];
        $fName = $record[3];
        $lName = $record[2];
        $address = $record[4];
	$city = $record[5];
        $ficoScore = $record[6];

	echo "Student ID: $personID <br>";
	echo "First Name: $fName <br>";
	echo "Last Name: $lName <br>";
	echo "Email: $email <br>";
	echo "Student Address: $address <br>";
	echo "Student City: $city <br>";
	echo "FicoScore: $ficoScore <br>";


	mysql_close($mysql_access);

?>



