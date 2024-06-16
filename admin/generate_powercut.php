<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>CAUSE</th>
                <th>START TIME</th>
                <th>END TIME</th>
                <th>DATE</th>
                <th>PINCODE</th>      
                <th>ADD</th>                             
            </tr>
        </thead>
        <tbody>
                <tr>
                    <form action="generatepc.php" method="post" name="form_gen_powercut">
                        <td>                                                
                            <input class="form-control" type="text" name="cause" placeholder="ENTER CAUSE">
                        </td>
                        <td>                                                
                            <input class="form-control" type="text" name="time1" placeholder="ENTER TIME">
                        </td>
                        <td>                                                
                            <input class="form-control" type="text" name="time2" placeholder="ENTER TIME">
                        </td>
                        <td>                                                
                            <input class="form-control" type="text" name="date" placeholder="ENTER DATE">
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
                            <button type="submit" name="gen_powercut" class="btn btn-success form-control">ADD </button>
                        </td>
                    </form>
                </tr>                
            </tbody>                
        </table>
        <?php include("paging_2.php");  ?>
    </div>  
