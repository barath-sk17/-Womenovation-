<?php
include 'dB.php';

if ( $_GET[ 'act' ] == 'submit' ) {

    $case = $_POST[ 'case_category' ];
    $datetime = $_POST[ 'datetime' ];
    $location = $_POST[ 'location' ];
    $description = $_POST[ 'description' ];
    $evidence = $_POST[ 'evidence' ];

    // $myfile = $_FILES[ 'myfile' ];

    $sql = "INSERT INTO complaint (casecat, datetime, location, description, evidence)
VALUES ('".$case."', '".$datetime."', '".$location."','".$description."', '".$evidence."')";

    if ( mysqli_query( $conn, $sql ) ) {
        $last_id = mysqli_insert_id( $conn );

        $total = count( $_FILES[ 'myfile' ][ 'name' ] );

        $InsertVal = true;

        // Loop through each file
        for ( $i = 0 ; $i < $total ; $i++ ) {

            //Get the temp file path
            $tmpFilePath = $_FILES['myfile']['tmp_name'][$i];

            //Make sure we have a file path
            if ( $tmpFilePath != '' ) {
                //Setup our new file path
                $filename = $_FILES['myfile']['name'][$i].'_'.$last_id;
                $newFilePath = 'uploads/' . $filename;

                //Upload the file into the temp dir
                if (move_uploaded_file( $tmpFilePath, $newFilePath ) ) {

                    $sql1 = "insert into evident_files (complaint_id, file) values (".$last_id.", '".$filename."')";
                    $insert = mysqli_query($conn, $sql1);

                    if ($insert) {
                        $InsertVal = false;
                    }
                }
            }
        }
        if ( !$InsertVal ) {
            header("location:home.html");
        }
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error( $conn );
    }

    mysqli_close( $conn );
}
?>
