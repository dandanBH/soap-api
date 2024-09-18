<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class XmlController extends AbstractController
{
    #[Route('/xml/process', name: 'process_xml')]
    public function processXml(): Response
    {
        // Caminho para o arquivo XML
        $filePath = $this->getParameter('kernel.project_dir') . '/public/xml/XML CDA 20950334375033.xml';

        if (!file_exists($filePath)) {
            return new Response('Arquivo XML não encontrado.');
        }

        // Carregar o XML
        $xml = simplexml_load_file($filePath);

        if ($xml === false) {
            return new Response('Erro ao carregar o arquivo XML.');
        }

        // Exibir os dados do XML


     

        $output = '<h2>Informações do CDA</h2>';
        $output .= '<p>Tipo de evento: ' . $xml->MessageBody->CDA->tpevento . '</p>';
        $output .= '<p>Identificador do CDA: ' . $xml->MessageBody->CDA->idcda . '</p>';
        $output .= '<p>Contribuinte: ' . $xml->MessageBody->CDA->contribuinte->nome . '</p>';
        $output .= '<p>CPF/CNPJ: ' . $xml->MessageBody->CDA->contribuinte->cpf_cnpj . '</p>';
        $output .= '<p>Endereço: ' . $xml->MessageBody->CDA->contribuinte->endereco . '</p>';
        $output .= '<p>Endereço Correspondencia: ' . $xml->MessageBody->CDA->contribuinte->endereco_correspondencia . '</p>';
        $output .= '<p>BM / Gerente: ' . $xml->MessageBody->CDA->gerente_bm. ' - '. $xml->MessageBody->CDA->gerente_nome .'</p>';

        // Processar mais dados conforme necessário
        return new Response($output);
    }
}
