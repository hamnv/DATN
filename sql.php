<?php
 include'header.php';
// Check if the user is already logged in, if yes then redirect him to welcome page

// Include config file
require_once "config/config.php";
?>
<html> 
    <body>
                            <form action="" method="POST"> 
                            <div class="form-group">
                              <label for="">Tên bài học</label>
                              <input type="text"
                                class="form-control" name="lname" id="" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="">Link</label>
                              <input type="text"
                                class="form-control" name="llink" id="" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted"></small>
                            </div>
                           <div class="form-check">
                               <label class="form-check-label">
                               <input type="radio" class="form-check-input" name="cate" value="checkedValue" checked>
                              <?php var_dump($kq); ?>
                             </label>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <input type="reset" class="btn btn-secondary" value="Reset">
                            <input type="submit" class="btn btn-primary" value="Thêm">
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal them bai hoc -->
    </body>
</html>