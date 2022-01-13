<?php

namespace App\Http\Controllers\Backend;

require __DIR__ . "/../../../../app/Http/wideimage/WideImage.php";

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class gerarApp extends Controller {

    private $path_image = __DIR__ . "/../../../../public";
    private $path_app = __DIR__ . "/../../../../storage";
    private $path_app_render = __DIR__ . "/../../../../storage/aplicativo";
    private $path_tmp = __DIR__ . "/../../../../storage/temp";
    private $app_pathtmp;
    private $chave_file = "certificado_bundle.jks";
    private $chave_key = "EE4F5AD2D81078B62EBA6EA5E8";
    private $chave_password = "EE4F5AD2D81078B62EBA6EA5E8";
    private $chave_name = "chave";
    private $packege = "com.shoutcast.app.";
    private $app_hash;
    private $app_name;
    private $source;
    private $logo;
    private $background;
    private $icone;
    private $app_title;
    private $version;
    private $data;
    private $link_api = 'https://app-multistreaming.app.br/api/aplicativo';
    private $bundle = true;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $list = Config::where("user_id", Auth::user()->id)->first();
        if (!$list) {
            return redirect("/config")->with("message", "Antes de criar o aplicativo, você precisa configurar o aplicativo");
        }
        return view('backend.app', ['title' => "Gerar Aplicativo", "list" => $list]);
    }

    public function app_down() {
        $item = Config::where("user_id", Auth::user()->id)->first();
//         echo env("APP_URL").("/aplicativo/".$item->fileapp.".zip");  
        return response()->download(storage_path("aplicativo/" . $item->fileapp . ".zip"));
    }

    public function app_exec(Request $request) {
        $this->data = Config::where("user_id", Auth::user()->id)->first();
        if (!$this->data) {
            return redirect()->back()->with("message", "Configuração não encontrada");
        }
        if ($request->type == "apk") {
            $this->bundle = false;
        }

        $this->app_title = str_replace('-', ' ', $this->Name($this->data->title));
        $this->app_name = str_replace(['-', ' '], '', $this->Name($this->data->title));
        $this->source = "codigo1";
        $this->app_hash = $this->app_name . "_" . md5($this->data->title);
        $this->logo = $this->path_image . "/" . $this->data->logotipo;
        $this->icone = $this->path_image . "/" . $this->data->icone;
        $this->background = $this->path_image . "/" . $this->data->background;
        $this->version = $request->version;
        $this->app_pathtmp = $this->path_app_render . "/" . $this->app_hash;
        $this->packege .= $this->app_name;

        $this->initing();

        if (!file_exists($this->app_pathtmp) && is_dir($this->app_pathtmp)) {
            return redirect()->back()->with("message", "Falha ao iniciar a construção do aplicativo");
        }
        $this->imaging();
        $this->configing();

        if (!$this->creating()) {
            return redirect()->back()->with("message", "Falha ao tentar criar o aplicativo");
        } elseif (!$this->finishing()) {
            return redirect()->back()->with("message", "Aplicativo foi criado mas teve um problema ao finalizar. Tente novamente");
        } else {
            return redirect()->back()->with("message", "Aplicativo criado com sucesso");
        }
    }

    public function initing() {
        if (!file_exists($this->logo) && is_file($this->logo)) {
            return redirect()->back()->with("message", "Esta faltando a logotipo");
        }
        if (!file_exists($this->background) && is_file($this->background)) {
            return redirect()->back()->with("message", "Esta faltando a imagem de fundo (background)");
        }

        if (!file_exists($this->path_app_render)) {
            mkdir($this->path_app_render, 0777);
        }
        if (file_exists($this->app_pathtmp) && is_dir($this->app_pathtmp)) {
            $result = shell_exec("rm -rfv  '{$this->app_pathtmp}' 2>&1");
        }

        $result = shell_exec('cp -rfv ' . $this->path_app . '/' . $this->source . ' ' . $this->app_pathtmp . ' 2>&1');
    }

    public function imaging() {
        switch ($this->source):
            case "codigo1":

                $icone = \WideImage::load($this->logo)->resize(300, 300, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/bg_album_art.png');
                $logo = \WideImage::load($this->logo)->resize(250, 250, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/ic_launcher-web.png');
                \WideImage::load($this->logo)->resize(256, 256, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/defaultalbum.png');

                $logo2 = \WideImage::load($this->logo)->resize(600, 600, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxhdpi/logo_splash.png');
                $background = \WideImage::load($this->background)->crop('center', 'center', 640, 1136)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/bg_radio.jpg');

                $splash1 = \WideImage::load($this->background)->crop('center', 'center', 640, 1136)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/bg_splash.jpg');
                $header = \WideImage::load($this->background)->crop('center', 'center', 800, 472)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/bg_nav_drawer_header.jpg');
//                  //cria a splah para coloca na loja
                $splash = \WideImage::load($this->background)->crop('center', 'center', 640, 1136);
                $mescla1 = \WideImage::load($this->logo)->resize(300, 300, 'inside');
                $play_splash = $splash->merge($mescla1, 'center', 'center', 200);
                $play_splash->saveToFile($this->app_pathtmp . '/google_play/splash-app.png');
//                $play_splash->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/bg_splash.jpg');
//
//                    //cria a splah para coloca na loja
                $splash2 = \WideImage::load($this->app_pathtmp . '/google_play/app-modelo.png')->resize(638, 1293);
                $mescla12 = \WideImage::load($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/bg_splash.jpg')->resize(600, 1060);
//                $play_splash2 = $splash2->merge($mescla12, 'center', 'center', 100);
//                $play_splash2->saveToFile('../aplicativo/images/aplicativos/app-modelo-' . $this->app_hash . '.png');
//
//                   //cria a logo para coloca na loja
                $logo_app = \WideImage::load($this->logo)->resize(512, 512)->saveToFile($this->app_pathtmp . '/google_play/logo-app.png');
//
//                  //cria o destaque para coloca na loja
                $destaque = \WideImage::load($this->app_pathtmp . '/google_play/img-play-destaque.png');
                $play_destaque = $destaque->merge($mescla1, 'center', 'center', 100);
                $play_destaque->saveToFile($this->app_pathtmp . '/google_play/destaque-app.png');

                //cria a icone para coloca na loja
                $play_icone = \WideImage::load($this->logo)->resize(250, 250, 'fill')->saveToFile($this->app_pathtmp . '/google_play/icone-app.png');

//                   criar outras imagens para diferentes dispositivos
                $color = \WideImage::load($this->logo)->getTransparentColor();
                //hdpi
                \WideImage::load($this->icone)->resize(72, 72, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(162, 162, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(72, 72, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-hdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(162, 162, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-hdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(72, 72, 'fill')->roundCorners(20, $color, 4)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-hdpi/ic_launcher_round.png');
                //mdpi
                \WideImage::load($this->icone)->resize(48, 48, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-mdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(108, 108, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-mdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(48, 48, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-mdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(108, 108, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-mdpi/ic_launcher_foreground.png');
                //\WideImage::load($this->icone)->resize(48, 48, 'fill')->roundCorners(20, $color, 4)->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-mhdpi/ic_launcher_round.png');
                //xhdpi
                \WideImage::load($this->icone)->resize(96, 96, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xhdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(216, 216, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xhdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(96, 96, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-xhdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(216, 216, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-xhdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(96, 96, 'fill')->roundCorners(20, $color, 4)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xhdpi/ic_launcher_round.png');
                //xxhdpi
                \WideImage::load($this->icone)->resize(144, 144, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxhdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(324, 324, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxhdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(144, 144, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-xxhdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(324, 324, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-xxhdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(144, 144, 'fill')->roundCorners(20, $color, 4)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxhdpi/ic_launcher_round.png');
                //xxxhdpi
                \WideImage::load($this->icone)->resize(144, 144, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxxhdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(324, 324, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxxhdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(144, 144, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-xxxhdpi/ic_launcher.png');
                \WideImage::load($this->icone)->resize(324, 324, 'fill')->saveToFile($this->app_pathtmp . '/app/src/main/res/mipmap-xxxhdpi/ic_launcher_foreground.png');
                \WideImage::load($this->icone)->resize(144, 144, 'fill')->roundCorners(20, $color, 4)->saveToFile($this->app_pathtmp . '/app/src/main/res/drawable-xxxhdpi/ic_launcher_round.png');

                break;

        endswitch;
    }

    public function configing() {
        $this->replace($this->app_pathtmp . "/app/src/main/res/values/strings.xml", "#radio_nome#", $this->data->title);
        $this->replace($this->app_pathtmp . "/app/src/main/res/values/strings.xml", "#radio_email#", ($this->data->email ? $this->data->email : ''));
        $this->replace($this->app_pathtmp . "/app/src/main/res/values/colors.xml", "#radio_color1#", ( $this->data->color1 ? $this->data->color1 : "#252525"));
        $this->replace($this->app_pathtmp . "/app/src/main/res/values/colors.xml", "#radio_color2#", ( $this->data->color2 ? $this->data->color2 : "#1E88E5"));  


        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#link_stream#", $this->data->stream); //                              
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#link_api#", $this->link_api . "/" . $this->data->user_id); //                              
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#stream_email#", ($this->data->email ? $this->data->email : ''));
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#facebook#", ( $this->data->facebook ? $this->data->facebook : 'https://facebook.com'));
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#instagram#", ( $this->data->instagram ? $this->data->instagram : 'https://instagram.com'));
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#twitter#", ( $this->data->twitter ? $this->data->twitter : 'https://twitter.com'));
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#site#", ($this->data->site ? $this->data->site : 'https://google.com'));
        $this->replace($this->app_pathtmp . "/app/src/main/java/com/multistreaming/radiotv/Config.java", "#whatsapp#", ( $this->data->whatsapp ? $this->data->whatsapp : ''));

        $this->replace($this->app_pathtmp . "/app/build.gradle", "pacote_app", $this->packege);
        $this->replace($this->app_pathtmp . "/app/build.gradle", "versao_app1", str_replace(".", '', $this->version));
        $this->replace($this->app_pathtmp . "/app/build.gradle", "versao_app2", $this->version);
        $this->replace($this->app_pathtmp . "/app/build.gradle", "chave_file", $this->chave_file);
        $this->replace($this->app_pathtmp . "/app/build.gradle", "chave_alias", $this->chave_name);
        $this->replace($this->app_pathtmp . "/app/build.gradle", "chave_keypass", $this->chave_key);
        $this->replace($this->app_pathtmp . "/app/build.gradle", "chave_pass", $this->chave_password);
        //$this->replace($this->app_pathtmp . "/app/build.gradle", "#path_app#", LOCAL_HOME . '/' . $patch_app);
        $this->replace($this->app_pathtmp . "/{$this->source}.iml", $this->source, $this->app_hash);
        rename($this->app_pathtmp . "/{$this->source}.iml", $this->app_pathtmp . "/" . $this->app_hash . ".iml");
    }

    public function creating() {
        shell_exec("chmod -Rf 777 $this->app_pathtmp 2>&1");

        if ($this->bundle) {
            $resultado = shell_exec("cd {$this->app_pathtmp};./gradlew bundle 2>&1");
        } else {
            $resultado = shell_exec("cd {$this->app_pathtmp};./gradlew assembleRelease 2>&1");
        }
            
        if (preg_match('/BUILD SUCCESSFUL/i', $resultado)) {
            return true;
        }
        return false;
    }

    public function finishing() {
        shell_exec("cp -r " . $this->app_pathtmp . "/app/build/outputs/apk/release/app-release.apk " . $this->app_pathtmp . "/google_play/APP-" . $this->app_name . ".apk");
        shell_exec("cp -r " . $this->app_pathtmp . "/app/build/outputs/bundle/release/app.aab " . $this->app_pathtmp . "/google_play/APP-" . $this->app_name . ".aab");
        // Cria o zip com o conteudo para publicação no google play
        $zip = new \ZipArchive();
        if ($zip->open($this->app_pathtmp . ".zip", \ZIPARCHIVE::CREATE) !== TRUE) {
            shell_exec("cd {$this->app_pathtmp};/usr/bin/zip -1 " . $this->app_hash . ".zip " . $this->app_hash . ";/usr/bin/zip -1 " . $this->app_hash . ".zip " . $this->app_hash . "/google_play/*");
        }
        $zip->addEmptyDir($this->app_hash);
        $zip->addFile($this->app_pathtmp . "/google_play/APP-" . $this->app_name . ".apk", $this->app_hash . "/app-" . $this->app_name . ".apk");
        $zip->addFile($this->app_pathtmp . "/google_play/APP-" . $this->app_name . ".aab", $this->app_hash . "/app-" . $this->app_name . ".aab");
        $zip->addFile($this->app_pathtmp . "/google_play/icone-app.png", $this->app_hash . "/icone-app.png");
        $zip->addFile($this->app_pathtmp . "/google_play/logo-app.png", $this->app_hash . "/logo-app.png");
        $zip->addFile($this->app_pathtmp . "/google_play/splash-app.png", $this->app_hash . "/splash-app.png");
        $zip->addFile($this->app_pathtmp . "/google_play/destaque-app.png", $this->app_hash . "/destaque-app.png");
        $zip->addFile($this->app_pathtmp . "/google_play/banner-app.jpg", $this->app_hash . "/banner-app.jpg");
        $status = $zip->getStatusString();
        $zip->close();

        if (!file_exists($this->app_pathtmp . ".zip")) {
            shell_exec("cd {$this->app_pathtmp};/usr/bin/zip -1 " . $this->app_hash . ".zip " . $this->app_hash . ";/usr/bin/zip -1 " . $this->app_hash . ".zip " . $this->app_hash . "/google_play/*");
        }
        $post = \App\Models\Config::where("user_id", Auth::user()->id)->first();

        $post->version = $this->version;
        $post->fileapp = $this->app_hash;
        $post->build = 1;
        $post->save();
        shell_exec("rm -rfv  '{$this->app_pathtmp}' 2>&1");
        return true;
    }

    public function replace($arquivo, $string_atual, $string_nova) {

//$str = implode("\n",file($arquivo));
//$fp = fopen($arquivo,'w');
//$str = str_$this->replace($string_atual,$string_nova,$str);
//fwrite($fp,$str,strlen($str));

        $str = file_get_contents($arquivo);
        $str = str_replace($string_atual, $string_nova, $str);
        file_put_contents($arquivo, $str);
    }

    public function Name($Name) {
        $Format = array();
        $Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $Data = strtr(utf8_decode($Name), utf8_decode($Format['a']), $Format['b']);
        $Data = strip_tags(trim($Data));
        $Data = str_replace(' ', '-', $Data);
        $Data = str_replace(array('-----', '----', '---', '--'), '-', $Data);

        return strtolower(utf8_encode($Data));
    }

    public function remover_source_app($Dir) {

        if ($dd = @opendir($Dir)) {
            while (false !== ($Arq = @readdir($dd))) {
                if ($Arq != "." && $Arq != "..") {
                    $Path = "$Dir/$Arq";
                    if (is_dir($Path)) {
                        $this->remover_source_app($Path);
                    } elseif (is_file($Path)) {
                        @unlink($Path);
                    }
                }
            }
            @closedir($dd);
        }
        @rmdir($Dir);
    }

}
