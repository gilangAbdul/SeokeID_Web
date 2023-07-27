const keyword = document.getElementById('keyword');
const table = document.getElementById('tbody')

keyword.addEventListener('keyup', function(){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            table.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', './admin_kategori.php?keyword='+keyword.value, false);
    xhr.send();
})