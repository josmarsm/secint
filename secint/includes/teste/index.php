<div class="thumbnail">
    <h4 style="color:#F63"> Insert or add data in a multiple mysql tables with php pdo and bootstrap.</h4>
    <form method="post" action="upload.php"  enctype="multipart/form-data">
        <table class="table1">
            <tr>
                <td><label style="color:#3a87ad; font-size:18px;"  > Descrição</label></td>
                <td width="30"></td>
                <td><input type="text" name="doc_descricao" placeholder="descricao"  class="form-control" required /></td>
            </tr>
            <tr>
                <td><label style="color:#3a87ad; font-size:18px;"  > Subcritério</label></td>
                <td width="30"></td>
                <td><input type="text" name="doc_subcriterio" placeholder="categoria"  class="form-control" required /></td>
            </tr>
            <tr>
                <td><label style="color:#3a87ad; font-size:18px;">Pontuação Solicitada</label></td>
                <td width="30"></td>
                <td><input type="text" name="doc_valor" placeholder="valor"  class="form-control" required /></td>
            </tr>
            <tr>
                <td><label style="color:#3a87ad; font-size:18px;">Select  Image</label></td>
                <td width="30"></td>
                <td><input type="file" name="doc_file"></td><!-- this file is going to save on uploads folder. create it if you have not created -->
            </tr>        
        </table> 
        <button type="submit" name="Submit" class="btn btn-success">Submit</button>   
    </form>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Image Title</th>
            <th>Categories Title</th>
            <th>Images</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>  
    <?php
    include('db.php');
    //query for selecting database table

    $results = $db_con->prepare("select c.* , p.* from categories c, posts p where c.cat_id= p.cat_id LIMIT 0 , 10");
    $results->execute();
    // this while statement displays rows of database table
    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        ?>   

        <tbody>
            <tr>
                <td><?php echo $row['post_title']; ?></td>
                <td><?php echo $row['image_title']; ?></td>
                <td><?php echo $row['cat_title']; ?></td>
                <td><img src="uploads/<?php echo $row['post_image']; ?>" class="img-rounded" alt="image" style="width:60px" height="60px;">
                </td>
                <td> <a href="editform.php?id=<?php echo $row['post_id']; ?>" class="btn btn-warning">Update</a></td>
                <td><a href="delete.php?post_id=<?php echo $post_id; ?>" class="btn btn-danger">Delete</a> </td>

            </tr>
        </tbody>
        <?php
    }
    ?>   
</table>
<br />