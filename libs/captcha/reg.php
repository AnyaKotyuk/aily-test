session_start();
if($_POST['kapcha'] != $_SESSION['rand_code']) echo "NO";
else echo "YES";