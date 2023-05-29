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

            <a href="<?= BASE_PATH . 'create' ?> ">Add Family</a><br>
            <?php
            if (isset($_SESSION['user_type']) and $_SESSION['user_type'] == "admin") {
            ?>
            <a href="<?= BASE_PATH . 'create-user' ?> ">Add Employee</a>
            <?php
            }
            ?>
            <hr>
            <a href="<?= BASE_PATH ?>">All</a><br>
            <?php
            foreach ($locations as $location) {
            ?>
            <a href="<?= BASE_PATH . '?location=' . $location->getId() ?>"><?= $location->getName() ?></a><br>
            <?php
            }
            ?>
            <hr>
            <a href="<?= BASE_PATH . 'show-family-propery-amount' ?>">familyByPropertyAmount</a>

        </div>
        <div class="content">
            <?php
            if (isset($_GET['location'])) {
                foreach ($family_with_location as $family) {
            ?>
            <p><?= "Family Name : " . $family->lname ?></p>
            <p><?= "individuals Number : " . $family->individuals_number ?></p>
            <p><?= "Location : " . $family->location_name ?></p>
            <a href="<?= BASE_PATH . 'delete/' . $family->family_id ?>"><button>Delete</button></a>
            <a href="<?= BASE_PATH . 'edit/' . $family->family_id ?>"><button>Edit</button></a>
            <a href="<?= BASE_PATH . 'add-property/' . $family->family_id ?>"><button>Add Property</button></a>
            <hr>
            <?php
                }
            } else {

                foreach ($families as $family) {
                ?>
            <p><?= "Family Name : " . $family->lname ?></p>
            <p><?= "individuals Number : " . $family->individuals_number ?></p>
            <p><?= "Location : " . $family->location_name ?></p>
            <a href=" <?= BASE_PATH . 'delete/' . $family->family_id ?>"><button>Delete</button></a>
            <a href="<?= BASE_PATH . 'edit/' . $family->family_id ?>"><button>Edit</button></a>
            <a href="<?= BASE_PATH . 'create-property/' . $family->family_id ?>"><button>Add Property</button></a>
            <hr>
            <?php
                }
            }
            ?>
        </div>
        <div>
            <a href="<?= BASE_PATH . 'logout' ?>">Logout</a>
        </div>
    </div>
</body>
<style>
.container {
    display: grid;
    grid-template-columns: 1fr 3fr 1fr;
}
</style>

</html>