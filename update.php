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
  	<title>HW assignments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="homepagestyle.css" rel="stylesheet">
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
<h2 class="mb-4">Create new assignment</h2>

<?php
include 'config.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $des = isset($_POST['description']) ? $_POST['description'] : '';
        $created = isset($_POST['createdate']) ? $_POST['createdate'] : date('Y-m-d H:i:s');
        $due = isset($_POST['duedate']) ? $_POST['duedate'] : date('Y-m-d H:i:s');
        $complete = isset($_POST['complete']) ? $_POST['complete'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE todos SET id = ?, title = ?, description = ?, createdate = ?, duedate = ?, complete = ? WHERE id = ?');
        $stmt->execute([$id, $title, $des, $created, $due, $complete, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM todos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $todo = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$todo) {
        exit('Assigment doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<link href="main.css" rel="stylesheet"> 
<div class="content update">
	<h2>Update Assigment #<?=$todo['id']?></h2>
    <form action="update.php?id=<?=$todo['id']?>" method="post">
      <label for="id">ID</label>
        <input type="text" name="id" placeholder="1" value="<?=$todo['id']?>"id="id">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Name of Assigment" id="title" value="<?=$todo['title']?>">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="144 max characters" id="description" value="<?=$todo['description']?>">
        <label for="createdate">Created</label>
        <input type="datetime-local" name="createdate" placeholder="Time" id="createdate" value="<?=date('Y-m-d\TH:i', strtotime($todo['createdate']))?>">
        <label for="duedate">Due</label>
        <input type="datetime-local" name="duedate" value="<?=date('Y-m-d\TH:i', strtotime($todo['duedate']))?>" id="duedate">
        <label for="title">Title</label>
        <input type="text" name="complete" placeholder="Yes or No" id="complete" value="<?=$todo['complete']?>">
        <input type="submit" value="Create">  
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
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