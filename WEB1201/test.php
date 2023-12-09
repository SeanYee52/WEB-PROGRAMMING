<?php
session_start();
session_unset();
session_destroy();
?>

<html>
<form action="test.php" method="post" enctype="multipart/form-data">

    <label for="photos">Photos (Upload File):</label>
    <input type="file" id="photos" name="photos[]" accept="image/*" multiple>

    <button type="submit">Submit</button>
</form>
</html>