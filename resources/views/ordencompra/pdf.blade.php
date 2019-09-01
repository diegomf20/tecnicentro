<html>
    <head>
        <style>
            *{
                font-family: Calibri,Arial,sans-serif;
            }

            body{
                /* background-color: #fafafa; */
            }
            .container{
                /* border: 1px solid #eee; */
                /* padding: 15px 30px; */
                width: 600px;
                margin-left: auto;
                margin-right: auto;
                background-color: #ffffff;
            }
            .car-border{
                /* border: 1px solid #403d391a; */
                padding: 10px 10px;
            }
            .card{
                color: black;
                margin-bottom: 20px;
            }
            .table{
                 border-spacing: 0;
                border-collapse: collapse;
                width: 100%;
                text-align: left;
                margin: auto;
                margin-bottom: 20px;
            }
            .table td, .table th{
                padding: 5px 10px;
                border: 1px solid #403D39;
            }
            .text-right{
                text-align: right;
            }
            
            .block{
                display: block;
            }
            .center{
                text-align: center;
            }
            .card-footer{
                background-color: #403D39;
                color: #fff;
                padding: 10px 20px;
            }

        </style>
    </head>
    <body>
        <div class="container">
            
            <div class="car-border">
                <div class="center">
                    <h3>Tecnicentro S.A.C</h3>
                </div>
                <div class="card">
                    <span class="block">
                        <b>Proveedor: </b> {{$empresa}}
                    </span>
                    <span class="block">
                        <b>Fecha:</b> {{$fecha}}
                    </span>
                    <span class="block">
                        <b>Numero de compra:</b> {{$numcompra}}
                    </span>
                </div>
                <div>
                    <table class="table">
                        <thead style="background-color:#DFF0D8; font-weight:bold;">
                            <tr>
                                <th>Código</th>
                                <th>Accesorio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalle as $item)
                                <tr>
                                    <td>{{$item->accesorio->codigo}}</td>
                                    <td>{{$item->accesorio->nombre}}</td>
                                    <td>{{$item->cantidad}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </body>    
</html>