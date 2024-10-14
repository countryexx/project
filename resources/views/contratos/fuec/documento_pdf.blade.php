<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>FUEC{{$fuec->id}}</title>
    <!--<link href='https://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>-->
    <style type="text/css">
    	body {
			font-family: 'Arimo', sans-serif !important;
			font-size: 12px !important;
		}
    </style>
  </head><body background="biblioteca_imagenes/fondo_pdf_new.png" style="background-repeat: no-repeat;">
    <table border="0" cellspacing="0" width="700px">
  		  <tr>
  			<td>
  				<img src="biblioteca_imagenes/mintransportenuevo.png" width="350px" height="80px">
  			</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<img src="biblioteca_imagenes/iso.png" width="110px" height="80px" align="left">

        </td>
  			<td>&nbsp;&nbsp;&nbsp;&nbsp;<img src="biblioteca_imagenes/logo_excel.png" width="220px" height="45px" align="left"></td>
  		</tr>
  	</table>
  	<table border="1" cellspacing="0" width="700px">
  		<tr>
  		  <td style="text-align: center;" align="center">
          <b>FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE DEL AUTOMOTOR ESPECIAL - No, 208,0147,17,2024,{{$fuec->contrato}},{{$fuec->id}}</b>
        </td>
  		</tr>
  	</table>
    </br></br>
  	&nbsp;
    <br><br>
    RAZÓN SOCIAL: COUNTRY EXPRESS
    <br>
    NIT: 819,003,684-2
    <br>
    CONTRATO No: {{$fuec->contrato}}
    <br>
    CONTRATANTE: {{$fuec->razonsocial}}
    <br>
    NIT/CC/PAS: {{$fuec->identificacion}}
    <br>
    OBJETO CONTRATO: {{$fuec->objeto_contrato}}
    <br>
    ORIGEN-DESTINO: {{$fuec->origen}} - {{$fuec->destino}}
    <br>
    CONVENIO 
    <br>
  	&nbsp;
    <p style="text-align: center; margin: 0 0 5px 0; font-size: 15px">VIGENCIA DEL CONTRATO</p>
  	<table border="1" cellspacing="0" width="700px">

      <tr>
        <?php
        $fecha_in = explode('-',$fuec->fecha_inicio);
        $fecha_fn = explode('-',$fuec->fecha_fin);
        ?>
        <td colspan="2">FECHA INICIAL</td>

        <td colspan="2">DIA: {{$fecha_in[2]}}</td>
        <td colspan="2">MES: {{$fecha_in[1]}}</td>
        <td colspan="2">AÑO: {{$fecha_in[0]}}</td>
      </tr>
      <tr>
        <td colspan="2">FECHA VENCIMIENTO</td>
        <td colspan="2">DIA: {{$fecha_fn[2]}}</td>
        <td colspan="2">MES: {{$fecha_fn[1]}}</td>
        <td colspan="2">AÑO: {{$fecha_fn[0]}}</td>
      </tr>
  		
  	</table>
    </br></br>
  	&nbsp;
    <p style="text-align: center; margin: 0 0 5px 0; font-size: 15px;">CARACTERÍSTICAS DEL VEHÍCULO</p>
  	<table border="1" cellspacing="0" width="700px">
      <tr>
  			<td style="text-align: center" align="center" colspan="2">PLACA</td>
  			<td style="text-align: center" align="center" colspan="2">MODELO</td>
  			<td style="text-align: center" align="center" colspan="2">MARCA</td>
  			<td style="text-align: center" align="center" colspan="2">CLASE</td>
  		</tr>
  		<tr>
  			<td style="text-align: center" align="center" colspan="2">{{$fuec->placa}}</td>
  			<td style="text-align: center" align="center" colspan="2">{{$fuec->modelo}}</td>
  			<td style="text-align: center" align="center" colspan="2">{{$fuec->marca}}</td>
  			<td style="text-align: center" align="center" colspan="2">{{$fuec->clase}}</td>
  		</tr>
      <tr>
        <td style="text-align: center" align="center" colspan="8"></td>
      </tr>
  		<tr>
  			<td style="text-align: center" align="center" colspan="4">NUMERO INTERNO</td>
  			<td style="text-align: center" align="center" colspan="4">NUMERO TARJETA DE OPERACION</td>
  		</tr>
  		<tr>
  			<td style="text-align: center" align="center" colspan="4">{{$fuec->codigo_interno}}</td>
  			<td style="text-align: center" align="center" colspan="4">{{$fuec->numero_tarjeta_operacion}}</td>
  		</tr>

    		<tr>
    		  <td rowspan="2" style="text-align: center" align="center">DATOS DEL CONDUCTOR 1<br></td>
    		  <td style="text-align: center" align="center" colspan="4">NOMBRES Y APELLIDOS</td>
    		  <td style="text-align: center" align="center">No. CEDULA</td>
    		  <td style="text-align: center" align="center">No. LICENCIA CONDUCCION</td>
    		  <td style="text-align: center" align="center">VIGENCIA</td>
    		</tr>
    		<tr>
    		  <td style="text-align: center" align="center" colspan="4"> {{$fuec->nombres.' '.$fuec->apellidos}}<br><br></td>
    		  <td style="text-align: center" align="center"> {{$fuec->cedula}}<br></td>
    		  <td style="text-align: center" align="center"> {{$fuec->cedula}}<br></td>
    		  <td style="text-align: center" align="center"> {{$fuec->vigencia_licencia}}<br></td>
    		</tr>
  	  
  	  <tr>
  			<td rowspan="2" style="text-align: center" align="center">RESPONSABLE DEL CONTRATANTE</td>
  			<td style="text-align: center" align="center" colspan="4">NOMBRES Y APELLIDOS</td>
  			<td style="text-align: center" align="center">No. CEDULA</td>
  			<td style="text-align: center" align="center">TELEFONO</td>
  			<td style="text-align: center" align="center">DIRECCION</td>
  	  </tr>
  	  <tr>

    			<?php
      			
    			  $razonsocial = 'COUNTRY EXPRESS';
    			  $nit = '123.456.789';
    			  $telefono = '3510000';
    			  $direccion = 'CRA 53 No. 68B-87';
      			
    			?>

  			<td colspan="4" valign="center" style="text-align: center" align="center">{{$razonsocial}}</td>
  			<td valign="center" style="text-align: center" align="center">{{$nit}}</td>
  			<td valign="center" style="text-align: center" align="center">{{$telefono}}</td>
  			<td valign="center" style="text-align: center" align="center">{{$direccion}}</td>
  	  </tr>
  	</table>
  	<table border="0" cellspacing="0" width="700px">
        <tr>
           <td colspan="6" rowspan="1">
               <p style="margin: 0; padding: 0;">&nbsp;</p>
               Carrera 43 # 75b - 187<br>
               (57) (5) 358 2555 - 358 2003<br>
               Móvil Nacional: 018000 510 400<br>
               gerencia@countryexp.com
           </td>
           <td colspan="6" rowspan="2" align="center">
               <img width="250" src="img/firma_pdf.png"><br>
               <b>_______________________________________</b><br>
               <b>FIRMA Y SELLO GERENTE CONTRATO</b>
           </td>
        </tr>
        <tr>
            <td><img src="biblioteca_imagenes/logo_supertransportenuevo.png" width="170px" height="65px" align="left"></td>
            <td></td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
            <td>
                
                <p>Escanear este codigo para ver este documento en linea</p>
            </td>
        </tr>
  	</table>
    <div>


    </div>
    <div style="page-break-after: always;"></div>
    <center><strong>INSTRUCTIVO PARA DETERMINACION DEL NÚMERO CONSECUTIVO DEL FUEC</strong></center>
    <p>El Formato Único de Extracto del Contrato "FUEC" estará constituida por los siguientes números:</p>
    <p>a.)	Los tres primeros dígitos de izquierda a derecha corresponderán al código de la Dirección Territorial que otorgó la habilitación de la empresa de Transporte de Servicio Especial.</p>

    <table border="1" cellspacing="0" width="500px" align="center">
        <tr>
            <td>Antioquia-Choco</td>
            <td align="center">305</td>
            <td>Huila-Caquetá</td>
            <td align="center">441</td>
        </tr>
        <tr>
            <td>Atlántico</td>
            <td>208</td>
            <td>Magdalena</td>
            <td>247</td>
        </tr>
        <tr>
            <td>Bolívar - San Andres y Providencia</td>
            <td>213</td>
            <td>Meta - Vaupés - Vichada</td>
            <td>550</td>
        </tr>
        <tr>
            <td>Boyacá-Casanare</td>
            <td>415</td>
            <td>Nariño-Putumayo</td>
            <td>352</td>
        </tr>
        <tr>
            <td>Caldas</td>
            <td>317</td>
            <td>N/Santander-Arauca</td>
            <td>454</td>
        </tr>
        <tr>
            <td>Cauca</td>
            <td>219</td>
            <td>Quindío</td>
            <td>363</td>
        </tr>
        <tr>
            <td>Cesar</td>
            <td>220</td>
            <td>Risaralda</td>
            <td>366</td>
        </tr>
        <tr>
            <td>Córdoba-Sucre</td>
            <td>223</td>
            <td>Santander</td>
            <td>468</td>
        </tr>
        <tr>
            <td>Cundinamarca</td>
            <td>425</td>
            <td>Tolima</td>
            <td>473</td>
        </tr>
        <tr>
            <td>Guajira</td>
            <td>241</td>
            <td>Valle del Cauca</td>
            <td>376</td>
        </tr>
    </table>
    <p>b.)	Los cuatro dígitos siguientes señalaran el número de resolución mediante la cual se otorgó la habilitación de la Empresa. En caso que la resolución no tenga estos dígitos, los faltantes serán completados con ceros a la izquierda.</p>
    <p>c.)	Los dos siguientes dígitos, corresponderán a los dos últimos del año en que la empresa fue habilitada.</p>
    <p>d.)	A continuación cuatro dígitos que corresponderán al año en el que se expide el extracto del contrato.</p>
    <p>e.)	Posteriormente, cuatro dígitos que identifican el número del contrato. La numeración debe ser consecutiva, establecida por cada empresa e iniciará con los contratos de prestación del servicio celebrados para el transporte de estudiantes, asalariados, turistas o grupo de usuarios, vigentes al momento de entrar en vigor la presente resolución.</p>
    <p>f.)	Finalmente, los cuatro últimos dígitos corresponderán al número consecutivo del extracto de contrato. Se debe expedir un nuevo extracto por vencimiento del plazo inicial del mismo o por cambio del vehículo.</p>

    <strong>EJEMPLO:</strong>
    <p>Empresa habilitada por la Dirección Territorial Cundinamarca en el año 2012, con resolución de habilitación número 0155, que expide el primer extracto del contrato en el año 2015, del contrato número 255. El número del Formato Único de Extracto del Contrato "FUEC" será 425120155201502550001.</p>

    <iframe src="{{url('files/documentacion/operadores/arl/doc2.pdf')}}"></iframe>


</body></html>
