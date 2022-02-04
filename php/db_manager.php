<?php

class DBManager {

    private $conn = null;
    private $add_query_head = "INSERT INTO grades (id, `First name`, `Last name`, `Midterm 1`, `Midterm 2`, `Course final`) VALUES (";

    function __construct() {
        $this->conn = mysqli_connect('localhost', 'kivicode', 'lululu23', 'kivicode');
    }

    function __destruct() {
        mysqli_close($this->conn);
    }

    function fetch() {
        return mysqli_query($this->conn, 'SELECT * FROM grades');
    }

    function add($id, $fname, $sname, $m1, $m2, $grade) {
        $query = $this->add_query_head . "$id, '$fname', '$sname', $m1, $m2, $grade);";
        $res = mysqli_query($this->conn, $query);
        if ($res) {} else {
            echo "<div class='alert alert-danger' role='alert'>Unable to add a row: " . mysqli_error($this->$conn) . "</div>";
            return;
        }
        echo "<div class='alert alert-success' role='alert'>Row added successfully</div>";
    }

    function delete($id) {
        $res = mysqli_query($this->conn, "DELETE FROM grades WHERE id={$id}");
        if ($res) {} else {
            echo "<div class='alert alert-danger' role='alert'>Failed to delete a row: " . mysqli_error($this->$conn) . "</div>";
            return;
        }
        echo "<div class='alert alert-success' role='alert'>Row {$id} removed successfully</div>";
    }

    function print_table() {
        $result = $this->fetch();
        if ($result) {} else {
            echo "<div class='alert alert-danger' role='alert'>Unable to fetch database: '" . mysqli_error($this->$conn) . "</div>";
            return;
        }

        echo "<table class='table table-striped table-bordered table-hover' id='db-table'>";
        echo "<thead><tr>";
        echo "<td>Id</td>";
        echo "<td>First name</td>";
        echo "<td>Last name</td>";
        echo "<td>Midterm 1</td>";
        echo "<td>Midterm 2</td>";
        echo "<td>Final grade</td>";
        echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['First name']."</td>";
            echo "<td>".$row['Last name']."</td>";
            echo "<td>".$row['Midterm 1']."</td>";
            echo "<td>".$row['Midterm 2']."</td>";
            echo "<td>".$row['Course final']."</td>";
            echo"</tr>";
        }
        echo "</table>";
    }
};

?>
