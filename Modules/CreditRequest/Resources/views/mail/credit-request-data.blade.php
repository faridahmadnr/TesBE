
<style>
    table {
        border-collapse : collapse;
        border : 1px solid #000;
        width : 100%;
    }
    table td{
        border : 1px solid #000;
        padding : 8px !important;
    }
</style>

<table style="border-collapse : collapse;border : 1px solid #000" border="1">
    <tr>
        <td>Nomor Registrasi</td>
        <td>:</td>
        <td>{{$registrationNumber}}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{$fullname}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{$gender}}</td>
    </tr>
    <tr>
        <td>Telp</td>
        <td>:</td>
        <td>{{$phone}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{$email}}</td>
    </tr>
    <tr>
        <td>Kabupaten</td>
        <td>:</td>
        <td>{{$regencyName}}</td>
    </tr>
    <tr>
        <td>Kecamatan</td>
        <td>:</td>
        <td>{{$districtName}}</td>
    </tr>
    <tr>
        <td>Desa</td>
        <td>:</td>
        <td>{{$village}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{$address}}</td>
    </tr>
    <tr>
        <td>Jenis Usaha</td>
        <td>:</td>
        <td>{{$businessType}}</td>
    </tr>
    <tr>
        <td>Ijin Usaha</td>
        <td>:</td>
        <td>{{$businessPermit}}</td>
    </tr>
    <tr>
        <td>NPWP</td>
        <td>:</td>
        <td>{{$businessTin}}</td>
    </tr>
    <tr>
        <td>Nominal</td>
        <td>:</td>
        <td>{{$amount}}</td>
    </tr>
    <tr>
        <td>Termin</td>
        <td>:</td>
        <td>{{$termin}}</td>
    </tr>
    <tr>
        <td>Bank Penyalur</td>
        <td>:</td>
        <td>{{$bankName}}</td>
    </tr>
</table>
