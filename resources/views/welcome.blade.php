<html>
<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <input type="text" id="nama" placeholder="Nama..." class="">
    <input type="text" id="nim" placeholder="NIM..." class="">
    <button onclick="latihandom()" class="btn btn-primary">Tambah</button>

    <input type="text" id="cari" placeholder="Cari..." class="" onkeyup="cariajax()">

    <ul id="listdom">
        {{-- isi list --}}
    </ul>
<script>
    function getdata() {
        fetch('/showajax')
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                data.forEach(item => {
                    var listItem = document.createElement("li");
                    listItem.textContent = "Nama: " + item.nama + ", NIM: " + item.nim;
                    document.getElementById("listdom").appendChild(listItem);
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
    window.onload = getdata;


    async function latihandom() {
        var namaa = document.getElementById("nama").value;
        var nimm = document.getElementById("nim").value;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch('/store_ajax', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ nama: namaa, nim: nimm })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            document.getElementById("listdom").innerHTML = "";
            getdata();
            document.getElementById("nama").value = "";
            document.getElementById("nim").value = "";
        })
        .catch((error) => {
            console.error('Error:', error);
        });

        
    }

    function cariajax() {
        var keyword = document.getElementById("cari").value;
        fetch('/searchajax?keyword=' + keyword)
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                document.getElementById("listdom").innerHTML = "";
                data.forEach(item => {
                    var listItem = document.createElement("li");
                    listItem.textContent = "Nama: " + item.nama + ", NIM: " + item.nim;
                    document.getElementById("listdom").appendChild(listItem);
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

</script>
</body>
</html>