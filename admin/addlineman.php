<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>NAME</th>
                <th>PHONE</th>   
                <th>INSERT</th>                                   
            </tr>
        </thead>
        <tbody>
                <tr>
                    <form action="generate_lineman.php" method="post" name="form_gen_lineman">
                        <td>                                                
                            <input class="form-control" type="text" name="name" placeholder="ENTER NAME">
                        </td>
                        <td>                                                
                            <input class="form-control" type="text" name="phone" placeholder="ENTER PHONE NO">
                        </td>
                        <td>                                                
                        <select  class="form-control" id="pincode" name="locid" placeholder="select pincode">
                            <option value="600001">600001</option>
                            <option value="620001">620001</option>
                            <option value="625531">625531</option>
                            <option value="632001">632001</option>
                        </select>
                        </td>
                        <td>
                            <button type="submit" name="gen_lineman" class="btn btn-success form-control">INSERT </button>
                        </td>
                    </form>
                </tr>                
            </tbody>                
        </table>
        <?php include("paging_2.php");  ?>
    </div>  