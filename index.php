<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/content.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/js/fontawesome.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.js"></script>

    <script src="js/main.js"></script>

    <title>Kirilenko Proj-2</title>
    <link href="favicon.ico" rel="icon" type="image/ico"/>
</head>

<?php
require __DIR__ . '/php/db_manager.php';
$db = new DBManager();
$tab = "about"; // default tab
if (isset($_GET['tab'])) {
    $tab = $_GET['tab'];
}
$tab_content = file_get_contents("sections/".$tab.".html");
$msg_font_style = date('N') <= 5 ? 'nav-workday' : 'nav-weekend';

$id    = isset($_POST['id'])    ? $_POST['id']    : 404592;
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$sname = isset($_POST['sname']) ? $_POST['sname'] : '';
$mid1  = isset($_POST['mid1'])  ? $_POST['mid1']  : 5;
$mid2  = isset($_POST['mid2'])  ? $_POST['mid2']  : 5;
$final = isset($_POST['final']) ? $_POST['final'] : 5;
?>
<body>

<header>
    <nav class="navbar navbar-dark fixed-top bg-dark">
        <a class="navbar-brand"><b>KiviCode</b>'s awesome web-site</a>
        <span class="navbar-brand">
            Today:
            <span class="<?php echo($msg_font_style) ?>">
                <?php echo date('d l, M Y'); ?>
            </span>
        </span>
    </nav>
</header>

<div class="navbar-vert">
    <ul class="nav flex-column navbar-dark bg-dark">
        <li class="nav-item">
            <a class="nav-link <?php if($tab == 'about') echo('navbar-vert-active')?>" href="?tab=about">
                <i class="far fa-fw fa-address-card"></i><span>About</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($tab == 'books') echo('navbar-vert-active')?>" href="?tab=books">
                <i class="fas fa-fw fa-book"></i><span>Books</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($tab == 'courses') echo('navbar-vert-active')?>" href="?tab=courses">
                <i class="fas fa-fw fa-university"></i><span>Courses</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($tab == 'database') echo('navbar-vert-active')?>" href="?tab=database">
                <i class="fas fa-fw fa-database"></i><span>Database</span>
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
<?php
if($tab == "database") {
    echo sprintf($tab_content, $id, $fname, $sname, $mid1, $mid2, $final);

    if (isset($_POST['action'])) {
        $action_type = $_POST['action'];
        switch($action_type) {
            case "add": {
                $db->add($id, $fname, $sname, $mid1, $mid2, $final);
                break;
            }
            case "delete": {
                $db->delete($id);
                break;
            }
            default: {
                echo "<div class='alert alert-warning' role='alert'>Unknown operation: {$action_type}</div>";
                break;
            }
        }
    }
    $db->print_table();
} else {
    echo $tab_content;
}
?>
</div>

<footer class="bg-light text-lg-start">
  <div class="p-3 footer-text text-center <?php echo($msg_font_style) ?>">
        <?php
        if (date('H') >= 18 || true) {
            $file = file("phrases.txt");
            echo "Phrase of the day:<i>";
            echo $file[rand(0, count($file) - 1)];
            echo "</i>";
        } else {
            echo '© 2022 Copyright: <a class="text-dark" href="https://kivicode.dev/">Vladimir Kirilenko</a>';
        }
        ?>
  </div>
</footer>

</body>
</html>
