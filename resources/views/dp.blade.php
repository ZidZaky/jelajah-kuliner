<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="/js/dp.js"></script>

    </head>
    <body>
        <div class="backTo">
            <a href="/dashboard">
                <button>Back To Landing Page</button>
            </a>
        </div>
        <div class="dkonten">
            <div class="back">
                <p>Selamat Pagi, @php echo ucfirst(session('account')['nama']); @endphp</p>
                <p id="ket">Dashboard ini di siapkan agar kamu lebih mudah melihat rangkuman penjualanmu</p>
            </div>
            <div class="content">
                <div class="filter">
                    <button onclick="filter('Today')">Today</button>
                    <p>|</p>
                    <button onclick="filter('Bulan Ini')">Bulan Ini</button>
                    <p>|</p>
                    <button onclick="filter('Tahun Ini')">Tahun Ini</button>
                </div>
                <hr>
                <div class="isi">
                    <div class="Overview">
                        <p>Analytics Overview</p>
                        <div>
                            <div>
                                <p class="subjudul">Omset Hari Ini</p>
                                <p class="subisi" id="omsetAll"></p>
                                <p class="subsatuan">Rupiah</p>
                            </div>
                            <div>
                                <p class="subjudul">Total Keseluruhan</p>
                                <p class="subisi" id="sellAll"></p>
                                <p class="subsatuan">Pcs</p>
                            </div>
                            <div>
                                <p class="subjudul">Pendapatan Online</p>
                                <p class="subisi" id="omsetOn"></p>
                                <p class="subsatuan">Rupiah</p>
                            </div>
                            <div>
                                <p class="subjudul">Pendapatan Offline</p>
                                <p class="subisi" id="omsetOff"></p>
                                <p class="subsatuan">Rupiah</p>
                            </div>
                            <div>
                                <p class="subjudul">Terjual Online</p>
                                <p class="subisi" id="sellOn"></p>
                                <p class="subsatuan">Pcs</p>
                            </div>
                            <div>
                                <p class="subjudul">Terjual Offline</p>
                                <p class="subisi" id="sellOff"></p>
                                <p class="subsatuan">Pcs</p>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <hr>
                    <div class="product" id="chartLokasi">
                        
                        
                    </div>
                </div>

            </div>
        </div>
        
    </body>

    <script>
        
        filter('Today')
        // filter('Bulan Ini')
        function filter(apa){
            let buts = document.querySelectorAll('.filter button');
            let subisi = document.getElementsByClassName('subisi')
            // console.log("pjg : "+subisi[0].textContent)
            buts.forEach(a =>{
                a.style.backgroundColor = "rgb(255,255,255,0.2)"
                a.style.color = "rgb(0,0,0,0.5)"
                if(apa==a.innerText){
                    // console.log('sama');
                    a.style.backgroundColor = "rgb(255,255,255,0.7)"
                    a.style.color = "rgb(0,0,0,0.9)"
                }
            });
            let datas = [];
            let produs = [];
            let produk = [];
            if(apa=="Today"){
                clearChart()

                datas = @json($DataToday);
                console.log(datas.TerjualKeseluruhan<1)
                if(datas.TerjualKeseluruhan=="0"){
                    datas = 0;
                    // console.log('masukto')
                }   
            }
            else if(apa=="Bulan Ini"){
                clearChart()

                console.log(datas.TerjualKeseluruhan<1)

                datas = @json($DataMonth);
                if(datas.TerjualKeseluruhan=="0"){
                    datas = 0;
                }
                // console.log(produs)
            }
            else if(apa=="Tahun Ini"){
                clearChart()

                // console.log('tahun = '+(datas.TerjualKeseluruhan<1))
                
                datas = @json($DataYear);
                if(datas.TerjualKeseluruhan=="0"){
                    datas = 0;
                }
            }
            // console.log()
                console.log(datas.length);
                if(datas.length==0){
                    subisi[0].textContent = "0"
                    subisi[1].textContent = "0"
                    subisi[2].textContent = "0"
                    subisi[3].textContent = "0"
                    subisi[4].textContent = "0"
                    subisi[5].textContent = "0"
                }
                
                console.log(datas.TerjualKeseluruhan!="0");
                console.log(datas);

                if(datas.length!=0 && datas[0].TerjualKeseluruhan!="0"){
                console.log('masuk');
                subisi[0].textContent = tR(datas[0].omzetKeseluruhan)
                subisi[1].textContent = tR(datas[0].TerjualKeseluruhan)
                subisi[2].textContent = tR(datas[0].omzetOnline)
                subisi[3].textContent = tR(datas[0].omzetOffline)
                subisi[4].textContent = tR(datas[0].terjualOnline)
                subisi[5].textContent = tR(datas[0].terjualOffline)
                if(apa=="Today"){
                datas = @json($DataToday);
                console.log(datas.TerjualKeseluruhan<1)
                if(apa=="Today"){
                    
                }   
                }
                else if(apa=="Bulan Ini"){
                    loadChartMonth();
                }
                else if(apa=="Tahun Ini"){
                    // console.log('tahun = '+(datas.TerjualKeseluruhan<1))
                    
                    datas = @json($DataYear);
                    if(datas.TerjualKeseluruhan=="0"){
                        datas = 0;
                    }
                }
            }
            
            

        }
        function tR($int){
            return(parseInt($int).toLocaleString('id-ID'));
        }
        loadChartToday();
        function loadChartToday(){

            let colors = ['#3D332A','#5E6B3D','#D0AF68','#D08840','#B75C3F','#924034','929140','987140','3D632A','2D642A'];

            let produk = @json($produs); 
            console.log(produk)
            let namPro = [];
            let qtyPro = [];
            let colr = [];
            console.log(produk);
            //  = produs
        
            for(k=0;k<produk.length;k++)
            {   
                namPro.push(produk[k].produks);
                qtyPro.push(produk[k].TerjualKeseluruhan);
                colr.push(colors[k])
            }
            console.log(namPro)
            console.log(qtyPro)
            console.log(colr)
            // console.log(data);
            let data = {
            labels: namPro,
            datasets: [{
                label: 'My First Dataset',
                data: qtyPro,
                backgroundColor: colr,
                hoverOffset: 4
            }]
            };

            let config = {
                type: 'doughnut',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false // Menonaktifkan legend bawaan
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.raw !== null) {
                                        label += context.raw;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            };
            window.onload = function() {
            let ctx = document.getElementById('myChart').getContext('2d');
            let myChart = new Chart(ctx, config);

            // Membuat legend custom
            let legendContainer = document.getElementById('legend');
            data.labels.forEach((label, index) => {
                let legendItem = document.createElement('div');
                legendItem.style.display = 'flex';
                legendItem.style.alignItems = 'center';
                legendItem.style.marginBottom = '10px';

                let colorBox = document.createElement('span');
                colorBox.style.backgroundColor = data.datasets[0].backgroundColor[index];
                colorBox.style.width = '20px';
                colorBox.style.height = '20px';
                colorBox.style.display = 'inline-block';
                colorBox.style.marginRight = '10px';

                let labelText = document.createElement('span');
                labelText.textContent = label;
                labelText.style.color = 'white';

                legendItem.appendChild(colorBox);
                legendItem.appendChild(labelText);
                legendContainer.appendChild(legendItem);
            });

            
        };
        }


        function clearChart(){
            let parent = document.getElementById('chartLokasi')
            while(parent.firstChild){
                parent.removeChild(parent.firstChild);
            }
            //bikin isinya
            let p = document.createElement('p')
            p.textContent="Analytics Overall Product Since {{$startdate->startdt}}"
            parent.appendChild(p);
            let div1 = document.createElement('div');
            //bikin isi div1
                let div1in1 = document.createElement('div');
                    div1in1.className = "Bagan";
                    let canvas = document.createElement('canvas');
                        canvas.id="myChart"
                        canvas.width = 400
                        canvas.height = 400;
                    div1in1.appendChild(canvas);
                    let legenddiv = document.createElement('div')
                        legenddiv.className="legend-container";
                        legenddiv.id = "legend"
                    div1in1.appendChild(legenddiv);
                div1.appendChild(div1in1);
            parent.appendChild(div1)

        }
        function loadChartMonth(){

            let colors = ['#3D332A','#5E6B3D','#D0AF68','#D08840','#B75C3F','#924034','929140','987140','3D632A','2D642A'];

            let produk = fetch('/chartTahun');
            console.log('produk : '+produk)
            let namPro = [];
            let qtyPro = [];
            let colr = [];
            console.log(produk);
            //  = produs

            for(k=0;k<produk.length;k++)
            {   
                namPro.push(produk[k].produks);
                qtyPro.push(produk[k].TerjualKeseluruhan);
                colr.push(colors[k])
            }
            console.log(namPro)
            console.log(qtyPro)
            console.log(colr)
            // console.log(data);
            let data = {
            labels: namPro,
            datasets: [{
                label: 'My First Dataset',
                data: qtyPro,
                backgroundColor: colr,
                hoverOffset: 4
            }]
            };

            let config = {
                type: 'doughnut',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false // Menonaktifkan legend bawaan
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.raw !== null) {
                                        label += context.raw;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            };
            window.onload = function() {
            let ctx = document.getElementById('myChart').getContext('2d');
            let myChart = new Chart(ctx, config);

            // Membuat legend custom
            let legendContainer = document.getElementById('legend');
            data.labels.forEach((label, index) => {
                let legendItem = document.createElement('div');
                legendItem.style.display = 'flex';
                legendItem.style.alignItems = 'center';
                legendItem.style.marginBottom = '10px';

                let colorBox = document.createElement('span');
                colorBox.style.backgroundColor = data.datasets[0].backgroundColor[index];
                colorBox.style.width = '20px';
                colorBox.style.height = '20px';
                colorBox.style.display = 'inline-block';
                colorBox.style.marginRight = '10px';

                let labelText = document.createElement('span');
                labelText.textContent = label;
                labelText.style.color = 'white';

                legendItem.appendChild(colorBox);
                legendItem.appendChild(labelText);
                legendContainer.appendChild(legendItem);
            });


            };
            }
       
    </script>
    <style>
        html::-webkit-scrollbar{
            width: 0;
        }
        body{
            /* width: 100%; */
            /* height: 100%; */
            background-color: #D9D9D9;
            padding: 1%;
            padding-top: 3%;
        }
        body>*{
            /* border:1px black solid; */
        }
        .backTo{
            position: fixed;
            z-index: 950;
            right: 20px;
            /* background-color: #8F2F30;
            color: white; */
            /* border: 1px black solid; */
            width: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .backTo button{
            background-color: #8F2F30;
            border: none;
            padding: 10px;
            color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

        }
        .backTo>a{
            height: fit-content;
            width: fit-content;
        }
        .back{
            display: flex;
            flex-direction: column;
            font-size: 40px;
            font-family: 'Quando', serif;
            font-weight: 800;
            padding: 0 0;
            margin: 0 0;
            margin-bottom: 20px;
        }
        .back>p{
            padding: 0 0;
            margin: 0 0;

        }
        #ket{
            font-weight: 100;
            font-size: 15px;
        }
        .content{
            background-color: #8F2F30;
            padding: 20px;
            border-radius: 20px 20px 0 0;
        }
        hr{
            background-color: white;
            color: white;
        }
        .filter{
            display: flex;
            flex-direction: row;
            gap: 20px;
            width: 300px;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .filter>*{
            /* border: 1px white solid; */
        }
        .filter>hr{
            transform: rotate(90deg);
            width: 100%;
            height: 100%;
            /* width: ; */
        }
        .filter>button{
            background-color: rgb(255,255,255,0.2);
            padding: 5px 10px;
            border:none;
            width: fit-content;
            margin: 0 0;
            color: rgb(0,0,0,0.5);
            border-radius: 8px;
        }
        .filter>button:hover{
            background-color: rgb(255,255,255,0.7);
            color: rgb(0,0,0,0.9);

        }

        .isi{
            display: flex;
            flex-direction: row;
            /* border: #D9D9D9 1px solid; */
            width: 100%;
            height: 70%;
        }
        .isi>*{
            /* border: #D9D9D9 1px solid; */

        }
        .Overview{
            width: 60%;
            display: flex;
            flex-direction: column; 
        }
        .Overview>*{
            /* border: #D9D9D9 1px solid; */
        }
        .Overview>p{
            padding: 0 0;
            margin: 0 0;
            /* height: 20%; */
            margin-top: 5%;
            margin-bottom: 12px;
            padding-left: 4%;
            font-size:x-large;
            color: white;
            /* padding-left: 10px; */
            font-weight: 700;
            font-family: Arial, Helvetica, sans-serif;
            /* justify-content: ; */
            /* align-items:; */
        }
        .Overview>div{
            /* border: yellow 1px solid !important; */
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 10px 3%;
            height: 90%;
            /* padding: 12px ; */
        }
        .Overview>div>*{
            /* border: yellow 1px solid !important; */

        }
        .Overview>div>div{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content:space-between;
            width: 45%;
            height: 25%;
            background-color: #D9D9D9;
            border-radius: 12px;
            gap: 10px;
            padding: 0.5% 0;
        }
        @font-face {
            font-family: 'Inter';
            src: url('fonts/Inter-Regular.woff2') format('woff2'),
                url('fonts/Inter-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Inter';
            src: url('fonts/Inter-Bold.woff2') format('woff2'),
                url('fonts/Inter-Bold.woff') format('woff');
            font-weight: 700;
            font-style: normal;
        }
        .Overview>div>div>p{
            /* font-size: 15px; */
            padding: 0 0;
            margin: 0 0;
            color: #8F2F30;
            font-weight: 800;
            font-family:'Inter', sans-serif;
        }
        .subjudul,.subsatuan{
            font-size: 15px;
        }
        .subisi{
            font-size: x-large;
        }
        .subisi:hover{
            font-size: 30px;
        }
        .product{
            width: 38%;
            /* height: ; */
            display: flex;
            flex-direction: column; 
        }
        .product>*{
            /* border: #D9D9D9 1px solid; */
        }
        .Product>p{
            width: 100%;
            text-align:center;
            padding: 0 0;
            margin: 0 0;
            /* height: 20%; */
            margin-top: 7.5%;
            margin-bottom: 12px;
            padding-left: 4%;
            font-size:x-large;
            color: white;
            /* padding-left: 10px; */
            font-weight: 700;
            font-family: Arial, Helvetica, sans-serif;
            /* justify-content: ; */
            /* align-items:; */
        }
        .product>div{
            display: flex;
            flex-direction: row;
            /* flex-wrap: wrap; */
            align-items: center;
            justify-content: center;
            gap: 10px 3%;
            height: 90%;
        }
        .product>div>*{
            /* border: #D9D9D9 1px solid; */
        }
        .product>div>.Bagan{
            width: 350px;
        }
    </style>
</html>