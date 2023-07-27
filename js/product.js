const SM = document.getElementById('manis');
const SA = document.getElementById('asin');
const SP = document.getElementById('pedas');
const produk = document.getElementById('container');

const keyword = document.getElementById('keyword');
keyword.addEventListener('keyup', function(){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            produk.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', './kategori.php?keyword='+keyword.value, true);
    xhr.send();
})


function showKategori(kat){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            produk.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', './kategori.php?id='+kat, true);
    xhr.send();
}

SM.addEventListener('click', function(){showKategori('SM')});
SA.addEventListener('click', function(){showKategori('SA')});
SP.addEventListener('click', function(){showKategori('SP')});


