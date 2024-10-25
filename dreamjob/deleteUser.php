<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
            font-family: "Arial";
        }
        input {
            font-size: 1.2em;
            height: 40px;
            width: 200px;
        }
    </style>
</head>
<body>
    <?php
    // Fetch the user information by ID
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $user = fetchUserById($pdo, $userId);

        if ($user) {
    ?>
    <h1>Are you sure you want to delete this user?</h1>
    <div>
        <p>First Name: <?php echo $user['FirstName']; ?></p>
        <p>Last Name: <?php echo $user['LastName']; ?></p>
        <p>Date of Birth: <?php echo $user['DateOfBirth']; ?></p>
        <p>Gender: <?php echo $user['Gender']; ?></p>
        <p>School: <?php echo $user['School']; ?></p>
        <p>Current Course: <?php echo $user['CurrentCourse']; ?></p>
        <p>Dream Profession: <?php echo $user['DreamProfession']; ?></p>
        <p>Dream Company: <?php echo $user['DreamCompany']; ?></p>
        <p>Skills: <?php echo $user['Skills']; ?></p>
        <p>Years of Experience: <?php echo $user['YearOfExperience']; ?></p>

        <form action="core/handleForms.php" method="POST">
             <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            <input type="submit" name="deleteUserBtn" value="Delete">
        </form>

        <a href="index.php">Cancel</a>
    </div>
    <?php 
        } else {
            echo "User not found.";
        }
    } else {
        echo "Invalid request.";
    }
    ?>
</body>
</html>
        