<?php 
require('includes/header.php');

?>

<div>



<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
</div>
<div class="card-body">
<div class="table-responsive">
    <form action="add_cate.php" method="GET">
    <button class="btn btn-success " type="submit"
                                           >
                                            Thêm mới
                                        </button>
    </form>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Chỉnh sửa</th>
            </tr>
        </thead>
        
        <tbody>
<?php 
    require('../db/conn.php');
    $sql_str = "select * from category order by id";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>

        
            <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['name']?></td>
                <td>
                    <a class="btn btn-warning" href="edit_cate.php?id=<?=$row['id']?>">Edit</a>  
                    <a class="btn btn-danger" 
                        href="delete_cate.php?id=<?=$row['id']?>"
                         onclick="return confirm('Bạn chắc chắn muốn xóa mục này?');">Delete</a>


                </td>
                
                
                    
                
            </tr>
            <?php
    }
    ?>                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
         

<?php
require('includes/footer.php');
?>