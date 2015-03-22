<?php

namespace Mpwarfwk\Component\Response;

class JsonResponse extends Response
{
    public function send()
    {
        if ($this->status != 200)
        {
            // Add needed header. For example 404.
            header("HTTP/1.0 404 Not Found");
        }

        header('Content-Type: application/json');

        if (!is_array($this->content))
        {
            $this->content = array($this->content);
        }

        echo json_encode($this->content);
    }
}
