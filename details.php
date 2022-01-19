<?php
include('config/db_connect.php');

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM list WHERE id = $id_to_delete";
    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    }else {
        echo 'query error: '.mysqli_error($conn);
    }
}


if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM list WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $item = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    // print_r($item);
}

?>




<!DOCTYPE html>
<html> 
<?php include('templets/header.php') ?>
<div class='container center grey-text'>
    
<?php if($item): ?>
        <h4 class="center "><?php echo htmlspecialchars($item['title']) ?></h4>
        <p>Created by: <?php echo htmlspecialchars($item['email']) ?></p>
        <p>Created at: <?php echo htmlspecialchars($item['created_at']) ?></p>
        <h5>Date</h5>
        <p> <?php echo htmlspecialchars($item['date']) ?></p>
        <form action="details.php" method='POST'>
            <input type="hidden" name='id_to_delete' value="<?php echo $item['id'] ?>">
            <input type="submit" name='delete' value='delete' class='btn brand z-depth-0'>
        </form>
<?php else: ?>
    <h5>No such item found</h5>        
<?php endif ?>    
</div>

<?php include('templets/footer.php') ?>

</html>