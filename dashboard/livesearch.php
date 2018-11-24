<?php
session_start();

require_once('cn.php');
$q = intval($_GET['q']);
$sql="SELECT * FROM usuarios WHERE nombre LIKE '%$q%'";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['apellido'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['telefono'] . "</td>";
    
    echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
