<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller {

    private $id; 

    public function index($id, $action = "get_MenuApp") {

        date_default_timezone_set("America/Sao_paulo");
        $this->id = $id; 
        $result = $this->$action();
        return response()->json($result);
    }

    public function get_MenuApp() {
        $data = \App\Models\Config::where("user_id", $this->id)->first();
        $datamenu = \App\Models\Menu::where("user_id", $this->id)->first();
         
            if(filter_var($data->whatsapp, FILTER_VALIDATE_URL)):
                $whatsapp = $data->whatsapp;
           
            else: 
                 
                 if(strripos($data->whatsapp, "55")===0):
                      $whats = $data->whatsapp;
              
                 else:
                     $whats = "55".$data->whatsapp; 
                 endif;
                 $whatsapp = "https://wa.me/{$whats}&text=Quero pedir uma música";
            endif;
           
        $data['status'] = 1;
        return [["id" => $data->id,
        "tv_link" => $data['webtv'],
        "tv_status" => ($datamenu['webtv'] == 1 ? "true" : 'false'),
        "status_radio" => ($datamenu['radio'] == 1 ? "true" : 'false'),
        "whatsapp_link" => $whatsapp,
        "whatsapp_status" => ($datamenu['whatsapp'] == 1 ? "true" : 'false'),
        "site_link" => $data->site,
        "site_status" => ($datamenu['site'] == 1 ? "true" : 'false'),
        "facebook_link" => $data->facebook,
        "facebook_status" => ($datamenu['facebook'] == 1 ? "true" : 'false'),
        "twitter_link" => $data->twitter,
        "twitter_status" => ($datamenu['twitter'] == 1 ? "true" : 'false'),
        "instagram_link" => $data->instagram,
        "instagram_status" => ($datamenu['instagram'] == 1 ? "true" : 'false'),
        "programacao_status" => ($datamenu['programation'] == 1 ? "true" : 'false'),
        "promocao_status" => ($datamenu['promotion'] == 1 ? "true" : 'false'),
        "noticias_status" => ($datamenu['notice'] == 1 ? "true" : 'false'),
        "equipe_status" => ($datamenu['team'] == 1 ? "true" : 'false'),
        "recados_status" => ($datamenu['mural'] == 1 ? "true" : 'false'),
        ]];
    }

    public function get_programacao() {
        $data = \App\Models\Programation::where("user_id", $this->id)->paginate(500);
        $retorno = [];

        if (count($data)):
            $LISTA = [];
            foreach ($data as $item):
                $cover = url($item->cover);

                $RIGHT = '<br><span style="display:inline-block; border:none; ">';
                $RIGHT .= 'INICIA ÀS ' . $item->timestart . ' - ';
                $RIGHT .= 'ATÉ ' . $item->timeend . '';
                $RIGHT .= '</span>';

                if (empty($LISTA[$item->day_programe])):
                    $LISTA[$item->day_programe] = '<li style="position:relative; list-style:none; min-height:100px;border-bottom:1px solid #CCC; "><img src="' . $cover . '" style="height:70px; float:left; padding:10px ">' . $item->title . '<br>' . $item->description . $RIGHT . '</li>';
                else:
                    $LISTA[$item->day_programe] .= '<li style="position:relative;list-style:none;min-height:100px;border-bottom:1px solid #CCC;  "><img src="' . $cover . '" style="height:70px; float:left; padding:10px"> ' . $item->title . '<br>' . $item->description . $RIGHT . '</li>';
                endif;


            endforeach;
        endif;

        $dias = [
            '1' => "Segunda-Feira",
            '2' => "Terça-Feira",
            '3' => "Quarta-Feira",
            '4' => "Quinta-Feira",
            '5' => "Sexta-Feira",
            '6' => "Sábado",
            '7' => "Domingo",
        ];
        $count = 1;
        foreach ($dias as $valor => $dia):
            $descricao = '';
            if (!empty($LISTA[$dia])):
                $descricao = $LISTA[$dia];
            endif;
            $retorno[] = [
                "id" => $count,
                "dia" => $dia,
                "descricao" => $descricao,
            ];

            $count++;
        endforeach;

        return $retorno;
    }

    public function get_programacao_atual() {
        $data = \App\Models\Programation::where("user_id", $this->id)->paginate(500);
        $retorno = [];
        if (count($data)):
            foreach ($data as $item):

                $cover = url($item->cover);
                $retorno[] = ['id' => $item->id,
                    'dia' => $item->day_programe,
                    'programa' => $item->title,
                    'descricao' => $item->description,
                    'img_agenda' => $cover,
                    'inicio' => $item->timestart,
                    'fim' => $item->timeend,
                    'user_id' => $this->id,
                    'status' => $item->status];

            endforeach;
        endif;

        return $retorno;
    }

    public function get_noticias() {
        $data = \App\Models\Posts::where("user_id", $this->id)->paginate(500);
        $retorno = [];
        if (count($data)):
            foreach ($data as $item):

                $cover = url($item->cover);
                $retorno[] = ['id' => $item->id,
                    'titulo' => $item->title,
                    'descricao' => $item->description,
                    'imagem' => $cover,
                    'data' => $item->created_at,
                    'user_id' => $this->id,
                    'status' => $item->status];

            endforeach;
        endif;

        return $retorno;
    }

    public function get_equipe() {
        $data = \App\Models\Teams::where("user_id", $this->id)->paginate(500);
        $retorno = [];
        if (count($data)):
            foreach ($data as $item):

                $cover = url($item->cover);
                $retorno[] = ['id' => $item->id,
                    'nome' => $item->name,
                    'descricao' => $item->description,
                    'programa' => $item->programa,
                    'img_equipe' => $cover,
                    'user_id' => $this->id,
                    'status' => $item->status,
                    'facebook' => $item->facebook,
                    'whatsapp' => $item->whatsapp,
                    'instagram' => $item->instagram,
                ];


            endforeach;
        endif;
        return $retorno;
    }

    public function get_promocoes() {
        $data = \App\Models\Promotion::where("user_id", $this->id)->paginate(500);
        $retorno = [];
        if (count($data)):
            foreach ($data as $item):

                $cover = url($item->cover);
                $retorno[] = ['id' => $item->id,
                    'titulo' => $item->title,
                    'descricao' => $item->description,
                    'imagem' => $cover,
                    'data' => $item->data,
                    'user_id' => $this->id,
                    'status' => $item->status,
                ];


            endforeach;
        endif;
        return $retorno;
    }

    public function get_mural() {
        $data = \App\Models\Message::where("user_id", $this->id)->where("type","recado")->paginate(500);
        $retorno = [];
        if (count($data)):
            foreach ($data as $item):

                $cover = url($item->cover);
                $retorno[] = ['id' => $item->id,
                    'nome' => $item->title,
                    'mensagem' => $item->description, 
                    'user_id' => $item->id,
                    'status' => $item->status,
                ];


            endforeach;
        endif;
        return $retorno;
    }

    public function set_mural(Request $request) {
        
    }

    public function get_config() {
        
        $data = \App\Models\Config::where("user_id", $this->id)->first();
         $datamenu = \App\Models\Menu::where("user_id", $this->id)->first();
        $radio_logo = url($data->logotipo);
        $radio_bg = url($data->background);

        $retorno['result'][] = [
            'id' => $data->id,
            "status_radio" => ($datamenu['radio'] == 1 ? "true" : 'false'),
            'capa_background' => true,
            'radio_name' => $data->title,
            'radio_image' => $radio_logo,
            'radio_bg' => $radio_bg,
            'radio_bg_status' => "true",
            'radio_title' => false,
            'radio_url' => $data->stream
        ];

        return $retorno;
    }

}

//@APP_sdk_0990