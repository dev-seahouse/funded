<?php 
$pageTitle = "Create Project";
include "../inc/head.php";
include "../data/DbConnection.php";
?>

<?php 
$dsn = "mysql:dbname=funded_db;host=127.0.0.1";
$user = "root";
$pass = "";

try{
$conn = new PDO($dsn, $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $pdoe) {
			echo $pdoe->getMessage(); // in real life never do this
			echo "error!!!!!";
} catch (Exception $e) {
			echo $e->getMessage();
}
?>

<form action='create_project.php' method = 'post'>
<table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Title</td>
            <td><input type='text' name='title' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Target Amount</td>
            <td><input type='text' name='pledge_goal' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>ID</td>
            <td><textarea name='id' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Country</td>
            <td><textarea name='country' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><textarea name='email' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Founder </td>
            <td><textarea name='founder' class='form-control'></textarea></td>
        </tr>
 
        <!-- <tr>
            <td>Category</td>
            <td>
            categories from database will be here
            </td>
        </tr> -->
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>


<?php
if($_POST){
	include '../objects/project.php';
	$project = new Project($conn);

	$project->id = $_POST['id'];
	$project->title = $_POST['title'];
	$project->founderName = $_POST['founder_name'];
	$project->pledgeGoal = $_POST['pledge_goal'];
	$project->email = $_POST['email'];
	$project->country = $_POST['country'];

	if($project->create()){
		echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Product was created.";
        echo "</div>";
	} else {
		echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Unable to create product.";
        echo "</div>";
	}
}
 
include '../inc/footer.php'
?>