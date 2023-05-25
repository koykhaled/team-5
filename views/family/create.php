<?php
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