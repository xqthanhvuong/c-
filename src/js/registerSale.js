const email = document.getElementById("email_sale");
const btnSubmit = document.getElementById("btnSubmitSale");
const s = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
btnSubmit.addEventListener("click", function () {
  if (email.value == "") {
    alert("Vui lòng nhập email");
  }
  else if(!s.test(email.value.trim())){
    alert("Vui lòng nhập đúng email");
  }
  else{
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/web-tour/src/controllers/RegisterSale.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
    if(this.status==200){
      console.log(this.responseText);
      if (this.responseText == "Success") {
        alert("Đăng ký thành công");
      } else if (this.responseText == "Email been used") {
        alert(`Email: ${email.value} đã tồn tại! Vui lòng nhập email khác.`);
      } else {
        alert("Có lỗi xảy ra! Vui lòng thử lại sau");
      }
    }
    };
    xhr.send(`email=${email.value}`);
  }
});
