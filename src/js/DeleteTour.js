
const deletebtn = document.getElementsByClassName('btndelete');
for (let i = 0; i < deletebtn.length; i++) {
    deletebtn[i].addEventListener('click', function(event) {
        event.preventDefault();
        const confirmation = confirm("Bạn có chắc chắn muốn xóa tour này?");
        if (confirmation) {
            window.location.href = this.href;
        }
    });
}
