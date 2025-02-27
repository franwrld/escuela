<?php

include_once "app/models/escuelas.php";
include_once "vendor/autoload.php";

class ReportesEscuelasController extends Controller {
    private $escuela;
    public function __construct($parametro) {
        $this->escuela = new Escuelas();
        parent::__construct("reportesescuelas",$parametro,true);
    }

    public function getReporte() {
        $registros=$this->escuela->getEscuelasReporte($_GET);

        //print_r($registros);
        //Encabezado informe
        //Encabezado informe
        $htmlHeader = '<div style="text-align: center;">
        <h3 style="margin: 5px 0 0; font-size: 15px;  font-family: Roboto; display: inline-block; vertical-align: middle;">Escuelas MyControlGPS</h3>
        <img src="/xampp/htdocs/escuela/public_html/iconos/logoescuela200px.png" style="width:100px; display: inline-block; vertical-align: right;">
        <h3 style="margin: 5px 0 0; font-size: 15px;text-align: left;font-family: Roboto; margin-top:45px">Listado de Escuelas</h3>
        </div>';
        //Informacion 
        //Cuerpo informe
        $html="<table widht='100%' border-collapse: collapse; ><thead><tr>";
        $html.="<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: #e3e4e5;'>ID</th>";
        $html.="<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: #e3e4e5;'>Nombre</th>";
        $html.="<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: #e3e4e5;'>Dirección</th>";
        $html.="<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: #e3e4e5;'>Email</th>";
        $html.="<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: #e3e4e5;'>Usuario</th>";
        $html.="<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: #e3e4e5;'>Cantidad Alumnos</th>";

        $html.="</tr></thead><tbody>";
        $total=0;
        foreach($registros as $key => $value){
            $html.="<tr>";
            //$html.="<td>".($key+1)."</td>";
            $html.="<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["id_school"]}</td>";
            $html.="<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["nombre_escuela"]}</td>";
            $html.="<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["direccion"]}</td>";
            $html.="<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["email"]}</td>";
            $html.="<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["nombre_usuario"]}</td>";
            $html.="<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["total_alumnos"]}</td>";
            $html.="</tr>";
        
    }
    $html.="</tbody></table>";
        //echo $html;
        $mpdfConfig=array(
            'mode'=>'utf-8',
            'format'=>'Letter',
            'default_font_size'=>0,
            'default_font'=>'',
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>40,
            'margin_header'=>10,
            'margin_footer'=>20,
            'orientation'=>'P'
        );
        $mpdf=new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->WriteHtml($html);
        $mpdf->Output();
    }
}