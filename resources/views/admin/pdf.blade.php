<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <style type="text/css">
      hr {
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
  border-color: black;
}
    </style>
    <div class="row">
      <div class="col-md-6"><img src="{{public_path('bintangprima.png')}}"></div>
      <div class="col-md-6"> 
        
        <br> Bintang Prima 
        <br> Alamat : Jalan Perintis Kemerdekaan KM. 11
        <br> Email : bintangprima@gmail.com
        <br> No.HP : 082344989898</div>
    </div>

    <hr>
    
    <br>
    <div class="table-responsive">
              <h2 align="center" style="">{{$judul}}</h2> 
              <br>
                  <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>Nama Bus</th>
                        <th>Tipe Bus</th>
                        <th>Rute</th>
                        <th>Tanggal Berangkat</th>
                        <th>Jam Berangkat</th>
                        <th>Tanggal Tiba</th>
                        <th>Jam Tiba</th>
                        <th>Kursi Terisi</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $datas)
                      <tr>
                        <td>{{$datas->namabus}}</td>
                        <td>{{$datas->tipebus}}</td>
                        <td>{{$datas->rute}}</td>
                        <td>{{$datas->tanggal}}</td>
                        <td>{{$datas->jam}} WITA</td>
                        <td>{{ date('Y-m-d', strtotime($datas->arrived_at)) }}</td>
                        <td>{{ date('H:i', strtotime($datas->arrived_at)) }} WITA</td>
                        <td>{{$datas->kursi_terisi}}</td>
                        <td>Rp. {{format_uang($datas->sub_total)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="8" align="center" ><b>Total : </b></td>
                        <td><b>Rp. {{format_uang($total)}}</b></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
  </body>
</html>