<?php foreach ($employees as $employee) : ?>
    <p><?php echo $employee->fname; ?></p>
<?php endforeach; ?>


<?php
$this->db->last_query();
?>