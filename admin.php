<?php include('View/base_header.php'); ?>
<?php include('App/ModelCreator.php'); ?>

<form method="post" action="">
    Model name : <input type="text" name="name">
    Fields : <input type="text" name="fields">
    <input type="submit" value="Save">
</form>

<?php
if (isset($_POST['name']) && isset($_POST['fields'])) {
    new ModelCreator($_POST['name'], );
}
?>

<?php include('View/base_footer.php'); ?>