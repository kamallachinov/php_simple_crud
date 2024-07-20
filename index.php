<?php

include('config/db_connect.php');
//write query for all pizzas
$sql = 'SELECT * FROM pizzas ORDER BY created_at';

//make query & get result
$result = mysqli_query($connection, $sql);

//fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Pizzas!</h4>

<div class="container">
    <div class="row">
        <?php
        foreach ($pizzas as $pizza) : ?>
        <div class="col s6 md3">
            <div class="card z-depth-0">
                <div class="card-content center">
                    <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                    <ul>
                        <?php foreach (explode(",", $pizza['ingredients']) as $ing) : ?>
                        <li>
                            <?php echo $ing ?>
                        </li>

                        <?php endforeach ?>
                    </ul>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">more info</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php if (count($pizzas) >= 3) { ?>
<p class="container">There are 3 or more pizza</p>
<?php } else { ?>
<p class="container">There is less than 3 pizza</p>
<?php } ?>



<?php include('templates/footer.php'); ?>




</html>