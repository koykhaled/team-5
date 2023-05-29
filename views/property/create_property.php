<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create Property</title>
</head>

<body>
    <h1>Create Property</h1>
    <small><?php if (isset($_SESSION['error'])) echo $_SESSION['error'];
            unset($_SESSION['error']); ?></small>
    <form action="" method="post">
        <label for="prop">Property Type:</label>
        <input type="search" id="search" name="prop_type" list="options">
        <datalist id="options">
            <?php
            foreach ($property_type as $prop) {
            ?>
            <option value="<?= $prop ?>">
                <?php
            }
                ?>
        </datalist>
        <label for="planet_amount">Planet Amount : </label>
        <input type="number" name="prop_amount" id="planet_amount">
        <label for="sales">Sales : </label>
        <input type="number" name="prop_earnings" id="sales">
        <input type="submit" value="Create">
    </form>
</body>
<style>
input {
    display: block;
}

small {
    color: red;
}
</style>

</html>