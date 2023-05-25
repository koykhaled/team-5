<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family</title>
</head>

<body>

    <div class="container">
        <div class="sidebar">
            <a href="<?= BASE_PATH ?>">
                <h1>Family</h1>
            </a>

            <a href="<?= BASE_PATH . 'create' ?> ">Add Family</a>
            <hr>
            <a href="<?= BASE_PATH ?>">All</a><br>
            <?php
            foreach ($locations as $location) {
            ?>
            <a href="<?= BASE_PATH . '?location=' . $location->getId() ?>"><?= $location->getName() ?></a><br>
            <?php
            }
            ?>

        </div>
        <div class="content">
            <?php
            if (isset($_GET['location'])) {
                foreach ($family_with_location as $family) {
            ?>
            <p><?= "Family Name : " . $family->lname ?></p>
            <p><?= "individuals Number : " . $family->individuals_number ?></p>
            <a href="<?= BASE_PATH . 'delete/' . $family->id ?>"><button>Delete</button></a>
            <a href="<?= BASE_PATH . 'edit/' . $family->id ?>"><button>Edit</button></a>
            <hr>
            <?php
                }
            } else {

                foreach ($families as $family) {
                ?>
            <p><?= "Family Name : " . $family->getLname() ?></p>
            <p><?= "individuals Number : " . $family->getPersonNumber() ?></p>
            <p><?= "Location : " . $family->getLocId() ?></p>
            <a href=" <?= BASE_PATH . 'delete/' . $family->getId() ?>"><button>Delete</button></a>
            <a href="<?= BASE_PATH . 'edit/' . $family->getId() ?>""><button>Edit</button></a>
            <hr>
            <?php
                }
            }
            ?>
        </div>
        <div></div>
    </div>
</body>
<style>
.container {
    display: grid;
    grid-template-columns: 1fr 3fr 1fr;
}
</style>

</html>