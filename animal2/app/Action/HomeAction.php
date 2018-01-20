<?php
/**
 * Created by PhpStorm.
 * User: Mateus
 * Date: 17/01/2018
 * Time: 17:08
 */

namespace app\Action;


final class  HomeAction extends Action
{

    public function index($request,$response)
    {
        $vars['page'] = 'list';
        $vars['title'] ='Listar';


        $posts = $this->db->prepare("SELECT id,nome,raca,peso FROM animais ORDER BY 'id'DESC ");
        $posts->execute();

        if ($posts ->rowCount() >0){
            $vars['posts'] = $posts->fetchAll(\PDO::FETCH_OBJ);
        }

        return $this->view->render($response,'template.phtml',$vars);


    }




    public function visualiza($request,$response)
    {
        $id =$request->getAttribute('id');

        if(! is_numeric($id)){

            return $response->withRedirect(PATH.'/');

            echo 'erro1';
        }

        $post = $this->db->prepare("SELECT id,nome,raca,peso FROM animais WHERE id = ?");
        $post->execute(array($id));

        if($post->rowCount()==0){

            return $response->withRedirect(PATH.'/');

            echo 'erro2';
        }

        $vars['title'] ='edi';
        $vars['page'] = 'visualizar';
        $vars['post'] = $post->fetch(\PDO::FETCH_OBJ);

        return $this->view->render($response,'template.phtml',$vars);


    }

    public function add($request,$response)
    {
    $vars['title'] ='Novo Post';
    $vars['page'] = 'add';


    return $this->view->render($response,'template.phtml',$vars);


    }

    public function store($request,$response)
    {
        $data = $request->getParsedBody();

            $nome  = filter_var($data['nome'],FILTER_SANITIZE_STRING);
            $raca   = filter_var($data['raca'],FILTER_SANITIZE_STRING);
            $peso = filter_var($data['peso'],FILTER_SANITIZE_STRING);

        if ($nome !=""&& $raca != "" && $peso !=""){

            $cadastrar = $this->db->prepare("INSERT INTO animais(nome,raca,peso) VALUE  (?, ?,?)");

            $cadastrar->execute(array($nome,$raca,$peso));

            return $response->withRedirect(PATH.'/');


        }


            $vars['title'] ='Novo Post';
            $vars['page'] = 'add';
            $vars['error'] = 'Preencha todos os campos';

            return $this->view->render($response,'template.phtml',$vars);








    }

    public function edit($request,$response)
    {
        $id =$request->getAttribute('id');

       if(! is_numeric($id)){

            return $response->withRedirect(PATH.'/');

            echo 'erro1';
        }

        $post = $this->db->prepare("SELECT id,nome,raca,peso FROM animais WHERE id = ?");
        $post->execute(array($id));

      if($post->rowCount()==0){

            return $response->withRedirect(PATH.'/');

           echo 'erro2';
        }

        $vars['title'] ='edi';
        $vars['page'] = 'edit';
        $vars['post'] = $post->fetch(\PDO::FETCH_OBJ);

        return $this->view->render($response,'template.phtml',$vars);


    }


    public function update ($request,$response){

        $id =$request->getAttribute('id');

        if(! is_numeric($id)){

            return $response->withRedirect(PATH.'/');

            echo 'erro1';
        }

        $post = $this->db->prepare("SELECT id,nome,raca,peso FROM animais WHERE id = ?");
        $post->execute(array($id));


        $data = $request->getParsedBody();

        $nome  = filter_var($data['nome'],FILTER_SANITIZE_STRING);
        $raca   = filter_var($data['raca'],FILTER_SANITIZE_STRING);
        $peso = filter_var($data['peso'],FILTER_SANITIZE_STRING);

        if ($nome !=""&& $raca != "" && $peso !=""){

            $cadastrar = $this->db->prepare("UPDATE animais SET nome=?,raca=?,peso=? WHERE id = ? ");

            $cadastrar->execute(array($nome,$raca,$peso,$id));

            return $response->withRedirect(PATH.'/');


        }


        $vars['title'] ='edi';
        $vars['page'] = 'edit';
        $vars['post'] = $post->fetch(\PDO::FETCH_OBJ);
        $vars['error'] = 'Preencha todos os campos';

        return $this->view->render($response,'template.phtml',$vars);




    }


    public function del($request,$response)
    {
        $id =$request->getAttribute('id');

        if(! is_numeric($id)){
            return $response->withRedirect(PATH.'/');
            echo 'erro1';
        }

        $post = $this->db->prepare("SELECT id,nome,raca,peso FROM animais WHERE id = ?");
        $post->execute(array($id));

        if($post->rowCount()==0){
            return $response->withRedirect(PATH.'/');
        }

        $deletar = $this->db->prepare("DELETE FROM animais WHERE id = ?");

        $deletar->execute(array($id));

        return $response->withRedirect(PATH.'/');

    }




}