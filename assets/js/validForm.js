function validAddAdmin() {
    var x = document.forms["add-adm"]["account"].value;
    var y = document.forms["add-adm"]["password"].value;
    if (x == "" && y == "") {
        document.getElementById("notify").innerHTML =
            "<p style=\"color:red\">Tài khoản và mật khẩu trống!! </p>";
            return false;
    } else {
        if (x == "") {
            document.getElementById("notify").innerHTML = "<p style=\"color:red\"> Xin hãy điền tài khoản</p>";
            return false;
        } else if(y == "") {
            document.getElementById("notify").innerHTML = "<p style=\"color:red\"> Xin hãy điền mật khẩu</p>";
            return false;
        } 
        else return true;
    }

}

function validAddCategory() {
    var cate = document.getElementById("category").value;
    if(cate =="" || emtpy(cate)){
        document.getElementById("helpCate").innerHTML = "Không được để trống!!";
        return false;
    }
    else return true;
}