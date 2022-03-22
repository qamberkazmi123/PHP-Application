<?php  
$pdo = new PDO('mysql:host=localhost; port=3306; dbname=company' , 'root' , '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM CUSTOMER');
$statement->execute();
$customers = $statement->fetchAll(PDO::FETCH_ASSOC);

$declaration = $pdo->prepare('SELECT * FROM orders');
$declaration->execute();
$orders = $declaration->fetchAll(PDO::FETCH_ASSOC);

$affirmation = $pdo->prepare('SELECT *
FROM orders
 JOIN customer
ON orders.cid=customer.cid;');
$affirmation->execute();
$all = $affirmation->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

  <title>iNotes - Notes taking made easy</title>
  <style>
    h2{
      text-align: center;
      font-family: "Sofia", sans-serif;
      font-weight: bold;
      margin: 10px
    }
    p{
      padding: 20px;
    }
  </style>
</head>

<body>
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/crud/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <!-- <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?> -->
 
 
  <!-- hf -->
  
  <!-- oooo -->

  <h2>Customers List</h2>
  
 <p>
   <a href="./create.php">
   <button type="button" class="btn btn-warning">Enter Customer Record</button>
   </a>
 </p>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">C_ID</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Living</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

      <!-- Read Setup -->
        <?php 
      
        foreach ($customers as $i => $customer){ ?>
          <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $customer['cid'] ?></td>
            <td><?php echo $customer['cname'] ?></td>
            <td><?php echo $customer['living'] ?></td>
            <td>
              <a href="update.php?id=<?php echo $customer['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              <form style="display:inline-block" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $customer['id'] ?>" >              
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>              
              </form>
            </td>
          </tr>
       <?php } ?>
      </tbody>
    </table>
</div>

<!-- hmm -->
<h2>Orders List</h2>
<p>
   <a href="./make.php">
   <button type="button" class="btn btn-warning">Enter Order Record</button>
   </a>
 </p>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">O_ID</th>
          <th scope="col">C_ID</th>
          <th scope="col">O_Price</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

      <!-- Read Setup -->
        <?php 
      
        foreach ($orders as $i => $order){ ?>
          <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $order['oid'] ?></td>
            <td><?php echo $order['cid'] ?></td>
            <td><?php echo $order['oprice'] ?></td>
            <td>
              <form style="display:inline-block" action="remove.php" method="post">
                <input type="hidden" name="sno" value="<?php echo $order['sno'] ?>" >              
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>              
              </form>
            </td>
          </tr>
       <?php } ?>
      </tbody>
    </table>
</div>

<!-- hmm -->
<h2>Branch List</h2>
<p>
   <a href="./generate.php">
   <button type="button" class="btn btn-warning">Enter Branch Record</button>
   </a>
 </p>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">I.No</th>
          <th scope="col">Branch Name</th>
          <th scope="col">O_ID</th>
          <th scope="col">Sales</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
    <h6>Branch body is yet empty</h6>
</div>

<!-- ahhm -->
<h2>Customers which put in order</h2>
<div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">C_ID</th>
          <th scope="col">Customer Name</th>
          <th scope="col">City</th>
          <th scope="col">O_ID</th>
          <th scope="col">Order Price</th>
          <th scope="col">Acti</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

      <!-- Read Setup -->
        <?php 
      
        foreach ($all as $i => $al){ ?>
          <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $al['cid'] ?></td>
            <td><?php echo $al['cname'] ?></td>
            <td><?php echo $al['living'] ?></td>
            <td><?php echo $al['oid']?></td>
            <td><?php echo $al['oprice'] ?></td>
            <td>
             <p>Hmmmm</p>
            </td>
          </tr>
       <?php } ?>
      </tbody>
    </table>
</div>



  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${cid}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>
