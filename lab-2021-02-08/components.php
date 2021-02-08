<?php
namespace Components;

abstract class Component {
    abstract public function render($context);
}

class EchoComponent extends Component {
    public function render($context) {
        return <<<HTML
        <p class="font-weight-bold">{$context['text']}</p>
HTML;
    }
}

class BootstrapPage extends Component {
    private $comp;
    public function render($context) {
        $this->comp = new EchoComponent();
        return <<<HTML
        <html>
            <head>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            </head>
            <body>
               {$this->comp->render(['text'=>'Hello, World!'])}
               <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
            </body>
        </html>
HTML;
    }
}
