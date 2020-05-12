<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: loggin.php");
    //exit;
//}
?>

<!doctype html>

<html lang="en"><head>
  	<title> All HW assignments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="homepagestyle.css" rel="stylesheet">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button class="btn btn-primary" id="sidebarCollapse" type="button">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
	  		<h1  style="color:white;" > Hi,"Welcome to your HW managment Site
                </h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="homepage.php"><span class="fa fa-home mr-3"></span> HOMEPAGE</a>
          </li>
          <li>
              <a href="todo.php"><span class="fa fa-user mr-3"></span>TO-DO</a>
          </li>
          <li>
            <a href="completed.php"><span class="fa fa-sticky-note mr-3"></span> COMPLETED</a>
          </li>
          <li>
            <a href="createnew.php"><span class="fa fa-sticky-note mr-3"></span> CREATE NEW ASSIGMENT</a>
          </li>
          <li>
            <a href="loggin.php" onclick="myFunction()" id="signout"><span class="fa fa-paper-plane mr-3"></span> SIGNOUT</a>
          </li>
        </ul>
    	</nav>

        <!-- Page Content  -->
<div class="p-4 p-md-5 pt-5" id="content">
<h2 class="mb-4">Homework Assigments</h2>
<?php
include 'config.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;    
$stmt = $pdo->prepare('SELECT * FROM todos ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    
$num_todo = $pdo->query('SELECT COUNT(*) FROM todos')->fetchColumn();
?>    
    

    
<div class="content read">
	<a href="createnew.php" class="create-contact">Add Assigment</a>
    <link href="main.css" rel="stylesheet">
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Description</td>
                <td>Created</td>
                <td>Due Date</td>
                <td>Completed</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo): ?>
            <tr>
                <td><?=$todo['id']?></td>
                <td><?=$todo['title']?></td>
                <td><?=$todo['description']?></td>
                <td><?=$todo['createdate']?></td>
                <td><?=$todo['duedate']?></td>
                <td><?=$todo['complete']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$todo['id']?>" class="edit">Edit<i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$todo['id']?>" class="trash">Delete<i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_todo): ?>
		<a href="homepage.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>
 
      </div>
		</div>
      
<script>
    function myFunction() {
        if (confirm("Are you sure you want to leave?")) {
            alert("Goodbye");
        } else {
            location = "homepage.php"
        }
        document.getElementById("signout").innerHTML;
    }
    </script>    
</body>
</html>