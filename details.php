<?php
//check GET request id param
include('config/db_connect.php');

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($connection, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id=$id_to_delete";

    if (mysqli_query($connection, $sql)) {
        //success
        header("Location: index.php");
    } else {
        //failure
        echo "query error: " . mysqli_error($connection);
    }
}

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($connection, $_GET['id']);

    //make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    //get query result
    $result = mysqli_query($connection, $sql);
    //fetch result in array format
    $pizza = mysqli_fetch_assoc($result);
    // print_r($pizza);
    mysqli_free_result($result);
    mysqli_close($connection);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<div class="container center">

    <?php if ($pizza) { ?>
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by:<?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo htmlspecialchars($pizza['created_at']); ?></p>
        <h5>
            Ingredients:
        </h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

        <!-- DELETE FORM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>


    <?php } else { ?>
        No such pizza exists!
    <?php } ?>

</div>

<?php include('templates/footer.php'); ?>

</html>