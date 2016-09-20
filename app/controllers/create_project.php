<?php 
$pageTitle = "Create Project";
include "../inc/head.php";
include "../data/DbConnection.php";
?>

<!-- Having difficulty connecting localhost, but works with 127.0.0.1 -->
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

//get categories
include '../objects/category.php';
$category = new Category($conn);

?>


<!-- //Simple form that sends data to the database -->
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
            <td>Creator</td>
            <td><input type='text' name='creator_id' class='form-control' /></td>
        </tr>

        <tr>
            <td>Country</td>
            <td><input type='text' name='country' class='form-control' /></td>
        </tr>

        <tr>
            <td>Contact Email</td>
            <td><input type='text' name='email' class='form-control' /></td>
        </tr>

        <tr>
            <td>Category</td>
            <td><select name='category' class= 'form-control'>
            <?php $category->getCategories()?>
            </select>
            </td>
        </tr>

        <tr>
            <td>Description</td>
            <td>
            <textarea name="overview" class="form-control"></textarea>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>


<!-- //Pass control to the Project class  -->
<?php
if($_POST){
	include '../objects/project.php';
	$project = new Project($conn);

    $fields = &$project->getFields();
    
    //set the values
    foreach ($fields as $key => $value) {
        $fields[$key] = $_POST[$key];
    }

	if($project->create()){
		echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Project was created.";
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