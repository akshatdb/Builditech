<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error"><?= $message ?></div>
<script>$('.message').fadeIn().delay(3000).fadeOut('slow')</script> 
