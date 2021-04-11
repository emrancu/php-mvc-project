
<?php
include_once 'layout/header.php';
?>

<div class="main-content container mt-5" style="max-width:400px">

    <h2>Database Setup</h2>
    <form action="<?php echo url('database-setup') ?>" method="post">
        <div class="form-group">
            <label>Database Host:</label>
            <input type="text" class="form-control" placeholder="Database Name" required name="database_host" value="localhost">
        </div>
        <div class="form-group">
            <label>Database Name:</label>
            <input type="text" class="form-control" placeholder="Database Name" required name="database_name">
        </div>
        <div class="form-group">
            <label>Database User Name:</label>
            <input type="text" class="form-control" placeholder="Database User Name" required name="user_name">
        </div>

        <div class="form-group">
            <label>Database Password:</label>
            <input type="password" class="form-control" placeholder="Database Password"  name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>



<?php
include_once 'layout/footer.php';
?>
