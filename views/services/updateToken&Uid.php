<script>
<?php if (isset($token, $uid)): ?>
    localStorage.setItem('token', '<?php echo $token ?>');
    localStorage.setItem('uid', '<?php echo $uid ?>');
<?php endif; ?>
<?php if (isset($logout)): ?>
    localStorage.clear();
<?php endif; ?>
</script>