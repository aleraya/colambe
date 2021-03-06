<?php

namespace App;

use AltoRouter;
use App\Security\ForbiddenException;
use Exception;

class Router {
    
    /**
     * @var string
     */
    private $viewPath;
        
    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name=null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, ?string $name=null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }

    public function match(string $url, string $view, ?string $name=null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }

        
    /**
     * url
     *
     * @param  mixed $name    nom de la root
     * @param  mixed $params  les paramètres
     * @return void
     */
    public function url(string $name, array $params=[]) 
    {
        return $this->router->generate($name, $params);
    }

    public function run(): self
    {
        // Demande au router si l'url saisie correspond à une des routes
        // Renvoit tableau associatif comportant les correspondances
        $match = $this->router->match();

        try {
            // Récupération de la cible le template, la closure, la fonction require et appelle de la fonction par les ()
            $view = $match['target'];
            // Récupération des paramètres
            $params = $match['params'];
        } catch (Exception $e) {
            $view = 'e404';
        }

        $router = $this;

        $isAdmin = strpos($view, 'admin/') !==false;
        $layout = $isAdmin ? 'admin/layouts/default' : 'layouts/default';

        try {
            ob_start();
            require $this->viewPath .DIRECTORY_SEPARATOR. $view . '.php';
            $content = ob_get_clean();
            require $this->viewPath . DIRECTORY_SEPARATOR . $layout . '.php';
        } catch (ForbiddenException $e) {
            header("Location:" . $router->url('login'). '?forbidden=1');
            exit();
        }

        return $this;
    }
}