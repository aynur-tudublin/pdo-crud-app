<?php
/**
 * Use an HTML form to edit an entry in the users table.
 */

require "../common.php";

// --- Handle form submission ---
if (isset($_POST['submit'])) {
    try {
        require_once "../src/DBconnect.php";

        $user = [
            "id"        => escape($_POST['id']),
            "firstname" => escape($_POST['firstname']),
            "lastname"  => escape($_POST['lastname']),
            "email"     => escape($_POST['email']),
            "age"       => escape($_POST['age']),
            "location"  => escape($_POST['location']),
        ];

        $sql = "UPDATE users
                SET firstname = :firstname,
                    lastname  = :lastname,
                    email     = :email,
                    age       = :age,
                    location  = :location
                WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// --- Load existing user for editing ---
if (isset($_GET['id'])) {
    try {
        require_once "../src/DBconnect.php";
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <div class="alert alert--success">
     <?php echo escape($_POST['firstname']); ?> successfully updated.
  </div>
<?php endif; ?>

<h2>Edit a User</h2>

<form method="post" class="form">
  <?php foreach ($user as $key => $value) : ?>
    <label class="field" for="<?php echo $key; ?>">
      <span class="field__label"><?php echo ucfirst($key); ?></span>
      <input
        class="input"
        type="text"
        name="<?php echo $key; ?>"
        id="<?php echo $key; ?>"
        value="<?php echo escape($value); ?>"
        <?php echo ($key === 'id' || $key === 'date') ? 'readonly' : ''; ?>
      >
    </label>
  <?php endforeach; ?>

  <div class="actions" style="margin-top: 16px;">
    <input class="btn" type="submit" name="submit" value="Submit">
    <a class="btn btn--ghost" href="update.php">Back</a>
  </div>
</form>

<p style="margin-top: 14px;">
  <a class="btn btn--ghost" href="index.php">Back to home</a>
</p>

<?php require "templates/footer.php"; ?>
