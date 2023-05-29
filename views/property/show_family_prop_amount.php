<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>family Property Amount</title>
</head>

<body>
    <form action="" method="post">
        Property Amount :<input type="text" name="amount">
        <button>Show</button>
    </form>

    <?php
    if (isset($families_property_by_amount)) {


        foreach ($families_property_by_amount as $family) {
    ?>
    <p><?= "Family Name : " . $family->lname ?></p>
    <p><?= "individuals Number : " . $family->individuals_number ?></p>
    <p><?= "Location : " . $family->location_name ?></p>
    <p><?= "prop_amount : " . $family->prop_amount ?></p>

    <hr>
    <?php
        }
    }
    ?>
</body>

</html>