    function closePesanan(){
        let btn = document.getElementById('butClosePesanan');
        let pesanan = document.getElementsByClassName('listPesanan')[0];
        pesanan.style.display = "none";
    }
    function OpenPesanan(event){
        // event.preventDefault();
        let btn = document.getElementById('butClosePesanan');
        let pesanan = document.getElementsByClassName('listPesanan')[0];
        pesanan.style.display="";
    }
    // butClosePesanan
    // --------------KONSIDIAN WIDTH TABLE >10-------------------------
    function ScanDeTable($TipePesanan){
        let tipe = document.getElementById($TipePesanan);
        let deTableElements = tipe.querySelectorAll(".deTable");
        let tuebel = document.getElementById("tuebel");
        // console.log(deTableElements.length);
        console.log("tuebel : "+tuebel.style.height);
        if(deTableElements.length<=10){
            tuebel.style.height = "94%";

        }
        else{
            tuebel.style.height = "88.01%";

        }
    }
    // ScanDeTable('DiterimaPesanan');
    // --------------------WARNA STATUS-----------------------------
    let dstatuss = document.getElementsByClassName("dstatus");
    // console.log("apaini"+dstatus.textContent);
    Array.from(dstatuss).forEach(function(dstatus){
        if(dstatus.textContent=="Pesanan Baru"){
        // console.log("apaini"+dstatus.textContent);
        dstatus.style.backgroundColor="rgba(0, 255, 255, 0.558)";
        }
        if(dstatus.textContent=="Pesanan Diproses"){
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor="rgba(229, 255, 0)";
        }
        if(dstatus.textContent=="Pesanan Ditolak"){
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor="rgb(255,0,0)";
            dstatus.style.color = "white";
        }
        if(dstatus.textContent=="Pesanan Selesai"){
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor="rgb(0, 255, 38)";
        }
        if(dstatus.textContent=="Pesanan Dibatalkan"){
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor="rgb(230,0,0)";
            dstatus.style.color = "white";

        }
    })

    let allPes = document.getElementById('butAllPes');
    let tallPes = document.getElementById('SemuaPesanan');
    allPes.style.opacity="100%";
    tallPes.style.display="";

    function changePesanan(jenisPesanan){
        let allPes = document.getElementById('butAllPes');
        let newPes = document.getElementById('butNewPes');
        let accPes = document.getElementById('butAccPes');
        let donePes = document.getElementById('butDonePes');
        let tolPes = document.getElementById('butTolPes');
        let tallPes = document.getElementById('SemuaPesanan');
        let tnewPes = document.getElementById('NewPesanan');
        let taccPes = document.getElementById('DiterimaPesanan');
        let tdonePes = document.getElementById('DonePesanan');
        let ttolakPes = document.getElementById('tolakPesanan');

            allPes.style.opacity="40%";
            newPes.style.opacity="40%";
            accPes.style.opacity="40%";
            donePes.style.opacity="40%";
            tolPes.style.opacity="40%";
            tallPes.style.display="none";
            tnewPes.style.display="none";
            taccPes.style.display="none";
            tdonePes.style.display="none";
            ttolakPes.style.display = "none";
        if(jenisPesanan=='AllPesanan'){
            allPes.style.opacity="100%";
            tallPes.style.display="";
            ScanDeTable('SemuaPesanan');
        }
        if(jenisPesanan=='newPesanan'){
            tnewPes.style.display="";
            newPes.style.opacity="100%";
            ScanDeTable('NewPesanan');
        }
        if(jenisPesanan=='terimaPesanan'){
            taccPes.style.display="";
            accPes.style.opacity="100%";
            ScanDeTable('DiterimaPesanan');
        }
        if(jenisPesanan=='donePesanan'){
            tdonePes.style.display="";
            donePes.style.opacity="100%";
            ScanDeTable('DonePesanan');
        }
        if(jenisPesanan=='tolakPesanan'){
            ttolakPes.style.display="";
            tolPes.style.opacity="100%";
            ScanDeTable('tolakPesanan');
        }
    }



