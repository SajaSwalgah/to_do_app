
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