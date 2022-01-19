<?php 

include('config/db_connect.php');

// to get all the list
$sql = 'SELECT title, date, priority, id FROM list ORDER BY created_at';

// to get the result
$result = mysqli_query($conn, $sql);

// fetch result rows into an array
$list = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory==> not important but good practice
mysqli_free_result($result);
// close connection
mysqli_close($conn);

// session_start();
// $_SESSION['name']= 'saja';
// echo $_SESSION['name'];


?>

<!DOCTYPE html>
<html> 
<?php include('templets/header.php') ?>
<h4 class="center grey-text">To Do List</h4>
<div class='container'>
    <div class='row'>
        <?php foreach($list as $row): ?>
            <div class='col s6 md3'>
                <div class='card z-depth-0'>
                <img src="https://www.shutterstock.com/image-vector/do-list-plan-reminder-hand-drawn-562119679"class="item" alt="item">
                    <div class='card-content center'>
                        <h6><?php echo htmlspecialchars($row['title']) ?></h6>
                        <ul>
                            <?php foreach(explode(',', $row['date']) as $time) : ?>
                                <li><?php echo htmlspecialchars($time) ?></li>
                            <?php endforeach?>   
                        </ul>
                    </div>
                    <div class='card-action right-align'>
                        <a href="details.php?id=<?php echo $row['id'] ?>" class="brand-text">more info</a>
                    </div>
                </div>
            </div>
        <?php endforeach?>

        <?php if(count($list) >= 3 ):?>
            <p>There are 3 or more To Do items</p>
        <?php else:?>
            <p>There are less than 3 To Do items</p>
        <?php endif?>    
    </div>
</div>
<?php include('templets/footer.php') ?>

</html>