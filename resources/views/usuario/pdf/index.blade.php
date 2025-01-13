<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $maestro->nombre }} {{ $maestro->apaterno }} {{ $maestro->amaterno }}</title>

    @php
        $path = public_path('img/constancia_fondo@3x-100-1.jpg');

        // Convertimos la imagen en base64
        $imageData = base64_encode(file_get_contents($path));

        // Agregar pefijo para el tipo de imagen
        $src = 'data:image/jpg;base64,'.$imageData;
    @endphp
    
    
    <style>

        @page{
                /* margin: 0.2cm; */
                margin: 0.2cm;
                padding: 0.2cm;
                text-indent: 0; 
                size: letter;      
            }        
        body {
            background-image: url('{{$src}}'); /* Ruta a la imagen de fondo */
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .contenedor {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .nombre {
            text-align: center;
            color: #ff6c0e;
            
            
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            /* font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; */
            font-family: "Tw Cen MT Condensed", Arial, sans-serif;
            font-size: 25pt;
            font-weight: bold;
            position: absolute;
            top: 38%;
            left: 50%;
            transform: translate(-50%, -50%);     
            width: 90%;
            /* white-space: nowrap;       */
            word-wrap: break-word;
            margin-bottom: 10px; /* Espacio mínimo entre los elementos */
            display: block; /* Asegura que cada elemento esté en una línea separada */
        }

        .folio {
            position: absolute;
            bottom: 19px;
            right: 90px;
            /* writing-mode: vertical-rl;
            transform: rotate(180deg); */
            font-size: 11pt;
            font-family: "Calibri", Arial, sans-serif;
            font-weight: bold;
        }
        .code {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 25px;
        }
        .qr {
            background-color: white;
            border: 10px solid #ff6c0e;
            width: 12%;
            text-align: center;
            position: absolute;
            bottom: 0.2%;
            left: 0.2%;
        }
    </style>
</head>
<body>

    <div class="contenedor">
        <span class="nombre">{{ $maestro->nombre }} {{ $maestro->apaterno }} {{ $maestro->amaterno }}</span>
        
        <div class="folio">Folio: {{ $maestro->folio }}</div>
        <div class="code">Code: {{ $maestro->codigo_id }}</div>
        <div class="qr">
            {!! DNS2D::getBarcodeHTML("$maestro->codigo_qr",'QRCODE',6,6) !!}
        </div>
    </div>
</body>
</html>
