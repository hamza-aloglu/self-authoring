<script>
<?php if (isset($token)): ?>
    localStorage.setItem('token', '<?php echo $token ?>');
<?php endif; ?>
<?php if (isset($logout)): ?>
    localStorage.clear();
<?php endif; ?>
</script>