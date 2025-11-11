<?php
/**
 * Delete a user
 */
require "../common.php";

if (isset($_GET["id"])) {
    try {
        require_once "../src/DBconnect.php";
        $id = $_GET["id"];

        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $success = "User #" . $id . " successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    require_once "../src/DBconnect.php";

    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<h2>Delete Users</h2>

<?php if (!empty($success)) : ?>
  <div class="alert alert--success">✅ <?php echo escape($success); ?></div>
<?php endif; ?>

<?php if (!empty($result)) : ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Age</th>
        <th>Location</th>
        <th>Date</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["firstname"]); ?></td>
          <td><?php echo escape($row["lastname"]); ?></td>
          <td><?php echo escape($row["email"]); ?></td>
          <td><?php echo escape($row["age"]); ?></td>
          <td><?php echo escape($row["location"]); ?></td>
          <td><?php echo escape($row["date"]); ?></td>
          <td>
            <a class="btn btn--ghost"
               href="delete.php?id=<?php echo escape($row["id"]); ?>"
               onclick="return confirm('Are you sure you want to delete user #<?php echo escape($row['id']); ?>?');">
              Delete
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else : ?>
  <div class="note">No users found. Add some first on the <a href="create.php">Create</a> page.</div>
<?php endif; ?>

<p style="margin-top:14px">
  <a class="btn btn--ghost" href="index.php">Back to home</a>
</p>

<?php require "templates/footer.php"; ?>
