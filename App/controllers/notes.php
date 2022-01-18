<?php

use \App\core\Controller;
use App\Auth;

// Controller Notes, indice 1 da url
class Notes extends Controller {

    // Entrando na URL notes irá mostrar este método, pois index é o método padrão para todos os controllers
    //public function index() {
        // Verificando se usuário permissão p/ acessar páginas restristas
        //Auth::checkLogin();
        
        // echo 'Index do controller Notes';
        //$this->excluir();

        //header('Location: /home/index');
    //}

    // Método ver, indice 2 da url
    public function ver($id = '') {

        // Resultado do select no BD
        $note = $this->model('Note'); // instanciando método model que está em core/Controller.php
        $dados = $note->findId($id);

        // Chamando view
        // 1-nome da views, 2-array(preenchido pela consulta SELECT)
        $this->views('notes/ver', $dados);
    }

    // Método para criar novos bloco de notas e salvar no BD
    // Método criar, indice 2 da url
    public function criar() {
        
        // Verificando se usuário permissão p/ acessar páginas restristas
        Auth::checkLogin();

        // Mensagem de sucesso e erro
        $mensagem = array();

        // Pegando os valores do form de criação do bloco de anotações
        if( isset($_POST['cadastrar']) ):

            // Verificando se os campos estão em branco(vazio)
            if( empty($_POST['titulo']) ):

                $mensagem[] = 'O campo titulo deve ser preenchido';

            elseif( empty($_POST['texto']) ):

                $mensagem[] = 'O campo texto deve ser preenchido';

            else: // se os campos estiverem preenchidos irá executar os códigos abaixo

                // UPLOAD DE ARQUIVOS (Composer)
                $storage = new \Upload\Storage\FileSystem('images/uploads'); // Diretório onde os arquivos serão salvos
                $file = new \Upload\File('foo', $storage); // O arquivo que está vindo do formulário

                // Optionally you can rename the file on upload
                $new_filename = uniqid(); // Gerando ID e atribundo novo nome ao arquivo
                $file->setName($new_filename);

                // Validate file upload
                // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
                $file->addValidations(array(
                    // Ensure file is of type "image/png"
                    new \Upload\Validation\Mimetype('image/png'),

                    //You can also add multi mimetype validation
                    //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                    new \Upload\Validation\Size('5M')
                ));

                // Access data about the file that has been uploaded
                $data = array(
                    'name' => $file->getNameWithExtension(),
                    'extension' => $file->getExtension(),
                    'mime' => $file->getMimetype(),
                    'size' => $file->getSize(),
                    'md5' => $file->getMd5(),
                    'dimensions' => $file->getDimensions()
                );

                // Try to upload file
                try {
                    // Success!
                    $file->upload();
                    $mensagem[] = 'Upload feito com sucesso!';
                } catch (\Exception $e) {
                    // Fail!
                    $errors = $file->getErrors();
                    // implode() - converter array para string
                    $mensagem[] = implode('<br>', $errors);
                }

                $note = $this->model('Note'); // instanciando método model que está em core/Controller.php
                // atribundo $_POST aos atributos que estão em models/Note.php
                $note->titulo = $_POST['titulo'];
                $note->texto = $_POST['texto'];
                
                // Mensagem de sucesso e erro
                $mensagem[] = $note->saveCriar();

            endif;

        endif;

        // Chamando view
        // 1-nome da views, 2-array(preenchido pela consulta SELECT)
        $this->views('notes/criar', $dados = ['mensagem' => $mensagem]);
    }

    public function editar($id) {

        // Verificando se usuário permissão p/ acessar páginas restristas
        Auth::checkLogin();

        $mensagem = array();

        $note = $this->model('Note'); // instanciando método model que está em core/Controller.php

        if( isset($_POST['atualizar'])):
            
            // atribundo $_POST aos atributos que estão em models/Note.php
            $note->titulo = $_POST['titulo'];
            $note->texto = $_POST['texto'];

            // Mensagem de sucesso e erro
            $mensagem[] = $note->update($id);

        endif;

        //pegar os dados e preencher os campos da view
        $dados = $note->findId($id);
        
        // Chamando view
        // 1-nome da views, 2-array(preenchido pela consulta SELECT)
        $this->views('notes/editar', $dados = ['mensagem' => $mensagem, 'registros' => $dados]);
    }

    public function excluir($id = '') {

        // Verificando se usuário permissão p/ acessar páginas restristas
        Auth::checkLogin();

        $mensagem = array();

        $note = $this->model('Note');

        $mensagem[] = $note->delete($id);

        $dados = $note->getAll();

        // Chamando view
        // 1-nome da views, 2-array(preenchido pela consulta SELECT)
        $this->views('home/index', $dados = ['registros' => $dados, 'mensagem' => $mensagem]);

    } 

}