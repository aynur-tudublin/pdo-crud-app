
<?php
/**
 * List all users with a link to edit
 */
try {
    require "../common.php";
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

<h2>Update users</h2>

<?php if (!empty($result)): ?>
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
        <th>Edit</th>
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
            <a class="btn btn--ghost" href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="note">No users found. Try adding some on the <a href="create.php">Create</a> page.</div>
<?php endif; ?>

<p style="margin-top:14px">
  <a class="btn btn--ghost" href="index.php">Back to home</a>
</p>

<?php require "templates/footer.php"; ?>
