<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="kotak_login">
        <h3>Sistem Informasi Penjualan Barang <br/> Politeknik Negeri Subang</h3>
        
        <center>
            <img src="gambar/logo_aplikasi.png" width="200" height="200">
        </center>
        
        <div class="kotak_login2">
            <p class="tulisan_login">Silahkan Login</p>
            
            <form name="form1" method="post" action="proses_barang.php?action=login">
                
                <label>Username</label>
                <input type="text" name="username" type="text" id="username" class="form_login" placeholder="Username"/>
                
                <label>Password</label>
                <input type="password" name="password" type="password" id="password" class="form_login" placeholder="Password"/>
                
                <input type="submit" name="Submit" class="tombol_login" value="Login"/>
                
                <input type="reset" name="Reset" class="tombol_reset" value="Reset"/>
                
            </form>
        </div>
    </div>
</body>
</html>