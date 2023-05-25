<h1>Edit Family</h1>
<form method="POST">
    <div>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?= $family->phone ?>">
    </div>
    <div>
        <label for="individuals_number">Individuals Number:</label>
        <input type="text" name="individuals_number" id="individuals_number" value="<?= $family->individuals_number ?>">
    </div>
    <input type="submit" value="Update">
</form>