<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    {{--<link href="{{public_path('css/core.css')}}" rel="stylesheet"> --}}
    <title>Contrato</title>
  </head>
  <style>
    /** Define the margins of your page **/
    @page {
        margin: 100px 50px;
    }

    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;
        /** Extra personal styles **/
    
        color: white;
        text-align: center;
        line-height: 35px;
        margin-bottom: 1000px;
    }

    footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px; 

        /** Extra personal styles 
        text-align: center;
        line-height: 35px;
        **/
    }
  </style>
  <body>

      <!-- Define header and footer blocks before your content -->
      <header>
        <img src="{{public_path('/images/logo2.png')}}" alt="" width="70">  
        
      </header>
      
      <footer>
          <img class="float-left" src="{{public_path('/images/logo2.png')}}" alt="" width="70">  

          <img class="float-right" src="{{public_path('/images/logo2.png')}}" alt="" width="70"> 

          
      </footer>

        <h1 class="h5 text-center">CONTRATO DE MANDATO PARA LA ADMINISTRACION DE PORTAFOLIOS DE VALORES</h1>
        <p>PARTES:</p>
        <div>MANDATARIO</div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 35%;" class="">Nombre:</th>
                    <td style="width: 65%;">Gerson Osorio Moncada</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">C.C:</th>
                  <td style="width: 65%;">1073508892</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Ciudad:</th>
                  <td style="width: 65%;">FUNZA</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Dirección.</th>
                  <td style="width: 65%;">CLL 20 # 2D – 32</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Teléfono:</th>
                  <td style="width: 65%;">3505935566</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Correo electrónico:</th>
                  <td style="width: 65%;">Gerson.osorio.m@gmail.com</td>
                </tr>
            </tbody>
        </table>

        <div>CLIENTE-MANDANTE</div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 35%;" class="">Nombre:</th>
                    <td style="width: 65%;">{{$inversion->getUser->fullname}}</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">C.C:</th>
                  <td style="width: 65%;">{{$inversion->getUser->num_documento}}</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Ciudad:</th>
                  <td style="width: 65%;">{{$inversion->getUser->ciudad_residencia}}</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Dirección.</th>
                  <td style="width: 65%;">{{$inversion->getUser->direccion_residencia}}</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Teléfono:</th>
                  <td style="width: 65%;">{{$inversion->getUser->celular}}</td>
                </tr>
                <tr>
                  <th style="width: 35%;" class="">Correo electrónico:</th>
                  <td style="width: 65%;">{{$inversion->getUser->email}}</td>
                </tr>
            </tbody>
        </table>
         
        <p>
          Mediante el presente documento, las partes arriba señaladas como <b>MANDANTE</b> y <b>MANDATARIO</b> celebran el siguiente contrato de mandato, sin representación, para la administración de portafolio de valores, este contrato se regirá por las siguientes clausulas:
        </p>

        <p>
          <b>CLAUSULA PRIMERA. - OBJETO DEL CONTRATO. - El MANDANTE</b>, por medio del presente <b>MANDATO</b>, encarga al <b>MANDATARIO</b> la administración de los recursos y valores (portafolio) que se entregan para que sean invertidos y administrados a su criterio con respeto a los objetivos y lineamientos dispuestos por el cliente. Harán parte del portafolio las adiciones de recursos y valores que se efectúen al mismo. La finalidad del <b>MANDATARIO</b>, en desarrollo de las funciones que se le indican, será obtener los mejores rendimientos posibles y hacer entrega de estos al <b>MANDANTE</b> o a quien este determine. En consecuencia, el <b>MANDANTE</b> está encargando al <b>MANDATARIO</b> la administración del portafolio, el cual está constituido según se describe en el <b>Anexo 1</b>, que hace parte integral del presente contrato.
        </p>

        <p>
          Parágrafo 1.- Los recursos y valores que integran inicialmente el portafolio a administrar se detallan en el Anexo 1
        </p>
        
        <p>
          <b>CLAUSULA SEGUNDA. VALOR DEL PORTAFOLIO.</b> - El valor del portafolio será determinado por el monto total entregado en Bitcoin, en el momento de empezar la administración en criptomonedas, dicho valor será calculado mensualmente, para que el <b>MANDANTE</b> tenga conocimiento de cuando se ha incrementado o disminuido el valor de su inversión inicial debido a los movimientos mensuales del Bitcoin; este valor inicial no difiere de la ganancia pactada mensual.
          <br>
          <b>NOTA: El caso anterior solo se aplica si el portafolio es en criptomonedas, de ser Forex no aplica</b>
        </p>

        <p>
          <b>CLAUSULA TERCERA- FACULTADES DEL MANDATARIO.</b> - En virtud del presente contrato, el <b>MANDANTE</b> autoriza expresamente al <b>MANDATARIO</b> para:
        </p>

        <ol type="a"> 
          <li>Invertir bajo el criterio del MANDATARIO.</li>
          <li>Realizar el cobro de los rendimientos.</li>
        </ol>

        <p>
          <b>CLAUSULA CUARTA. - OBLIGACIONES DEL MANDATARIO. - El MANDATARIO</b> se encuentra obligado a:
        </p>

        <ol type="a"> 
          <li>Administrar el portafolio con la diligencia que le corresponde en su carácter de profesional en la materia.</li>
          <li>Entregar oportunamente los dividendos de los valores del portafolio que esté administrando, en la fecha pactada con el <b>MANDANTE</b>.</li>
          <li>Mantener la información de este portafolio separada de la propia, o de la que corresponda a otros portafolios o a carteras colectivas que administre.</li>
          <li>Informar en que monedas y/o divisa se invirtió el capital del <b>MANDANTE</b>, si y solo si, el MANDANTE lo solicita.</li>
          <li>Entregar beneficio de la operación del <b>MANDANTE, por medio de consignación Bancaria o en Efectivo, como lo prefiera el MANDANTE.</b></li>
          <li>En este contrato, el <b>MANDANTE</b> hará entrega de su valor uncial en efectivo, pero el portafolio se manejará en Bitcoin (BTC) en caso de manejarse el portafolio en criptomonedas, o se manejará en Dólares (USD) en caso de manejar el portafolio en Forex</li>
          <li>El <b>MANDATARIO</b> se compromete a hacerse responsable sobre el capital inicial del mandante, asegurándose la totalidad de este y haciendo entrega una vez finalice el contrato.</li>
        </ol>

        <p><b>CLAUSULA QUINTA. - PROHIBICIONES AL MANDATARIO. - El MANDATARIO</b>, en su condición de administradora del portafolio objeto del presente contrato, no podrá realizar las siguientes actividades:</p>

        <ol type="a"> 
          <li>Ejecutar transacciones entre la cartera propia del <b>MANDATARIO</b> y los portafolios de terceros bajo su administración.</li>
          <li>Actuar como contraparte del Portafolio administrado.</li>
        </ol>

        <p><b>CLAUSULA SEXTA. - OBLIGACIONES Y DECLARACIONES DEL MANDANTE
          <br>
          6.1.	Obligaciones del MANDANTE:
          </b>
        </p>

        <ol type="a"> 
          <li>Guardar reserva y confidencialidad de la información del <b>MANDATARIO</b> que llegare a conocer debido a la ejecución de este contrato.</li>
          <li>Entregar debidamente la cantidad deseada a invertir al <b>MANDATARIO</b>.</li>
          <li>No encargar a personas distintas del <b>MANDATARIO</b> la administración del portafolio entregado en desarrollo de este contrato.</li>
        </ol>

        <p>
          <b>6.2.	Declaraciones del MANDANTE:</b> <br>
          El <b>MANDANTE</b> declara bajo la gravedad del juramento que los valores y recursos que entrega para conformar el portafolio, así como las adiciones posteriores, provienen del giro ordinario de los negocios derivados de su objeto social y/o de su actividad económica, y no provienen de actividades ilícitas.
        </p>

        <p>
          <b>CLAUSULA SEPTIMA. - DURACIÓN.</b> - El presente contrato tendrá un término de duración mínimo de <b><u>12 meses</u></b> de igual manera el mandante puede retirar el dinero con un castigo del 30% por motivos operacionales y estratégicos del mandatario. Este tiempo será definido al comienzo del contrato y se podrá extender hasta un máximo de <b><u>2 año</u></b>, siempre y cuando las dos partes estén de acuerdo. Este contrato tendrá una <b>Duración de <u>12 meses</u></b>, y es caso de no tener una notificación escrita para el retiro del portafolio, máximo los 10 días siguientes a la terminación del contrato, será renovado automáticamente.
        </p>

        <p>
          <b>CLAUSULA OCTAVA. - TERMINACION.</b> - El presente contrato se dará por terminado:
        </p>

        <ol type="a">
          <li>Por mutuo acuerdo entre las partes.</li>
          <li>Por incumplimiento de las obligaciones de alguna de las partes.</li>
          <li>Por decisión del <b>MANDANTE</b>, teniendo en cuenta las clausulas del presente contrato.</li>
          <li>Por decisión del <b>MANDATARIO</b>, garantizando devolución del 100% del capital</li>
        </ol>

        <p>
          <b>CLAUSULA NOVENA. - ANEXOS.</b> - Hacen parte integral del presente contrato:
        </p>

        <div class="text-center" style="text-align: center">
          <b>ANEXO 1 - DESCRIPCION Y RELACION DEL PORTAFOLIO INICIAL</b>
        </div>

        <p>Quienes suscriben dejan constancia de que el portafolio inicial se integra como se señala a continuación:</p>

        <p><b>VALOR TOTAL DEL </b></p>
        <p><b>PORTAFOLIO RECURSOS</b></p>
        <p><b>EN DINERO:</b></p>

        <table class="table">
          <tbody>
              <tr>
                  <th style="width: 65%;" class=""><p><b>Monto de Efectivo Entregado en pesos colombianos:</b></p></th>
                  <td style="width: 45%;"><p class="text-right">{{number_format($inversion->invertido * 3800)}} COP</p></td>
              </tr>
              <tr>
                <th style="width: 75%;" class=""><p><b>Monto En Dólares (aplica para inversiones internacionales):</b></p></th>
                <td style="width: 25%;">$ {{number_format($inversion->invertido)}} USD</td>
              </tr>
          </tbody>
        </table>

        <p>
          El monto equivalente en dólares americanos (USD) está conforme a lo dispuesto en el artículo 40 de la resolución externa No. 1 de 2018 expedida por la junta directiva del Banco de la República de Colombia, la metodología establecida por el Banco de la República mediante circular reglamentaria DODM –146, el artículo 11.2.1.4.15 del decreto 2555 del 2010 y la resolución No. 0416 del 2006 de la Superintendencia Financiera de Colombia para la fecha de suscripción del presente anexo.
        </p>
        @php
        setlocale(LC_ALL, 'es');
        @endphp
        <p>
          Se suscribe al día {{\Carbon\Carbon::now()->format('d')}} del mes de {{strftime("%B", \Carbon\Carbon::createFromFormat('!m',\Carbon\Carbon::now()->format('m'))->getTimestamp())}} del año {{\Carbon\Carbon::now()->format('Y')}} en dos ejemplares del mismo tenor con destino a cada una de las partes.
        </p>

        <table class="">
          <tbody>
            <tr>
              <th><p class="text-center"><b>POR EL MANDATARIO:</b></p></th>
              <td><p class="text-center"><b>POR EL MANDATANTE:</b></p></td>
            </tr>
            <tr>
              <td style="width: 50%;">
                <img width="300" src="{{$firmaAdmin}}" alt=""> 
              </td>
              <td style="width: 50%;">
                @if($inversion != null && $inversion->firma_cliente	) 
                  <img width="300" src="{{base64_decode($inversion->firma_cliente)}}" alt=""> 
                @endif
              </td>
            </tr>
            <tr>
              <td class="text-center"><span class="text-center">___________________________________</span></td>
              <td class="text-center"><span class="text-center">___________________________________</span></td>
            </tr>
            <tr>
              <td>Nombre: Gerson Osorio Moncada</td>
              <td>Nombre: {{$inversion->getUser->fullname}}</td>
            </tr>
            <tr>
              <td>C.C 1073508892</td>
              <td>C.C {{$inversion->getUser->num_documento}}</td>
            </tr>
          </tbody>
        </table>
  </body>
</html>