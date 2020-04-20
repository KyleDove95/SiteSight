<h3>Users Tags</h3>
            
        <section id="tags_description">
                <p>This page displays all of a users tags</p>
        </section>
<?php
    $sql="SELECT tag_name FROM SS_tags WHERE userID = ?"

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
    echo $row['fieldname']; 
}

?>