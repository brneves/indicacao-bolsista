<?php

/**
 * Upload.class [ HELPER ]
 * Resposável por executar upload de imagens, arquivos e mídias no sistema
 * 
 * @copyright (c) 2014, Ronaldo Neves Invista Tecnologias
 */

namespace Evento\vendor;

use Evento\vendor\Helper;

class Upload {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD */
    private $Width;
    private $Image;

    /** RESULTSET */
    private $Resul;
    private $Erro;

    /** DIRETÓRIOS */
    private $Folder;
    private static $BaseDir;

    /**
     * Verifica e cria o diretório padrão de uploads no sistema!<br>
     * <b>../uploads/</b>
     */
    function __construct($BaseDir = null) {
        self::$BaseDir = ( (string) $BaseDir ? $BaseDir : plugin_dir_path(__FILE__) . '../../../uploads/' );
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    /**
     * <b>Enviar Imagem:</b> Basta envelopar um $_FILES de uma imagem e caso queira um nome e uma largura personalizada.
     * Caso não informe a largura será 1024!
     * @param FILES $Image = Enviar envelope de $_FILES (JPG ou PNG)
     * @param STRING $Name = Nome da imagems ( ou do artigo )
     * @param INT $Width = Largura da imagem ( 1024 padrão )
     * @param STRING $Folder = Pasta personalizada
     */
    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ( (int) $Width ? $Width : 1024 );
        $this->Folder = ( (int) $Folder ? $Folder : 'images' );

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
    }

    /**
     * <b>Enviar Arquivo:</b> Basta envelopar um $_FILES de um arquivo e caso queira um nome e um tamanho personalizado.
     * Caso não informe o tamanho será 2mb!
     * @param FILES $File = Enviar envelope de $_FILES (PDF,DOC, DOCX, XLS, XLSX)
     * @param STRING $Name = Nome do arquivo ( ou do artigo )
     * @param STRING $Folder = Pasta personalizada
     * @param STRING $MaxFileSize = Tamanho máximo do arquivo (2mb)
     */
    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ( (int) $Folder ? $Folder : null );
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 25 );

        $FileAccept = [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/pdf'
        ];

        if ($this->File['size'] > ($MaxFileSize * (2024 * 2024))):
            $this->Resul = false;
            $this->Erro = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif(!in_array($this->File['type'], $FileAccept)):
            $this->Resul = false;
            $this->Erro = "Tipo de arquivo não aceito. Envie .doc, .docx ou pdf";
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    /**
     * <b>Enviar Mídia:</b> Basta envelopar um $_FILES de uma mídia e caso queira um nome e um tamanho personalizado.
     * Caso não informe o tamanho será 40mb!
     * @param FILES $Media = Enviar envelope de $_FILES (MP3 ou MP4)
     * @param STRING $Name = Nome do arquivo ( ou do artigo )
     * @param STRING $Folder = Pasta personalizada
     * @param STRING $MaxFileSize = Tamanho máximo do arquivo (40mb)
     */
    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ( (int) $Folder ? $Folder : 'medias' );
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 40 );

        $FileAccept = [
            'audio/mp3',
            'video/mp4',
            'audio/mpeg'
        ];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Resul = false;
            $this->Erro = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif(!in_array($this->File['type'], $FileAccept)):
            $this->Resul = false;
            $this->Erro = "Tipo de arquivo não aceito. Envie áudio MP3 ou vídeo MP4";
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }
    
    /**
     * <b>Verificar Upload:</b> Executando um getResul é possível verificar se o Upload foi executado ou não. Retorna
     * uma string com o caminho e nome do arquivo ou FALSE.
     * @return STRING  = Caminho e Nome do arquivo ou False
     */
    function getResul() {
        return $this->Resul;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um code, um title, um erro e um tipo.
     * @return ARRAY $Erro = Array associatico com o erro
     */
    function getErro() {
        return $this->Erro;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    private function CheckFolder($Folder) {
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$y}");
        $this->CreateFolder("{$y}/{$m}/");
        $this->Send = "{$y}/{$m}/";
    }

    //Verifica e cria o diretório base!
    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    //Verifica e monta o nome dos arquivos tratando a string!
    private function setFileName() {
        $FileName = helper::Slug($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = helper::Slug($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    //Realiza o upload de imagens redimensionando a mesma!
    private function UploadImage() {

        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;

            case 'image/png':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;

        if (!$this->Image):
            $this->Resul = false;
            $this->Erro = "Tipo de arquivo inválido, envie imagens JPG ou PNG!";
        else:
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            $ImageX = ( $this->Width < $x ? $this->Width : $x );
            $ImageY = ($ImageX * $y) / $x;

            $NewImage = imagecreatetruecolor($ImageX, $ImageY);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageY, $x, $y);
                        
            switch ($this->File['type']):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name,100);
                    break;

                case 'image/png':
                case 'image/x-png':
                    imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name, 9);
                    break;
            endswitch;

            if (!$NewImage):
                $this->Resul = false;
                $this->Erro = "Tipo de arquivo inválido, envie imagens JPG ou PNG!";
            else:
                $this->Resul = $this->Send . $this->Name;
                $this->Erro = null;
            endif;

            imagedestroy($this->Image);
            imagedestroy($NewImage);

        endif;
    }

    //Envia arquivos e mídias
    private function MoveFile() {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Resul = $this->Send . $this->Name;
            $this->Erro = null;
        else:
            $this->Resul = false;
            $this->Erro = "Erro ao mover o arquivo!";
        endif;
    }
}
