<?php
if (isset($_POST['submit'])) {
  try {
    require __DIR__ . "/../common.php";
    require_once __DIR__ . '/../src/DBconnect.php';

    $sql = "SELECT * FROM users WHERE location = :location";
    $location = $_POST['location'] ?? "";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':location', $location, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
  } catch (PDOException $error) {
    $err = $error->getMessage();
  }
}

require "templates/header.php";
?>

<section class="stack-lg">
  <div class="card">
    <h2 class="card__title">Find Users by Location</h2>
    <form method="post" class="form form--inline">
      <label class="field field--inline">
        <span class="field__label">Location</span>
        <input class="input" type="text" id="location" name="location" placeholder="e.g., Dublin">
      </label>
      <button class="btn" type="submit" name="submit" value="1">View Results</button>
      <a class="btn btn--ghost" href="index.php">Back</a>
    </form>
  </div>

  <?php if (isset($_POST['submit'])): ?>
    <?php if (!empty($err)): ?>
      <div class="alert alert--error"> <?php echo htmlspecialchars($err); ?></div>
    <?php elseif (!empty($result) && $statement->rowCount() > 0): ?>
      <div class="card">
        <h3 class="card__title">Results for “<?php echo htmlspecialchars($_POST['location']); ?>”</h3>
        <div class="table-wrap">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row): ?>
              <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>
                <td><?php echo escape($row["location"]); ?></td>
                <td><?php echo escape($row["date"]); ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php else: ?>
      <div class="note">No results found for “<?php echo htmlspecialchars($_POST['location'] ?? ""); ?>”.</div>
    <?php endif; ?>
  <?php endif; ?>
</section>

<?php require "templates/footer.php"; ?>
