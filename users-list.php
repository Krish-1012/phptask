<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users-List</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
	<?php
    include 'navbar.php';
    ?>
<div class="container mt-5 mb-5">
	<h3 class="mb-3 text-center">Server Side Datatable Integrated</h3>
<table id="example" class="display table mt-5" style="width:70%;">
        <thead>
            <tr>
            	<th>Profile-Pic</th>
                <th>First name</th>
                <th>Last name</th> 
                <th>Email</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
    	$(document).ready(function () {
		    $('#example').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: 'serverside.php'
		    });
		});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>
