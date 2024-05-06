<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    body {
    font-family: Arial, sans-serif;
      }
      header{
        display: flex;
        justify-content: space-between;
         align-items: center;
        width: 100%;


      }
  ul{
   list-style: none;
    padding: 0;
    margin: 0;
  }
  ul li{
    display: inline-block;
    margin-bottom: -8%;

  }
  header div{
    float: left;
  }
  .logo{
    text-align: center;
     width: 40%;
  }
  img{
   width: 150px;
   height: 150px;
   margin-top: 6%;
  }
  .imglogo{
   width: 200px;
   height: 200px;
   margin-top: auto;
  }
  .info{
    padding-top: 1%;
    width: 30%;
  }
.qr{
    color:#fff;
    font-size: 0%;
    text-align:right;
    padding-top: 1%;
    width: 30%;

}
.convocation{
    margin-top: 20%;
    text-align: center;
}
.table{
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 16px;
    text-align: left;
}
.table th,
.table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
    height: 100px;
}

.table th {
    background-color: #f2f2f2;
}
.table td:nth-child(1),
.table td:nth-child(2) {
    width: 250px; /* Adjust the width as needed */
}
.table td:nth-child(3),
.table td:nth-child(4) {
    width: 20px; /* Adjust the width as needed */
}
@page{
  header: page-header;
  footer: page-footer;
}
</style>
</head>
<body>
    <htmlpageheader name="page-header">
<header>
        <div class="info">
            <ul>
                <li><p><strong>Nom :</strong><span>{{Auth::guard("etudiant")->user()->nom}}</span></p></li>
                <li><p><strong>Prénom :</strong><span>{{Auth::guard("etudiant")->user()->prenom}}</span></p></li>
                <li><p><strong>Apogée :</strong><span>{{Auth::guard("etudiant")->user()->id}}</span></p></li>
                <li><p><strong>CNE :</strong><span>{{Auth::guard("etudiant")->user()->cne}}</span></p></li>
            </ul>
        </div>
    <div class="logo">
      <img src="{{public_path('assets/images/logo.png')}}" class="imglogo">
    </div>
    <div class="qr">
      <span>{{$qrcode}}</span>
    </div>
   <div>
   </div>
</header>
</htmlpageheader>
<br>
    <div class="convocation">
            <h3><i>Convocation Aux Examens - Session Normale d'automne 2023/2024 -</i></h3>
    </div>
<br>
<div>
    <table id="datatable" class="table" >
        <thead>
        <tr>
            <th>Module</th>
            <th>filiére</th>
            <th>Semestre</th>
            <th>Section</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Centre</th>
            <th>Salle/Amphi</th>
            <th>N° place</th>
        </tr>
        </thead>

        <tbody>
@foreach ($queryConvocation as $convocation)
<tr>
<td>{{$convocation->ip_get_id->section_get_id->module_get_id->lib_module}}</td>
<td>{{$convocation->ip_get_id->section_get_id->module_get_id->filiere_get_id->libelle_diplome}}</td>
<td>{{$convocation->ip_get_id->section_get_id->module_get_id->semester}}</td>
<td>{{$convocation->ip_get_id->section_get_id->section}}</td>
<td>{{$convocation->planning_get_id->creneau_get_id->date}}</td>
<td>{{$convocation->planning_get_id->creneau_get_id->heure}}</td>
<td>{{$convocation->numerotation_get_id->local_get_id->centre}}</td>
<td>{{$convocation->numerotation_get_id->local_get_id->id}}</td>
<td>{{$convocation->numerotation_get_id->numero_place}}</td>
</tr>
@endforeach
</table>
</div>
</body>
</html>


