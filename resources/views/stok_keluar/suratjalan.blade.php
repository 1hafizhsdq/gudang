<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Stok Keluar</title>
    {{-- <link rel="stylesheet" href="{{ asset('pdf') }}/style.css" media="all" /> --}}
    <style>
      @font-face {
      font-family: SourceSansPro;
      src: url(SourceSansPro-Regular.ttf);
      }
      
      .clearfix:after {
      content: "";
      display: table;
      clear: both;
      }
      
      a {
      color: #0087C3;
      text-decoration: none;
      }
      
      body {
      position: relative;
      width: 21cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #555555;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 14px;
      font-family: SourceSansPro;
      }
      
      header {
      padding: 10px 0;
      margin-bottom: 20px;
      border-bottom: 1px solid #AAAAAA;
      }
      
      #logo {
      float: left;
      margin-top: 8px;
      }
      
      #logo img {
      height: 70px;
      }
      
      #company {
      float: right;
      text-align: right;
      }
      
      
      #details {
      margin-bottom: 50px;
      }
      
      #client {
      padding-left: 6px;
      border-left: 6px solid #777777;
      float: left;
      }
      
      #client .to {
      color: #1b1b1b;
      }
      
      h2.name {
      font-size: 1.4em;
      font-weight: normal;
      margin: 0;
      }
      
      #invoice {
      float: right;
      text-align: right;
      }
      
      #invoice h1 {
      color: #0087C3;
      font-size: 2.4em;
      line-height: 1em;
      font-weight: normal;
      margin: 0 0 10px 0;
      }
      
      #invoice .date {
      font-size: 1.1em;
      color: #777777;
      }
      
      table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
      }
      
      table th,
      table td {
      padding: 20px;
      text-align: center;
      border: '1px solid black'
      }
      
      table th {
      white-space: nowrap;
      font-weight: normal;
      }
      
      table td {
      text-align: left;
      }
      
      table td h3{
      color: #57B223;
      font-size: 1.2em;
      font-weight: normal;
      margin: 0 0 0.2em 0;
      }
      
      table .no {
      color: #FFFFFF;
      font-size: 1.6em;
      background: #57B223;
      }
      
      table .desc {
      text-align: left;
      }
      
      table .unit {
      background: #DDDDDD;
      }
      
      table .qty {
      }
      
      table td.unit,
      table td.qty,
      table td.total {
      font-size: 1.2em;
      }
      
      table tbody tr:last-child td {
        /* border: none; */
      }
      
      table tfoot td {
      padding: 10px 20px;
      background: #FFFFFF;
      border-bottom: none;
      font-size: 1.2em;
      white-space: nowrap;
      border-top: 1px solid #AAAAAA;
      }
      
      table tfoot tr:first-child td {
        border-top: none;
      }
      
      table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223;
      }
      
      table tfoot tr td:first-child {
        border: none;
      }

      table thead tr th{
        background-color: #dfdfdf;
        color: #07090a;
      }
      
      #thanks{
        font-size: 2em;
        margin-bottom: 50px;
      }
      
      #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;
      }
      
      #notices .notice {
        font-size: 1.2em;
      }
      
      footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{public_path('niceadmin')}}/assets/img/logo.png">
        <h2 class="name">MIA CORP.</h2>
        <div>Jl. Desa Balong Pandan RT/RW 007/002 Jogosatru<br>Sukodono Sidoarjo - 61258</div>
        <div>(031) 99893526</div>
        <div><a href="mailto:miateknikindonesia@gmail.com">miateknikindonesia@gmail.com</a></div>
        <div><a href="mailto:haisatatakarya@gmail.com">haisatatakarya@gmail.com</a></div>
      </div>
      <div id="company" style="margin-top: 10%">
        <div>Nanti diisi tanggal 08/09/2022</div>
        <div>Kepada Yth. Nanti nama perusahaannya</div>
        <div>Nama Project</div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><b>SURAT JALAN NO</b></div>
          <div class="address">Kami kirimkan barang-barang tersebut dibawah ini dengan Nopol {nanti nopol nya}</div>
        </div>
        <div id="invoice">
        </div>
      </div>
      <table border="1px solid black" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>Barang</th>
            <th width="5%">Jumlah</th>
            <th width="7%">Satuan</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>barang</td>
            <td>10</td>
            <td>pcs</td>
            <td>keterangan</td>
          </tr>
        </tbody>
      </table>

      <table style="text-align: center;border:">
        <tr>
          <td>Pengirim,</td>
          <td>Penerima,</td>
          <td>Hormat Kami,</td>
        </tr>
      </table>

    </main>
  </body>
</html>