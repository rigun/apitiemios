<body>
    <div class="mail" style="margin: auto; width: 100%; max-width: 350px; text-align: center; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 30px;">
        <div class="mail-header" style="color: white; background-color: #003365; width: 100%; font-size: 20px; padding: 20px; border-top-left-radius: 25px; border-top-right-radius: 25px;">
            <strong>VERIFIKASI EMAIL DARI <br/>Bukren</strong>
        </div>
        <div class="mail-body" style="color: black; background-color:  #CFE7EA; width: 100%; padding: 20px;">
            <h1>Hallo , Silahkan lakukan verifikasi email anda dengan menekan tombol berikut </h1>
            <a href="https://bukren.thekingcorp.org/verifikasiEmail/{{$dataEmail->token}}"><button style="background-image: linear-gradient(to left, #0025BC , #0071BC); width: 100%; text-align: center; margin: auto; min-height: 40px; color: white; font-size: 30px; cursor: pointer;">Klik disini</button></a>';
        </div>
        <div class="mail-footer" style="color: black; background-color: #adadad; width: 100%; font-size: 20px;padding: 20px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;" >';
            <p>Apabila link tersebut bermasalah, silahkan akses url berikut: </p><br/>
            https://bukren.thekingcorp.org/verifikasiEmail/{{$dataEmail->token}}
        </div>
    </div>
</body>
</html>