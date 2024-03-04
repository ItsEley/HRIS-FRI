<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h1>Employee List</h1>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?php echo $employee->email; ?></td>
                <td><?php echo $employee->password; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
