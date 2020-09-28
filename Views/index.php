<b>Testing Form on Views/index.php</b>
<br><br>
<form action="" method="POST">
    <input type="text" name="name" id="name">
    <input type="submit">
</form>
<hr>

<?php if($params) {print_r($params);} ?>