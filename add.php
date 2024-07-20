<?php
include('config/db_connect.php');

$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
$title = $ingredients = $email = '';

function validate_email($email)
{
    if (empty($email)) {
        return 'Email input is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email must be a valid email address';
    }
    return '';
}

function validate_title($title)
{
    if (empty($title)) {
        return 'Title input is required';
    } elseif (!preg_match('/^[a-zA-Z\s\/]+$/', $title)) {
        return 'Title must be letters, spaces, or forward slash only';
    }
    return '';
}

function validate_ingredients($ingredients)
{
    if (empty($ingredients)) {
        return 'Ingredients input is required';
    } elseif (!preg_match('/^([a-zA-Z\s\/]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
        return 'Ingredients must be a comma separated list';
    }
    return '';
}

if (isset($_POST['submit'])) {
    // Validate inputs
    $email = $_POST['email'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];

    $errors['email'] = validate_email($email);
    $errors['title'] = validate_title($title);
    $errors['ingredients'] = validate_ingredients($ingredients);

    if (!array_filter($errors)) {
        $stmt = $connection->prepare("INSERT INTO pizzas (title, email, ingredients) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $title, $email, $ingredients);

        if ($stmt->execute()) {
            header('Location: index.php');
        } else {
            echo 'Query error: ' . $stmt->error;
        }

        $stmt->close();
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">
        Add a pizza
    </h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="white" method="POST">
        <label for="">Your Email:</label>
        <input type="text" name="email" value="<?php echo $email ?>">
        <div class="red-text">
            <?php echo $errors['email']; ?>
        </div>
        <label for="">Pizza title:</label>
        <input type="text" name="title" value="<?php echo $title ?>">
        <div class="red-text">
            <?php echo $errors['title']; ?>
        </div>
        <label for="">Ingredients (comma seperated):</label>
        <input type="text" name="ingredients" value="<?php echo $ingredients ?>">
        <div class="red-text">
            <?php echo $errors['ingredients']; ?>
        </div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>



<?php include('templates/footer.php'); ?>




</html>