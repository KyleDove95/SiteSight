<h3>tags tiles</h3>
            
        <section id="tiles_description">
                <p>This page displays all of a tags tiles</p>
        </section>
<?php
    $sql="SELECT tile_name FROM SS_tiles WHERE userID = ? AND tile_name = ?"

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
    echo $row['fieldname']; 
}

?>