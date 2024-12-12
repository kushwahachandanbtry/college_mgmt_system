<?php 

if( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM notice WHERE id = '{$id}'";
    $result = mysqli_query( $conn, $sql );
    if( mysqli_num_rows( $result ) > 0 ) {
        while ( $row = mysqli_fetch_assoc( $result ) ) {
            ?>
            <div class="notice text-center">
                <div class="icons">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h4><?php echo $row['title']; ?></h4>
                <p><?php echo $row['details']; ?></p>
                <h5>By: <span><?php echo $row['posted_by']; ?> -  On: <?php echo $row['date']; ?></span></h5>
            </div>
            <?php
        }
    }
}
