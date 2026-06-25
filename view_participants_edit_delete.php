<?php
include 'dbconnect.php';
?>

<style>
.table tbody tr:hover{
    background:#f8fafc;
}

.table td,
.table th{
    vertical-align:middle;
}

.badge-id{
    padding:8px 12px;
    border-radius:50px;
}

.btn{
    border-radius:10px;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">
            <i class="bi bi-people-fill text-primary"></i>
            Manage Participants
        </h2>

        <p class="text-muted mb-0">
            View, edit and delete participant records.
        </p>

    </div>

</div>

<div class="card">

    <div class="card-header bg-white border-0 py-4">

        <h5 class="mb-0 fw-bold">
            Participant Records
        </h5>

    </div>

    <div class="card-body">

<?php

try {

$conn = new PDO(
    "mysql:host=$servername;port=$port;dbname=$database",
    $username,
    $password
);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM participant");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($result)>0){

echo '

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Power Output</th>
<th>Distance</th>
<th>Actions</th>
</tr>

</thead>

<tbody>

';

foreach($result as $row){

echo '

<tr>

<td>
<span class="badge bg-primary badge-id">
#'.$row["id"].'
</span>
</td>

<td>
<i class="bi bi-person-circle text-primary me-2"></i>
'.$row["firstname"].'  '.$row["surname"].'
</td>

<td class="text-muted">
<i class="bi bi-envelope-fill me-1"></i>
'.$row["email"].'
</td>

<td>
<span class="badge bg-warning text-dark">
'.$row["power_output"].'
</span>
</td>

<td>
<span class="badge bg-success">
'.$row["distance"].'
</span>
</td>

<td>

<a href="edit_participant.php?id='.$row["id"].'"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

</a>

<button
class="btn btn-danger btn-sm ms-2"
onclick="confirmDelete('.$row["id"].')">

<i class="bi bi-trash"></i>

</button>

</td>

</tr>

';

}

echo '

</tbody>

</table>

</div>

';

}
else{

echo '

<div class="alert alert-info text-center">

<i class="bi bi-info-circle"></i>
No participants found.

</div>

';

}

}
catch(PDOException $e){

echo '

<div class="alert alert-danger">

'.$e->getMessage().'

</div>

';

}

?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(id){

Swal.fire({

title:"Delete Participant?",
text:"This action cannot be undone.",
icon:"warning",

showCancelButton:true,

confirmButtonColor:"#dc3545",
cancelButtonColor:"#6c757d",

confirmButtonText:"Delete"

}).then((result)=>{

if(result.isConfirmed){

window.location.href="delete.php?id="+id;

}

});

}

</script>