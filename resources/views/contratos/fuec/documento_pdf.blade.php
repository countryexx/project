<!DOCTYPE html>
<html><head>
    <meta>
    <title>Fuec N° {{$fuec->id}}</title>
    <style type="text/css">
    	body {
			font-family: 'Arimo', sans-serif !important;
			font-size: 10px !important;
      letter-spacing: 0.09em;
      word-spacing: 0.09em;
		}
    </style>
  </head><body background="{{url('files/biblioteca/marca_agua.png')}}" style="background-repeat: no-repeat;" >
    
    <table border="0" cellspacing="0" width="700px" align="center">
  		  <tr>
    			<td>
    				<img src="{{url('files/biblioteca/transporte.png')}}" width="350px" height="100px">
    			</td>
    			<td>
            <img src="{{url('files/biblioteca/logo.png')}}" width="130px" height="140px" align="left">
          </td>
    		</tr>
  	</table>
    <br><br><br><br>
  	<table cellspacing="0" width="700px">
  		<tr>
  		  <td style="text-align: center;" align="center">
          <b style="font-size: 14px">FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</b>
          <br><br>
          <b style="font-size: 16px">Número: <span style="color: red">{{$fuec->id}}</span></b>
        </td>
  		</tr>
  	</table>
  	&nbsp;
    <br>
    <p>RAZÓN SOCIAL DE LA EMPRESA DE TRANSPORTE ESPECIAL: TRANSPORTES ESPECIALES COUNTRY EXPRESS S.A.S</p>
    
    <p style="margin-top: 1px">NIT. 901.761.474-0</p>
    
    <p>CONTRATO No. {{$fuec->contrato}}</p>
    
    <p>CONTRATANTE: {{$fuec->razonsocial}}</p>
    
    <p>NIT/CC. {{$fuec->identificacion}}</p>
    
    <p>OBJETO CONTRATO: {{$fuec->objeto_contrato}}</p>
    
    <p>ORIGEN-DESTINO: {{$fuec->origen}} - {{$fuec->destino}}</p>
    
    <p>CONVENIO DE COLABORACIÓN: </p>
    
  	&nbsp;
    <p style="text-align: center; margin: 0 0 5px 0; font-size: 12px; font-weight: bold;">VIGENCIA DEL CONTRATO</p>
  	<table border="1" cellspacing="2" width="700px">

      <tr>
        <?php
        $fecha_in = explode('-',$fuec->fecha_inicio);
        $fecha_fn = explode('-',$fuec->fecha_fin);
        ?>
        <td colspan="2">FECHA INICIAL</td>
        <td colspan="2" style="text-align: center;">DIA<br> {{$fecha_in[2]}}</td>
        <td colspan="2" style="text-align: center;">MES<br> {{$fecha_in[1]}}</td>
        <td colspan="2" style="text-align: center;">AÑO<br> {{$fecha_in[0]}}</td>
      </tr>
      <tr>
        <td colspan="2">FECHA VENCIMIENTO</td>
        <td colspan="2" style="text-align: center;">DIA <br> {{$fecha_fn[2]}}</td>
        <td colspan="2" style="text-align: center;">MES <br> {{$fecha_fn[1]}}</td>
        <td colspan="2" style="text-align: center;">AÑO <br> {{$fecha_fn[0]}}</td>
      </tr>
  		
  	</table>
    </br>
  	&nbsp;
    <p style="text-align: center; margin: 0 0 5px 0; font-size: 12px; font-weight: bold;">CARACTERÍSTICAS DEL VEHÍCULO</p>
  	<table border="1" cellspacing="2" width="700px">
      <tr>
  			<td style="text-align: center" align="center" colspan="2"><b>PLACA</b></td>
  			<td style="text-align: center" align="center" colspan="3"><b>MODELO</b></td>
  			<td style="text-align: center" align="center" colspan="2"><b>MARCA</b></td>
  			<td style="text-align: center" align="center" colspan="3"><b>CLASE</b></td>
  		</tr>
  		<tr>
  			<td style="text-align: center" align="center" colspan="2">{{$fuec->placa}}</td>
  			<td style="text-align: center" align="center" colspan="3">{{$fuec->modelo}}</td>
  			<td style="text-align: center" align="center" colspan="2">{{$fuec->marca}}</td>
  			<td style="text-align: center" align="center" colspan="3">{{$fuec->clase}}</td>
  		</tr>
      
  		<tr>
  			<td style="text-align: center" align="center" colspan="5"><b>NUMERO INTERNO</b></td>
  			<td style="text-align: center" align="center" colspan="5"><b>NUMERO TARJETA DE OPERACION</b></td>
  		</tr>
  		<tr>
  			<td style="text-align: center" align="center" colspan="5">{{$fuec->codigo_interno}}</td>
  			<td style="text-align: center" align="center" colspan="5">{{$fuec->numero_tarjeta_operacion}}</td>
  		</tr>

    		<tr>
    		  <td style="text-align: center" align="center" colspan="2">DATOS DEL CONDUCTOR 1<br></td>
    		  <td style="text-align: center" align="center" colspan="2">NOMBRES Y APELLIDOS<br>{{$fuec->nombres.' '.$fuec->apellidos}}</td>
    		  <td style="text-align: center" align="center" colspan="2">No. CÉDULA<br>{{$fuec->cedula}}</td>
    		  <td style="text-align: center" align="center" colspan="2">No. LICENCIA CONDUCCION<br>{{$fuec->cedula}}</td>
    		  <td style="text-align: center" align="center" colspan="2">VIGENCIA<br>{{$fuec->vigencia_licencia}}</td>
    		</tr>
  	 
       <?php
              
          $razonsocial = 'COUNTRY EXPRESS';
          $nit = '123.456.789';
          $telefono = '3510000';
          $direccion = 'CRA 43 No. 76b - 187';
          
        ?>

  	  <tr>
  			<td style="text-align: center" align="center" colspan="2">RESPONSABLE DEL CONTRATANTE</td>
  			<td style="text-align: center" align="center" colspan="2">NOMBRES Y APELLIDOS<br>{{$razonsocial}}</td>
  			<td style="text-align: center" align="center" colspan="2">No. CEDULA<br>{{$nit}}</td>
  			<td style="text-align: center" align="center" colspan="2">TELEFONO<br>{{$telefono}}</td>
  			<td style="text-align: center" align="center" colspan="2">DIRECCION<br>{{$direccion}}</td>
  	  </tr>

      <tr>
        <td style="text-align: center" align="center" colspan="2">
          <img src="data:image/png;base64,{{DNS2D::getBarcodePNG(url('/').'/fuec/stream/'.$fuec->id, "QRCODE", 3, 3,array(1,1,1), true)}}" alt="barcode" />
          <p>Escanear el código para verificar</p>
        </td>
        <td style="text-align: center" align="center" colspan="4">
          AV 6 ESTE 9 39 - La riviera<br>
          Teléfono: +57 (601) 7125977<br>
          gerencia@countryexp.com<br>
          www.countryexp.com<br>
          Cúcuta, Norte de Santander
        </td>
        <td style="text-align: center" align="center" colspan="4">

          <img width="150" src="{{url('files/biblioteca/firma.png')}}"><br>
             <p>Firma Digital Representante Legal</p>
        </td>
      </tr>
  	  
  	</table>
    <br>
    <span style="text-align: center; margin-top: 10px">GENERADO POR SR(A) {{$fuec->name.' '.$fuec->last_name}} - EL {{$fuec->created_at}} DESDE EL SISTEMA FUEC DE TRANSPORTES ESPECIALES COUNTRY EXPRESS S.A.S
    </span>

  	<table border="0" cellspacing="0" width="700px">
        
        <tr>
            <td><img src="{{url('files/biblioteca/st.png')}}" width="200px" height="70px" align="center"></td>
            <td></td>
        </tr>
        
  	</table>
    <div>


    </div>
    <div style="page-break-after: always;"></div>
    <center><strong style="font-size: 18px">INSTRUCTIVO PARA DETERMINACION DEL NÚMERO CONSECUTIVO DEL FUEC</strong></center>
    <br><br>
    <p>El Formato Único de Extracto del Contrato "FUEC" estará constituida por los siguientes números:</p>
    <p>a.)	Los tres primeros dígitos de izquierda a derecha corresponderán al código de la Dirección Territorial que otorgó la habilitación de la empresa de Transporte de Servicio Especial.</p>
    <br>
    <table border="3" cellspacing="1" width="730px" align="center">
        <tr>
            <td>Antioquia-Choco</td>
            <td>305</td>
            <td>Huila-Caquetá</td>
            <td>441</td>
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
    <br>
    <p>b.)	Los cuatro dígitos siguientes señalaran el número de resolución mediante la cual se otorgó la habilitación de la Empresa. En caso que la resolución no tenga estos dígitos, los faltantes serán completados con ceros a la izquierda.</p><br>
    <p>c.)	Los dos siguientes dígitos, corresponderán a los dos últimos del año en que la empresa fue habilitada.</p><br>
    <p>d.)	A continuación cuatro dígitos que corresponderán al año en el que se expide el extracto del contrato.</p><br>
    <p>e.)	Posteriormente, cuatro dígitos que identifican el número del contrato. La numeración debe ser consecutiva, establecida por cada empresa e iniciará con los contratos de prestación del servicio celebrados para el transporte de estudiantes, asalariados, turistas o grupo de usuarios, vigentes al momento de entrar en vigor la presente resolución.</p><br>
    <p>f.)	Finalmente, los cuatro últimos dígitos corresponderán al número consecutivo del extracto de contrato. Se debe expedir un nuevo extracto por vencimiento del plazo inicial del mismo o por cambio del vehículo.</p><br>

    <p>EJEMPLO:</p>
    <p>Empresa habilitada por la Dirección Territorial Cundinamarca en el año 2012, con resolución de habilitación No. 0155, que expide el primer extracto del contrato en el año 2015, del contrato 255. El número del Formato Único de Extracto de Contrato “FUEC” será: 425015512201502550001.</p>


</body></html>
