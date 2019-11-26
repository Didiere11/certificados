<?php
//---------------------------------------------------------------------
// Utilerias de Bases de Dato
// Alejandro Guzmán Zazueta
// Septiembre 2019
//---------------------------------------------------------------------

try{
        //$Cn = new PDO('mysql:host=localhost; dbname=bdalumnos','root','');    //MYSQL
        $Cn = new PDO('pgsql:host=localhost;port=5432;dbname=PWeb;user=postgres;password=hola');
        $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
        //$Cn->exec("SET CHARACTER SET utf8");                                  // MYSQL
}catch(Exception $e){
    die("Error: " . $e->GetMessage());
}

// Función para ejecutar consultas SELECT
function Consulta($query)
{
    global $Cn;
 
    try{    
        $result =$Cn->query($query);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC); 
        $result->closeCursor();
        return $resultado;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }
}

// Función que recibe un insert y regresa el consecutivo que le genero en la llave primaria
// por ejemplo: Insert Into cuerpo.clasif (nomclasif) values ('Articulo en Extenso') 
// Returning idclasif, nomclasif;
function EjecutaConsecutivo($sentencia, $llave){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $resultado[0][$llave];
    } catch (Exception $e) {
        die("Error en la linea: " + $e->getLine() + " MSG: " + $e->GetMessage());
        return 0;
    }
}
// Sirve para ejecutar una sentencia INSERT, UPDATE O DELETE
function Ejecuta ($sentencia){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $result->closeCursor();
        return 1; // Exito  
    } catch (Exception $e) {
        //die("Error en la linea: " + $e->getLine() + " MSG: " + $e->GetMessage());
        return 0; // Fallo
    }
}
//----------------------------------PERFIL-------------------------------------

function opcAsignadas($idrol)
{
    $query = "select b.* from cuerpo.perfil a inner join cuerpo.opcmenu b on (a.idopcmenu = b.idopcmenu) where a.idrol=$idrol order by nommenu";
    return Consulta($query);
}

function opcDisponibles($idrol)
{
    $query = "select a.* from cuerpo.opcmenu a where a.idopcmenu not in (select b.idopcmenu from cuerpo.perfil b where b.idrol = $idrol)
    order by nommenu";
    return Consulta($query);
}

function eliminaPerfil($post){
    $idopc = $post['ido'];
    $idrol = $post['idr'];
    $sentencia = "DELETE FROM cuerpo.perfil WHERE idopcmenu=$idopc and idrol=$idrol";
    return Ejecuta($sentencia);
}

function insertarPerfil($post){
    $idopc = $post['ido'];
    $idrol = $post['idr'];
    $sentencia = "INSERT INTO cuerpo.perfil(idrol,idopcmenu) values($idrol,$idopc)";
    return Ejecuta($sentencia);
}

//---------------------------------ROL-------------------------------------
function consultaRol()
{
    $query = "SELECT idrol,nomrol FROM cuerpo.rol ORDER BY nomrol";
    return Consulta($query);
}

function InsertarRol(&$post){
    $idr = $post['idr'];
    $nom = $post['nomr'];
    $sentencia = "INSERT INTO cuerpo.rol(nomrol) values('$nom') RETURNING idrol";
    $id = EjecutaConsecutivo($sentencia,"idrol");
    $post['idr']=$id;
    return $id;
}

function ActualizarRol($post){
    $idr = $post['idr'];
    $nom = $post['nomr'];
    $sentencia = "UPDATE cuerpo.rol SET nomrol='$nom' WHERE idrol=$idr";
    return Ejecuta($sentencia);
}

function EliminarRol($post){
    $idr = $post['idr'];
    $sentencia = "DELETE FROM cuerpo.rol WHERE idrol=$idr";
    return Ejecuta($sentencia);
}

//-------------------------------USUARIO-----------------------------------

function ValidaOpcion($idopc){
    if  (!isset($_SESSION))
        session_start();
    $idSess = session_id();
    $corr = $_SESSION["correo"];
    $query = "SELECT  idmenu FROM cuerpo.usuario A inner Join cuerpo.perfil B On (A.idrol = B.idrol) 
         Inner Join cuerpo.opcmenu C On (B.idopcmenu = C.idopcmenu)
    WHERE correousr='$corr' and session= '$idSess' and C.idmenu='$idopc'";
    $res = Consulta($query);
    $opc = "";
    foreach ($res as $tupla)
    {
        $opc = $tupla["idmenu"];
    }
    return $opc;
}

function ValidaUsr($post, $ids,&$img){
    $corr = $post['usr'];
    $contra = $post['contra'];
    $query = "SELECT idusuario,correousr,nomusr,contrasena,idrol,imagen  
    FROM cuerpo.usuario Where correousr= '$corr'";
    $res =  Consulta($query);
    $pwdEnc = "";
    $idrol = 0;
    foreach ($res as $tupla)
    {
        $pwdEnc = $tupla['contrasena'];
        $idrol = $tupla['idrol'];
        $img = $tupla['imagen'];
    }
    if (password_verify($contra, $pwdEnc) ){   
        $sentencia = "Update cuerpo.usuario set session='$ids' where correousr= '$corr'";
        return Ejecuta($sentencia);
    }
    else{
        return 0;   
    }
}

function consultaUsr()
{
    $query = "SELECT idusuario,correousr,nomusr,contrasena,A.idrol,nomrol FROM cuerpo.usuario A Inner Join cuerpo.rol B on (A.idrol = B.idrol) ORDER BY nomusr";
    return Consulta($query);
}

function InsertarUsuario(&$post,$noma){
    $corr = $post['corr'];
    $nom = $post['nom'];
    $contra = $post['contra'];
    $pwdEnc = password_hash($contra, PASSWORD_DEFAULT);
    $idrol = $post['idrol'];
    $sentencia = "INSERT INTO cuerpo.usuario(correousr,nomusr,contrasena,idrol,imagen) values('$corr','$nom','$pwdEnc',$idrol,'$noma') RETURNING idusuario";
    $id = EjecutaConsecutivo($sentencia,"idusuario");
    $post['idusr']=$id;
    $post['contra']=$pwdEnc;
    return $id;
}

function ActualizarUsuario($post,$noma){
    $idusr = $post['idusr'];
    $corr = $post['corr'];
    $nom = $post['nom'];
    $contra = $post['contra'];
    $idrol = $post['idrol'];
    if ($noma == "")
        $sentencia = "UPDATE cuerpo.usuario SET nomusr='$nom', contrasena='$contra', idrol=$idrol, correousr='$corr' WHERE idusuario=$idusr";
    else
        $sentencia = "UPDATE cuerpo.usuario SET nomusr='$nom', contrasena='$contra', idrol=$idrol, correousr='$corr', imagen = '$noma' WHERE idusuario=$idusr";
    return Ejecuta($sentencia);
}

function EliminarUsuario($post){
    $idusr = $post['idusr'];
    $sentencia = "DELETE FROM cuerpo.usuario WHERE idusuario=$idusr";
    return Ejecuta($sentencia);
}
//----------------------------MENU-------------------------------
function consultaMenu()
{
    $query = "SELECT idopcmenu,idmenu,nommenu,orden FROM cuerpo.opcmenu ORDER BY orden";
    return Consulta($query);
}

function InsertarMenu(&$post){
    $idm = $post['idm'];
    $nomm = $post['nomm'];
    $orden = $post['orden'];
    $sentencia = "INSERT INTO cuerpo.opcmenu(idmenu,nommenu,orden) values ('$idm','$nomm',$orden) RETURNING idopcmenu";
    $id = EjecutaConsecutivo($sentencia,"idopcmenu");
    $post['idopc']=$id;
    return $id;
}

function ActualizarMenu($post){
    $idopc = $post['idopc'];
    $idm = $post['idm'];
    $nomm = $post['nomm'];
    $orden = $post['orden'];
    $sentencia = "UPDATE cuerpo.opcmenu SET idmenu='$idm', nommenu='$nomm', orden=$orden WHERE idopcmenu=$idopc";
    return Ejecuta($sentencia);
}

function EliminarMenu($post){
    $idopc = $post['idopc'];
    $sentencia = "DELETE FROM cuerpo.opcmenu WHERE idopcmenu=$idopc";
    return Ejecuta($sentencia);
}

//--------------------------CLASIF-------------------------------------
function consultaClasif()
{
    $query = "SELECT idclasif,nomclasif FROM cuerpo.clasif ORDER BY nomclasif";
    return Consulta($query);
}

function InsertarClasif(&$post){
    $nom = $post['nomc'];
    $sentencia = "INSERT INTO cuerpo.clasif(nomclasif) values('$nom') RETURNING idclasif";
    $id = EjecutaConsecutivo($sentencia,"idclasif");
    // En el idc colocamos el valor que nos regresa el Returning 
    // que es el Consecutivo que se genero por ser de tipo SERIAL
    $post['idc']=$id; 
    return $id;
}

function ActualizarClasif($post){
    $idc = $post['idc'];
    $nom = $post['nomc'];
    $sentencia = "UPDATE cuerpo.clasif SET nomclasif='$nom' WHERE idclasif=$idc";
    return Ejecuta($sentencia);
}

function EliminarClasif($post){
    $idc = $post['idc'];
    $sentencia = "DELETE FROM cuerpo.clasif WHERE idclasif=$idc";
    return Ejecuta($sentencia);
}

//----------------------Empleado---------------------------
function consultaEmpleado()
{
    $query = "SELECT idemp,nomemp,apemp,telemp,numcontrol FROM cuerpo.empleado ORDER BY nomemp";
    return Consulta($query);
}






//--------------------------Sensado-------------------------------
function consultaInformeSensado($ini,$fin)
{
    $query = "SELECT idsen,nomsensor,valor FROM cuerpo.sensado WHERE valor >= $ini And valor <= $fin ORDER BY nomsensor";
    return Consulta($query);
}

function consultaSensado()
{
    $query = "SELECT idsen,nomsensor,valor,imagen FROM cuerpo.sensado ORDER BY nomsensor";
    return Consulta($query);
}

function InsertarSensado(&$post){
    $noms = $post['noms'];
    $val = $post['valor'];
    $sentencia = "INSERT INTO cuerpo.sensado(nomsensor,valor) values('$noms', $val) RETURNING idsen";
    $id = EjecutaConsecutivo($sentencia,"idsen");
    $post['ids']=$id; 
    return $id;
}

function ActualizarSensado($post){
    $ids = $post['ids'];
    $noms = $post['noms'];
    $val = $post['valor'];
    $sentencia = "UPDATE cuerpo.sensado SET nomsensor='$noms', valor=$val WHERE idsen=$ids";
    return Ejecuta($sentencia);
}

function EliminarSensado($post){
    $ids = $post['ids'];
    $sentencia = "DELETE FROM cuerpo.sensado WHERE idsen=$ids";
    return Ejecuta($sentencia);
}

function InsertaSen(&$post){
    $id = $post['idsen'];
    $noms = $post['nomsensor'];
    $val = $post['valor'];
    $sentencia = "INSERT INTO cuerpo.sensado(idsen,nomsensor,valor) values($id, '$noms', $val)";
    return Ejecuta($sentencia);
}

function ActualizarSen($post){
    $ids = $post['idsen'];
    $noms = $post['nomsensor'];
    $val = $post['valor'];
    $sentencia = "UPDATE cuerpo.sensado SET nomsensor='$noms', valor=$val WHERE idsen=$ids";
    return Ejecuta($sentencia);
}

function InsActSen($post){
    if (InsertaSen($post)!=1)
        return ActualizarSen($post);
    else
        return 1;
}

function obj2array($obj) {
    $out = array();
    foreach ($obj as $key => $val) {
      switch(true) {
          case is_object($val):
           $out[$key] = obj2array($val);
           break;
        case is_array($val):
           $out[$key] = obj2array($val);
           break;
        default:
          $out[$key] = $val;
      }
    }
    return $out;
  } 

//------------------------------------------------------------

function validaSess(&$correo, &$tu, &$idsess){
    $correo = $correo;
    $sql = 'SELECT idsession,tipousr FROM "Escuela".usuario  WHERE correo like ' . "'" . $correo . "'";
    $res = Consulta($sql);
    $tipo = 0;
    foreach ($res as $tupla )
    {
        $idsess = $tupla['idsession'];
        $tu = $tupla['tipousr'];
    }   
    return 0;
}

//---------------------------------DeviceType-------------------------------------
function consultaDeviceType()
{
    $query = "SELECT iddevicetype,namedevice FROM cuerpo.devicetype ORDER BY namedevice";
    return Consulta($query);
}

function InsertarDeviceType(&$post){
    $idt = $post['idt'];
    $namt = $post['namt'];
    $sentencia = "INSERT INTO cuerpo.devicetype(namedevice) 
    values('$namt') RETURNING iddevicetype";
    $id = EjecutaConsecutivo($sentencia,"iddevicetype");
    $post['idt']=$id;
    return $id;
}

function ActualizarDeviceType($post){
    $idt = $post['idt'];
    $namt = $post['namt'];
    $sentencia = "UPDATE cuerpo.devicetype SET namedevice='$namt' WHERE iddevicetype=$idt";
    return Ejecuta($sentencia);
}

function EliminarDeviceType($post){
    $idt = $post['idt'];
    $sentencia = "DELETE FROM cuerpo.devicetype WHERE iddevicetype=$idt";
    return Ejecuta($sentencia);
}
//---------------------------------Padre o tutor
function consultaPadreTutor(){
    $query = "SELECT idpadre,nompadre,correopadre,parentesco,dompadre,telpadre FROM cuerpo.padretutor ORDER BY nompadre";
    return Consulta($query);
}
function EliminarPadreTutor($post){
    $idp = $post['idpadre'];
    $sentencia = "DELETE FROM cuerpo.padretutor WHERE idpadre=$idp";
    return Ejecuta($sentencia);
}
function InsertarPadreTutor(&$post){
    $nom = $post['nom'];
    $corr = $post['corr'];
    $paren = $post['parent'];
    $dom = $post['dom'];
    $tel = $post['tel'];
    $sentencia = "INSERT INTO cuerpo.padretutor(nompadre,correopadre,parentesco,dompadre,telpadre) 
    values('$nom','$corr','$paren','$dom','$tel') RETURNING idpadre";
    $id = EjecutaConsecutivo($sentencia,"idpadre");
    $post['idpadre']=$id;
    return $id;
}
function ActualizarPadreTutor($post){
    $idp = $post['idpadre'];
    $nom = $post['nom'];
    $corr = $post['corr'];
    $paren = $post['parent'];
    $dom = $post['dom'];
    $tel = $post['tel'];
    $sentencia = "UPDATE cuerpo.padretutor SET nompadre='$nom', correopadre ='$corr',parentesco='$paren',dompadre='$dom',telpadre='$tel' WHERE idpadre=$idp";
    return Ejecuta($sentencia);
}
//////////////////////////Reportes Certificados ////////////////////////////////////
function consultachidaaa(){
    $query = "SELECT A.nocontrol, A.nombre ,A.apellidos,A.correo,A.telefono,B.stat, C.carr
    FROM cuerpo.reportes A
        INNER JOIN cuerpo.stat B ON
            (A.idsta = B.idsta)
            inner join cuerpo.carrera C ON
            (A.idcarr = C.idcarr)
			where A.idsta=8
        Order BY
            A.nocontrol";
    return Consulta($query);
}

function consultareportes(){
    $query = "SELECT A.nocontrol, A.nombre ,A.apellidos,A.correo,A.telefono,B.stat, C.carr,E.ingreso
    FROM cuerpo.reportes A
        INNER JOIN cuerpo.stat B ON
            (A.idsta = B.idsta)
        inner join cuerpo.carrera C ON
            (A.idcarr = C.idcarr)
		INNER JOIN cuerpo.ingreso E ON
			(E.idingr = A.idingr)
        Order BY
            A.nocontrol";
    return Consulta($query);
}
function Eliminarreportes($post){
    $nocontrol = $post['nocontrol'];
    $sentencia = "DELETE FROM cuerpo.reportes WHERE nocontrol=$nocontrol";
    return Ejecuta($sentencia);
}

function GuardarReportes($post){
    $nocontrol = $post['nocontrol'];
    $nom = $post['nom'];
    $appe = $post['appe'];
    $idsta = $post['idsta'];
    $corr = $post['corr'];
    $tel = $post['tel'];
    $idcarr = $post['idcarr'];
    $idingr = $post['idingr'];
    $sentencia = "INSERT INTO cuerpo.reportes(nocontrol,nombre,apellidos,correo,telefono,idsta,idcarr,idingr) 
    values('$nocontrol','$nom','$appe','$corr','$tel',$idsta,$idcarr,$idingr)";
    $id = Ejecuta($sentencia);
    if ($id)    
        return $id;
    else{
        $sentencia = "UPDATE cuerpo.reportes SET nocontrol='$nocontrol', nombre ='$nom',apellidos='$appe',correo='$corr',telefono='$tel',idsta=$idsta,idcarr=$idcarr,idingr=$idingr WHERE nocontrol=$nocontrol";
        return Ejecuta($sentencia);
    }
}
///////////////estatus///////////////////
function consultaEst()
{
    $query = "SELECT idsta,stat FROM cuerpo.stat ORDER BY idsta";
    return Consulta($query);
}

function InsertarEst(&$post){
    $idstat = $post['idsta'];
    $stat = $post['stat'];
    $sentencia = "INSERT INTO cuerpo.stat(stat) values('$stat') RETURNING idsta";
    $id = EjecutaConsecutivo($sentencia,"idsta");
    $post['idsta']=$id;
    return $id;
}
function ActualizarEst($post){
    $idstat = $post['idsta'];
    $stat = $post['stat'];
    $sentencia = "UPDATE cuerpo.stat SET stat='$stat' WHERE idsta=$idstat";
    return Ejecuta($sentencia);
}

function EliminarEst($post){
    $idstat = $post['idsta'];
    $sentencia = "DELETE FROM cuerpo.stat WHERE idsta=$idstat";
    return Ejecuta($sentencia);
}
/////////carrera////////////////////////////////////////////////////
function consultaCarr()
{
    $query = "SELECT idcarr,carr FROM cuerpo.carrera ORDER BY idcarr";
    return Consulta($query);
}

function InsertarCarr(&$post){
    $idcarr = $post['idcarr'];
    $carr = $post['carr'];
    $sentencia = "INSERT INTO cuerpo.carrera(carr) values('$carr') RETURNING idcarr";
    $id = EjecutaConsecutivo($sentencia,"idcarr");
    $post['idcarr']=$id;
    return $id;
}
function ActualizarCarr($post){
    $idcarr = $post['idcarr'];
    $carr = $post['carr'];
    $sentencia = "UPDATE cuerpo.carrera SET carr='$carr' WHERE idcarr=$idcarr";
    return Ejecuta($sentencia);
}

function EliminarCarr($post){
    $idcarr = $post['idcarr'];
    $sentencia = "DELETE FROM cuerpo.carrera WHERE idcarr=$idcarr";
    return Ejecuta($sentencia);
}
//////////////////////graficas///////////////////////////
function consultastatgraf()
{
    $query = "SELECT count(*) as res,B.stat
            from cuerpo.reportes A
                INNER JOIN cuerpo.stat B ON
                    (A.idsta = B.idsta)
                Group BY
                    B.stat";
    return Consulta($query);
}
function consultacarrgraf()
{
    $query = "SELECT count(*) as res,B.carr
    from cuerpo.reportes A
         INNER JOIN cuerpo.carrera B ON
            (A.idcarr = B.idcarr)
            Group BY
            B.carr";
    return Consulta($query);
}

function ConsultaCarreras()
{
    //$idcarr = $post['idcarr'];
    $query = "SELECT A.nocontrol,A.nombre,B.stat, C.carr
    FROM cuerpo.reportes A
        INNER JOIN cuerpo.stat B ON
            (A.idsta = B.idsta)
            inner join cuerpo.carrera C ON
            (A.idcarr = C.idcarr)
			where C.idcarr = 1";
    return Consulta($query);
}
///////////////////////Tipo de Ingreso ////////////////////////////////////////
function consultaIngre()
{
    $query = "SELECT idingr,ingreso FROM cuerpo.ingreso ORDER BY idingr";
    return Consulta($query);
}
function InsertarIngre(&$post){
    $idingr = $post['idingr'];
    $ingreso = $post['ingreso'];
    $sentencia = "INSERT INTO cuerpo.ingreso(ingreso) values('$ingreso') RETURNING idingr";
    $id = EjecutaConsecutivo($sentencia,"idingr");
    $post['idingr']=$id;
    return $id;
}
function ActualizarIngre($post){
    $idingr = $post['idingr'];
    $ingreso = $post['ingreso'];
    $sentencia = "UPDATE cuerpo.ingreso SET ingreso='$ingreso' WHERE idingr=$idingr";
    return Ejecuta($sentencia);
}

function EliminarIngre($post){
    $idingr = $post['idingr'];
    $sentencia = "DELETE FROM cuerpo.ingreso WHERE idingr=$idingr";
    return Ejecuta($sentencia);
}