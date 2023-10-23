
{

}
{
    var img = document.getElementById("father");
    var item = document.querySelector(".item");

    item.addEventListener("click", function(event) {
        if (event.target.tagName === "IMG") {
            var src = event.target.getAttribute("data-src");
            img.setAttribute("src", src);
        }
    });
}

{
    document.addEventListener('DOMContentLoaded', () => {
        var describe = document.querySelectorAll('.topic__content__rte p');
        if (describe.length > 0) {
            const viewdescribe = document.querySelector('.content__describe');
            let html = '';
            let j = 0;
            for (let i = 0; i < describe.length; i++) {
                let text = describe[i]?.textContent;
                if (text?.length > 130) {
                    text = text.slice(0, 130) + '....';
                    html += '<p>-\t' + text + '</p>';
                    j++;
                }
                if (j >= 2) {
                    break;
                }
            }
            viewdescribe.innerHTML = html;
        }
    });
}
{
    let allcomment = document.querySelectorAll('.comment_item');
    console.log(allcomment);
    if (allcomment.length > 5) {
        for (let i = 6; i < allcomment.length; i++) {
            allcomment[i].style.display = "none";
        }
        document.querySelector('.comment-list')?.innerHTML += '<div class="also"><button>Xem tất cả</button></div>'
    }
}
{
    let id = document.getElementById('idtour').value;
    if (document.querySelector('.also button')) {
        document.querySelector('.also button').addEventListener('click', () => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', '../controllers/alsocomment.php?id=' + id);
            xhr.send();
            xhr.onload = function() {
                if (this.status == 200) {
                    console.log(this.responseText);
                    let databack = JSON.parse(this.responseText);
                    let comment_list = document.getElementById('comment-list');
                    if (databack.length > 0) {
                        comment_list.innerHTML = '';
                        databack.forEach(function(item) {
                            let h4 = document.createElement('h4');
                            h4.innerHTML = item.name;
                            let p = document.createElement('p');
                            p.innerHTML = item.comment;
                            let div = document.createElement('div');
                            div.appendChild(p)
                            div.style.wordWrap = 'break-word';
                            let li = document.createElement('li');
                            li.appendChild(h4);
                            li.appendChild(div);
                            comment_list.appendChild(li);
                        });
                    }
                }
            }
        })
    }
    document.getElementById('comment-form').addEventListener('submit', (event) => {
        event.preventDefault(); //chặn sự kiện mặc định của form
        //tạo đối tượng XMLHttpRequest
        let xhr = new XMLHttpRequest();

        // gửi bằng phương thức post
        xhr.open('POST', '../controllers/process_comment.php', true);
        xhr.setRequestHeader("Content-type", "application/json");

        //kiểm tra xem người dùng đã ấn nút xem thêm hay chưa


        // định dạng dữ liệu thành chuỗi json
        var data = JSON.stringify({
            name: document.getElementById('name').value,
            comment: document.getElementById('comment').value,
            id: id
        });
        xhr.onload = function() {
            if (this.status == 200) {
                console.log(this.responseText);
                let databack = JSON.parse(this.responseText);
                let comment_list = document.getElementById('comment-list');
                if (databack.length > 0) {
                    comment_list.innerHTML = '';
                    databack.forEach(function(item) {
                        let h4 = document.createElement('h4');
                        h4.innerHTML = item.name;
                        let p = document.createElement('p');
                        p.innerHTML = item.comment;
                        let div = document.createElement('div');
                        div.appendChild(p)
                        div.style.wordWrap = 'break-word';
                        let li = document.createElement('li');
                        li.appendChild(h4);
                        li.appendChild(div);
                        comment_list.appendChild(li);
                    });

                    // xóa nội dung trong ô commnent
                    document.getElementById('comment').value = '';
                }
            }
        }

        xhr.send(data);

    })
}