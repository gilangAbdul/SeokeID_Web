/*jshint esversion: 6 */
const bar = document.getElementById('bar');
const nav = document.querySelector('.navbar');
const tutup = document.getElementById('close');

if(bar){
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    });
}

if(tutup){
    tutup.addEventListener('click', ()=>{
        nav.classList.remove('active');
    });
}

let submenu = document.getElementById('sub-menu');
let menu = document.getElementById('menu');

menu.addEventListener('click', function(){
    submenu.classList.toggle('open');
});

let produks = document.getElementById('product-name');

function updateProduct(){
    let cat= document.querySelector('input[type="radio"]:checked').value;
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            produks.innerHTML=xhr.responseText;
        }
    }
    xhr.open('GET', './showproduk.php?id='+cat, true);
    xhr.send();
}

const inputHarga = document.getElementById('product-price');
const jumlahInput = document.getElementById('quantity');
const totalOutput = document.getElementById('total-price');

function updateHarga(){
    const data = produks.value;
    const array = data.split(",");
    harga = array[0]*1;
    inputHarga.innerHTML = "Rp "+harga.toLocaleString('id-ID');
    inputHarga.value = harga;
}

const service = document.getElementById('service');

function carilayanan(kurir){
    
    jumlah= parseInt(jumlahInput.value);
    const id_city = document.getElementById('city').value;
    const berat_produk = jumlah*100;

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            service.innerHTML = xhr.responseText;
        };
    }
    xhr.open('GET', './API_hargaongkir.php?id_city='+id_city+'&berat='+berat_produk+'&kurir='+kurir, true);
    xhr.send();

}

const totalinput = document.getElementById('totalharga');
function totalHarga(qty){
    const HargaProduk = inputHarga.value;
    const bnyk = parseInt(qty);
    const total_HargaProduk = HargaProduk*bnyk;
    totalinput.value=total_HargaProduk;
}

function hitungTotal(){
    const total_HargaProduk = totalinput.value*1;
    const data = service.value;
    const array = data.split(",");
    const harga_ongkir = array[0]*1;
    const total = total_HargaProduk+harga_ongkir;
    totalOutput.innerHTML = "Rp "+total.toLocaleString('id-ID');
}

