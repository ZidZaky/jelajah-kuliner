<html>
    <body>
        <div class="batas">
            <table>
                <thead>
                    <tr>
                        <th class="tno">NO</th>
                        <th class="tnama">NAMA</th>
                        <th class="tsAwal">STOK AWAL</th>
                        <th class="tsoldOnline">TERJUAL ONLINE</th>
                        <th class="tsoldOffline">TERJUAL OFFLINE</th>
                        <th class="tsisa">SISA JUALAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tno">1</td>
                        <td class="tnama">Pentol</td>
                        <td class="tsAwal">50</td>
                        <td class="tsoldOnline">15</td>
                        <td class="tsoldOffline">33</td>
                        <td class="tsisa">2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <style>
        body{
            border: 1px solid red;

            width: 100%;
            height: 100%;
        }
        .batas {
            position: absolute;
            border: 1px solid black;
            width: 60%;
            height: 80%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        thead>tr>th,tbody>tr>td{
            border: 1px solid black;
            /* display: flex; */
            align-items: center;
            text-align: centerl;
        }
        .tno{
            width: 20%;
        }
        .tnama{
            width: 20%;
        }
        .tsAwal{
            width: 10%;
        }
        .tsoldOnline{
            width: 10%;
        }
        .tsoldOnlineOffline{
            width: 10%;
        }
        .tsisa{
            width: 10%;
        }

    </style>
</html>




