<?php
if (isset($_POST['submit'])) {
    require __DIR__ . "/../common.php";
    try {
        require_once __DIR__ . '/../src/DBconnect.php';
        $new_user = array(
            "firstname" => escape($_POST['firstname'] ?? ""),
            "lastname"  => escape($_POST['lastname'] ?? ""),
            "email"     => escape($_POST['email'] ?? ""),
            "age"       => escape($_POST['age'] ?? ""),
            "location"  => escape($_POST['location'] ?? "")
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
        $created_ok = true;
    } catch (PDOException $error) {
        $err = $error->getMessage();
    }
}

require "templates/header.php";
?>

<section class="card">
  <h2 class="card__title">Add a User</h2>

  <?php if (!empty($created_ok)): ?>
    <div class="alert alert--success">
        <strong><?php echo $new_user['firstname']; ?></strong> successfully added.
    </div>
  <?php elseif (!empty($err)): ?>
    <div class="alert alert--error">
        <?php echo htmlspecialchars($err); ?>
    </div>
  <?php endif; ?>

  <form method="post" class="form">
    <div class="grid">
      <label class="field">
        <span class="field__label">First Name</span>
        <input class="input" type="text" name="firstname" required>
      </label>

      <label class="field">
        <span class="field__label">Last Name</span>
        <input class="input" type="text" name="lastname" required>
      </label>
    </div>

    <label class="field">
      <span class="field__label">Email Address</span>
      <input class="input" type="email" name="email" required>
    </label>

    <div class="grid">
      <label class="field">
        <span class="field__label">Age</span>
        <input class="input" type="number" name="age" min="0" step="1">
      </label>

      <label class="field">
        <span class="field__label">Location</span>
        <input class="input" type="text" name="location">
      </label>
    </div>

    <div class="actions">
      <button class="btn" type="submit" name="submit" value="1">Save</button>
      <a class="btn btn--ghost" href="index.php">Back</a>
    </div>
  </form>
</section>

<?php include "templates/footer.php"; ?>
