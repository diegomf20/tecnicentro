<html>
    <head>
        <style>
            *{
                font-family: Calibri,Arial,sans-serif;
            }

            body{
                background-color: #fafafa;
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
                border: 1px solid #403d391a;
                padding: 10px 10px;
            }
            .title{
                color: #d8232a;
            }
            .card{
                color: black;
                margin-bottom: 20px;
            }
            
            .text-right{
                text-align: right;
            }
            
            .block{
                display: block;
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
                <div class="title">
                    <h3>Estimado(a) {{ strtoupper($empresa) }} </h3>
                </div>
                <div class="card">
                    <span class="block">
                    Este mensaje contiene mi orden de compra para que me provee gracias!!
                    </span>
                </div>
                <div class="card-footer text-right">
                    <b>Tecnicentro</b>   
                </div>
            </div>
        </div>
    </body>    
</html>