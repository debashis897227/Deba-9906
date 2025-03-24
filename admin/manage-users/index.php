<?php include "../includes/header.php" ?>
<?php include "../includes/nav.php" ?>
<?php include "../../includes/db.php" ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-table me-1"></i>
                        Users
                    </div>
                    <div class="col-6">
                        <a href="add.php" class="btn btn-secondary btn-sm float-end">Add admin</a>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <?php
                // Fetch users from the database
                $query = "SELECT id, name, email, role, is_active FROM users";
                $result = mysqli_query($conn, $query);
                ?>

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td>
                                    <a href="update_details.php?id=<?= $row['id']; ?>" class="text-primary">
                                        <?= $row['id']; ?>
                                    </a>
                                </td>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['role']; ?></td>
                                <td>
                                    <form method="POST" action="toggle_status.php" class="d-inline">
                                        <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                                        <button type="submit" class="btn btn-sm <?= $row['is_active'] ? 'btn-success' : 'btn-secondary'; ?>">
                                            <?= $row['is_active'] ? 'Active' : 'Inactive'; ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>