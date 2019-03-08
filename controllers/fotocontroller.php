<?PHP
class FotoController extends Controller
{
    function __construct(){
        parent::__construct();
    }

    public function ListaFotos()
    {
        $datos = $_REQUEST['datos'];
        $datos = json_decode($datos, true);
        $fotos = $this->model->ListaFotos($datos["idsiniestro"], $datos["tipo"]);
        echo json_encode($fotos);
    }

    public function Subir()
    {
        $img            = $_FILES["files"]["name"][0];
        $tmp            = $_FILES["files"]["tmp_name"][0];
        $errorimg       = $_FILES["files"]["error"][0];
        $idsiniestro    = $_REQUEST['idsiniestro'];
        $idtipofoto     = $_REQUEST['idtipofoto'];
        $comentario     = $_REQUEST['txt_comentario'];
        $path           = "";

        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $final_image = $img;
        
        $path = 'views/uploads/'.$idsiniestro;

        switch($idtipofoto){
            case 1:
                $path .= "/FOTOS/".strtolower($final_image);
                break;
            case 2:
                $path .= "/REPUESTOS/".strtolower($final_image);
                break;
            case 3:
                $path .= "/PRESUPUESTOS/".strtolower($final_image);
                break;
            case 4:
                $path .= "/CARTAS_DE_APROBACION/".strtolower($final_image);
                break;
            case 5:
                $path .= "/DOCUMENTOS_GENERALES/".strtolower($final_image);
                break;
			case 6:
                $path .= "/ETALLER/".strtolower($final_image);
                break;
            case 7:
                $path .= "/FOTOS/REPUESTOS/".strtolower($final_image);
                break;
            case 8:
                $path .= "/FOTOS/SINIESTRO/".strtolower($final_image);
                break;
            case 9:
                $path .= "/FOTOS/INSPECCION/".strtolower($final_image);
                break;
            case 10:
                $path .= "/REPUESTOS/NOTAS_CREDITO/".strtolower($final_image);
                break;
            case 11:
                $path .= "/REPUESTOS/GUIAS_REMISION/".strtolower($final_image);
                break;
            case 12:
                $path .= "/INVENTARIOS/".strtolower($final_image);
                break;
            case 13:
                $path .= "/FRANQUICIAS/".strtolower($final_image);
                break;
            case 14:
                $path .= "/REPUESTOS/PROVEEDORES/".strtolower($final_image);
                break;
            case 15:
                $path .= "/OTROS_DOCUMENTOS/".strtolower($final_image);
                break;
        }

        if(move_uploaded_file($tmp,$path)) 
        {
            $placas = $this->model->InsertaFoto($idtipofoto, $idsiniestro, $path, $comentario);
            echo json_encode($idsiniestro);
            
        }
    }

    public function EliminaFoto()
    {
        $datos = $_REQUEST['datos'];
        $datos = json_decode($datos, true);
        $fotos = $this->model->EliminaFoto($datos["idfoto"]);
        echo json_encode($fotos);
        
    }
}
?>