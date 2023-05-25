<h1>Delete Family</h1>
<p>are you sure to delete <?= $family->lname?>??</p>
<form method="post" action="?action=delete_family">
    <input type="hidden" name="id" value="<?= $family->getId() ?>">
    <button>Delete</button>
</form>