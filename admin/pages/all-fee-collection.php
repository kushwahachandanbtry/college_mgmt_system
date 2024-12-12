<div class="search-box">
    <form class="py-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" target="_self">
        <input type="text" value="" placeholder="Search by ID" name="id" class="px-5 py-1">
        <input type="text" value="" placeholder="Search by Name" name="name" class="mx-5 px-5 py-1">
        <input type="text" value="" placeholder="Search by Phone" name="phone" class="px-5 py-1">
        <button type="submit" name="save" class="btn btn-warning">Search</button>
    </form>
</div>

<?php

if( isset( $_POST['save'] ) ) {
$id       = $_POST['id'];
$name       = $_POST['name'];
$phone      = $_POST['phone'];

}
?>

<table class="table table-striped table-hover">
    <tr>
        
        <th><input type="checkbox"> ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Class</th>
        <th>Section</th>
        <th>Expenses</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Phone</th>
        <th>Email</th>
    </tr>
    <tr>
        <td><input type="checkbox">111</td>
        <td>ram</td>
        <td>male</td>
        <td>BBA</td>
        <td>A</td>
        <td>Class Test</td>
        <td>shyam</td>
        <td><button class="btn btn-primary">Paid</button></td>
        <td>9876567890</td>
        <td>ram@gmail.com</td>
    </tr>
    <tr>
        <td><input type="checkbox">111</td>
        <td>ram</td>
        <td>male</td>
        <td>BBA</td>
        <td>A</td>
        <td>Class Test</td>
        <td>shyam</td>
        <td><button class="btn btn-danger">paid</button></td>
        <td>9876567890</td>
        <td>ram@gmail.com</td>
    </tr>
    <tr>
        <td><input type="checkbox">111</td>
        <td>ram</td>
        <td>male</td>
        <td>BBA</td>
        <td>A</td>
        <td>Class Test</td>
        <td>shyam</td>
        <td><button class="btn btn-primary">Paid</button></td>
        <td>9876567890</td>
        <td>ram@gmail.com</td>
    </tr>
    <tr>
        <td><input type="checkbox">111</td>
        <td>ram</td>
        <td>male</td>
        <td>BBA</td>
        <td>A</td>
        <td>Class Test</td>
        <td>shyam</td>
        <td><button class="btn btn-danger">paid</button></td>
        <td>9876567890</td>
        <td>ram@gmail.com</td>
    </tr>
</table>

<div class="pegination py-5">
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</div>