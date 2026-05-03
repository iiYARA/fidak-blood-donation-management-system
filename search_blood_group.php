<?php
if (!isset($_POST['blood']) || empty($_POST['blood'])) {
    die('<div class="alert alert-danger">Blood group not provided.</div>');
}

$bg = $_POST['blood'];
$conn = mysqli_connect("localhost", "root", "", "fidak_bbms") or die("Connection error");

$sql = "SELECT * FROM donor_details 
        JOIN blood ON donor_details.donor_blood = blood.blood_group
        WHERE blood.blood_group = '{$bg}' 
        ORDER BY rand() 
        LIMIT 5";

$result = mysqli_query($conn, $sql) or die("query unsuccessful.");

if (mysqli_num_rows($result) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="col-lg-4 col-sm-6 portfolio-item"><br>
            <div class="card" style="width:300px">
            <img class="card-img-top" 
     src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=300&fit=crop" 
     alt="Blood donation card"
     style="width:100%;height:300px;object-fit:cover">                
     <div class="card-body">
                    <h3 class="card-title"><?php echo $row['donor_name']; ?></h3>
                    <p class="card-text">
                        <b>Blood Group : </b> <b><?php echo $row['blood_group']; ?></b><br>
                        <b>Mobile No. : </b> <?php echo $row['donor_number']; ?><br>
                        <b>Gender : </b><?php echo $row['donor_gender']; ?><br>
                        <b>Age : </b> <?php echo $row['donor_age']; ?><br>
                        <b>Address : </b> <?php echo $row['donor_address']; ?><br>
                    </p>
                </div>
            </div>
        </div>
<?php
    }
    echo '</div>';
} else {
    echo '<div class="alert alert-danger">No Donor Found For your search Blood group</div>';
}
?>