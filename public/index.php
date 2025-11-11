<?php include "templates/header.php"; ?>

<section class="stack-lg">
  <div class="card">
    <h2 class="card__title">Actions</h2>
    <ul class="list">
      <li><a class="btn" href="create.php">Create</a> <span class="muted"> - add a user</span></li>
      <li><a class="btn btn--ghost" href="read.php">Read</a> <span class="muted"> - find a user</span></li>
      <li><a class="btn btn--ghost" href="update.php">Update</a> <span class="muted"> - edit a user</span></li>
      <li><a class="btn btn--ghost" href="delete.php">Delete</a> <span class="muted"> - delete a user</span></li>
    </ul>
  </div>

  <div class="note">
    <strong>Tip:</strong> Use “Create” to insert a few test users, then “Read” to filter by <em>Location</em>.
  </div>
</section>

<?php include "templates/footer.php"; ?>
