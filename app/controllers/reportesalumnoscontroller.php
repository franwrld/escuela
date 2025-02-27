<?php

include_once "app/models/alumnos.php";
include_once "vendor/autoload.php";

class ReportesAlumnosController extends Controller {
    private $alumno;
    public function __construct($parametro) {
        $this->alumno = new Alumnos();
        parent::__construct("reportesalumnos", $parametro, true);
    }

    public function getReporte() {
        // Obtener los registros de alumnos
        $registros = $this->alumno->getAlumnosReporte($_GET);

        // Encabezado del informe
        $htmlHeader = '
        <div style="text-align: center;">
            <h3 style="margin: 5px 0 0; font-size: 15px; font-family: Roboto; display: inline-block; vertical-align: middle;">Reporte de Alumnos</h3>
            <img src="/xampp/htdocs/escuela/public_html/iconos/logoescuela200px.png" style="width:100px; display: inline-block; vertical-align: right;">
            <h3 style="margin: 5px 0 0; font-size: 15px; text-align: left; font-family: Roboto; margin-top:45px">Listado de Alumnos</h3>
        </div>';

        // Cuerpo del informe
        $html = "<table width='100%' style='border-collapse: collapse;'><thead><tr>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color:rgb(113, 184, 255);'>ID Alumno</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Nombre Completo</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Género</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Escuela</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Grado</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Nombre del Padre</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Parentesco</th>";
        $html .= "<th style='padding: 10px; border: 1px solid #999; text-align: center; background-color: rgb(113, 184, 255);'>Teléfono del Padre</th>";
        $html .= "</tr></thead><tbody>";

        foreach ($registros as $value) {
            $html .= "<tr>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["id_alumno"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["nombre_completo"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["genero"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["nombre_escuela"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["grado"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["nombre_padre"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["parentesco"]}</td>";
            $html .= "<td style='padding: 10px; border: 1px solid #999; text-align: center;'>{$value["telefono_padre"]}</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";

        // Configuración de mPDF
        $mpdfConfig = array(
            'mode' => 'utf-8',
            'format' => 'Letter',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 40,
            'margin_header' => 10,
            'margin_footer' => 20,
            'orientation' => 'P'
        );
        $mpdf = new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->WriteHtml($html);
        $mpdf->Output();
    }
}