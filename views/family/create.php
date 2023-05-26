<h1>Create Family!!</h1>

<?php
if (isset($_SESSION['error'])) {
    echo '<small>' . $_SESSION['error'] . '</small>';
}
echo "<form method='POST'>";
echo "<label>First name:</label><br>";
echo "<input type='text' name='fname'><br>";
echo "<label>Middel name:</label><br>";
echo "<input type='text' name='mname'><br>";
echo "<label>Last name:</label><br>";
echo "<input type='text' name='lname'><br>";
echo "<label>Phone:</label><br>";
echo "<input type='text' name='phone'><br>";
echo "<label>Individuals Number:</label><br>";
echo "<input type='number' name='individuals_number'><br>";
?>
<label for="status">Is Employee : </label><br>
<input type="radio" name="status" value="employee" id="emp">
<label for="n">Employee </label>
<input type="radio" name="status" value="not_Employee" id="n">
<label for="emp">Not Employee </label><br>
<select name="location">
    <?php
    foreach ($locations as $location) {

    ?>

    <option value="<?= $location->getId() ?>"><?= $location->getName() ?></option>
    <?php
    }
    ?>
</select>
<?php
echo '<br>';
echo "<button type='submit'>Create</button>";
echo "</form>";
?>

<style>
small {
    color: red;
}
</style>
