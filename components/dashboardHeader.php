
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .hidden-section { display: none; }
        .form-inline .form-group {
            margin-right: 10px;
        }
        .form-inline .btn {
            margin-top: 8px;
        }
        .task-form-group,
        .category-form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .task-form-group .form-control,
        .category-form-group .form-control {
            margin-right: 10px;
        }
    </style>
</head>
<body class="container">
<div class="d-flex justify-content-between align-items-center mt-3">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <a href="../public/index.php" class="btn btn-danger">Logout</a>
</div>

<div class="mt-4">
    <div class="form-inline">
        <button class="btn btn-info" onclick="toggleSection('category-section')">Create Category</button>
        <button class="btn btn-info ml-2" onclick="toggleSection('task-section')">Create Task</button>
    </div>
    <div id="category-section" class="hidden-section mt-2">
        <form action="../public/dashboard.php" method="POST" class="category-form-group">
            <input type="hidden" name="action" value="create_category">
            <div class="form-group mb-0">
                <input type="text" id="category_name" name="name" class="form-control" placeholder="Category Name" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <div id="task-section" class="hidden-section mt-2">
        <form action="../public/dashboard.php" method="POST" class="task-form-group">
            <input type="hidden" name="action" value="create_task">
            <div class="form-group mb-0">
                <input type="text" id="task_title" name="title" class="form-control" placeholder="Task Title" required>
            </div>
            <div class="form-group mb-0">
                <textarea id="task_description" name="description" class="form-control" placeholder="Task Description" required></textarea>
            </div>
            <div class="form-group mb-0">
                <select id="task_category" name="category_id" class="form-control" required>
                    <option value="" disabled selected>Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<div class="mt-4">
    <h2>Your Categories</h2>
    <?php foreach ($categories as $category): ?>
        <div class="d-flex align-items-center mb-2">
            <form action="../public/dashboard.php" method="POST" class="flex-grow-1 d-flex align-items-center">
                <input type="hidden" name="action" value="update_category">
                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                <div class="form-group mb-0 flex-grow-1">
                    <input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning ml-2">Update</button>
            </form>
            <form action="../public/dashboard.php" method="POST" class="ml-2">
                <input type="hidden" name="action" value="delete_category">
                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<div class="mt-4">
    <h2>Your Tasks</h2>
    <form action="../public/dashboard.php" method="GET" class="mb-3">
        <div class="form-group">
            <label for="filter_category">Filter by Category:</label>
            <select id="filter_category" name="category_id" class="form-control">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo ($selectedCategory == $category['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary mt-2">Filter</button>
        </div>
    </form>

    <?php foreach ($tasks as $task): ?>
        <div class="d-flex align-items-center mb-2">
            <form action="../public/dashboard.php" method="POST" class="flex-grow-1 d-flex align-items-center">
                <input type="hidden" name="action" value="update_task">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <div class="form-group mb-0 flex-grow-1">
                    <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" class="form-control" required>
                    <textarea name="description" class="form-control mt-1" required><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning ml-2">Update</button>
            </form>
            <form action="../public/dashboard.php" method="POST" class="ml-2">
                <input type="hidden" name="action" value="delete_task">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
<script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        section.classList.toggle('hidden-section');
    }
</script>
</body>
</html>