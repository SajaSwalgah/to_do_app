<?php

include('config/db_connect.php');

$errors = array('title'=>'', 'date'=>'', 'email'=>'', 'priority'=>'');
$title = $date = $email = $priority = '';
if(isset($_POST['submit'])){
    if(empty($_POST['title'])){
        $errors['title'] = 'a title is required';
    } else{
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    if(empty($_POST['date'])){
        $errors['date'] = 'a date is required';
    } else{
        $date = $_POST['date'];
			if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $date)){
				$errors['date'] = 'date must be a comma separated day and time';
			}
    }

    if(empty($_POST['priority'])){
        $errors['priority'] = 'a priority is required';
    } else{
        $priority = $_POST['priority'];
        $errors['priority'] = '';
    }

    if(empty($_POST['email'])){
        $errors['email'] = 'a email is required';
    } else{
        $email = $_POST['email'];
        if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'email must be a valid email';
        }
    }
    if(!array_filter($errors)){
        // to prevent any harmful sql injection
        $title = mysqli_real_escape_string($conn, $_POST['title']); 
        $date = mysqli_real_escape_string($conn, $_POST['date']); 
        $email = mysqli_real_escape_string($conn, $_POST['email']); 
        $priority = mysqli_real_escape_string($conn, $_POST['priority']); 

        // create sql 
        $sql = "INSERT INTO list(title,date,email,priority) VALUES('$title', '$date', '$email', '$priority')";
        
        // save to DB 
        if(mysqli_query($conn,$sql)){
            header('Location: index.php');
        }else {
            echo 'query error: '.mysqli_error($conn);
        }
    }
}


?>

<!DOCTYPE html>
<html> 
<?php include('templets/header.php') ?>
<section class='container grey-text'>
    <h4 class="center">Add To Do</h4>
    <form action="add.php" method='POST' class="white">
        <label for="">To Do Title</label>
        <input type="text" name='title' value='<?php echo htmlspecialchars($title); ?>'>
        <div class="red-text"><?php echo $errors['title']; ?></div> 
        <label for="">date</label>
        <input type="text" name='date' value='<?php echo htmlspecialchars($date); ?>' placeholder='day, 00:00'>
        <div class="red-text"><?php echo $errors['date']; ?></div> 
        <label for="">Email</label>
        <input type="text" name='email' value='<?php echo htmlspecialchars($email); ?>'>
        <div class="red-text"><?php echo $errors['email']; ?></div> 
        <label for="">Priority</label>
        <input type="text" name='priority' value='<?php echo htmlspecialchars($priority); ?>'>
        <div class="red-text"><?php echo $errors['priority']; ?></div> 
        <div class='center'>
            <input type="submit" name='submit' value='submit' class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include('templets/footer.php') ?>

</html>