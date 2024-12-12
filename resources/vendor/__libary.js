function TextAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}



function myFunction() {
    var x = document.getElementById("ShowPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

    var y = document.getElementById("KonfirmasiShowPassword");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}