<?php
// Created By Mazterin.Com
// Change Copyright = NOOB!
// NOT COMPATIBLE WITH PHP CMD!
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
class MztrProxy{
    var $fname, $check;
    public function banner(){
       $banner = $this->color("cyan", "
 ____  ____       _____  _____ _____ _____ _____
|  _ \|  _ \  X  / _ \ \/ /_ _| ____| ____|__  /
| |_) | |_) | X | | | \  / | ||  _| |  _|   / / 
|  __/|  _ <  X | |_| /  \ | || |___| |___ / /_ 
|_|   |_| \_\ X  \___/_/\_\___|_____|_____/____|
                          ".$this->color("hijau", "By : Mazterin.Com").
                                            "\n");
        return $banner;
    }
    public function CheckOS(){
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            echo $this->color("merah", "[!] Not Compatible for PHP CMD!, Try to install cygwin64 for windows User!");
        } else {
            echo exec("clear");
        }
    }
    public function Check($proxy){
        if(!empty($proxy)) {
            $url = "https://pastebin.com/raw/X52Fp8Ht";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4); 
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($response == "0") {
                return "DIE";
            }elseif($response == "200" && preg_match("/PROXY LIVE/i", $data)){
                return "LIVE";
            }else{
                return "DIE";
            }
            curl_close($ch);
        }
    }
    public function curl($url, $header = 0, $httpheader = 0, $cookieStr = 0, $cookieFile = 0, $uagent = 0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if($httpheader){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		if($cookieStr){
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
		if($cookieFile){
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
		}
		if($header){
			curl_setopt($ch, CURLOPT_HEADER, $header);
		}
		if($uagent){
			curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
		}else{
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0");
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		return curl_exec($ch);
		curl_close($ch);
	}
	public function Dupli($get){
	    preg_match('#<textarea class="form-control" rows="3" name="domain" style="width: 100%; height:200px;">(.*?)</textarea>#si', $get, $avail);
	    return $avail[1];
	}
	public function UsFree($get){
	    preg_match("/<tbody>(.*?)<\/tbody>/", $get, $res);
        preg_match_all("/<tr>(.*?)<\/tr>/", $res[1], $match);
        shuffle($match[1]);
        foreach($match[1] as $data){
            $d = str_replace(array("<td>", "<td class='hm'>"), "", $data);
            $ip = explode("</td>",$d);
            $ipport.= $ip[0].":".$ip[1]."\n";
        }
        return($ipport);
	}
    public function getProxies(){
        $content = array($this->curl("https://free-proxy-list.net/"), $this->curl("https://free-proxy-list.net/"));
        // $this->fname = "Proxies-List_".date("d-m-Y").".txt";
        sleep(1); echo $this->color("kuning","[#] Getting Proxies >"); sleep(1); echo ">"; sleep(1); echo ">"; sleep(1); echo ">\n";
        $dupli = $this->Dupli($this->curl("https://www.duplichecker.com/free-proxy-list.php"));
        foreach($content as $contents){
            $this->Save($this->fname, $this->UsFree($contents."\n"));
        }
        $this->Save($this->fname, $dupli);
        echo $this->color("hijau","[#] Success to getting proxiess!\n").$this->color("cyan", "[#] Saved in ".getcwd()."/".$this->fname."\n");
    }
    public function Form(){
        echo $this->banner();
        echo $this->color("kuning", "[#] GET / CHECK / GET & CHECK ? [G/C/GC] : "); $opt = trim(fgets(STDIN));
        switch($opt){
            case 'G':
                case 'GET':
                    echo $this->getProxies();
                    sleep(1); echo $this->color("merah","[#] Exiting >"); sleep(1); echo ">"; sleep(1); echo ">"; sleep(1); echo ">\n";
                    exit();
                    break;
            case 'GC':
                $this->getProxies()."\n";
                sleep(1); echo $this->color("kuning","[#] Reading File >"); sleep(1); echo ">"; sleep(1); echo ">"; sleep(1); echo ">\n";
                if(is_file($this->fname) && file_exists($this->fname)){
                    echo $this->Cek($this->fname);
                    sleep(1); echo $this->color("merah","[#] Exiting >"); sleep(1); echo ">"; sleep(1); echo ">"; sleep(1); echo ">\n";
                    exit();
                }else{
                    echo $this->color("merah", "[!] NOT FILE / FILE NOT FOUND.\n");
                    exit();
                } 
                break;
            case 'C':
                case 'CHECK':
                    echo $this->color("kuning", "[#] FILE : "); $file = trim(fgets(STDIN));
                    sleep(1); echo $this->color("kuning","[#] Reading File >"); sleep(1); echo ">"; sleep(1); echo ">"; sleep(1); echo ">\n";
                    if(is_file($file) && file_exists($file)){
                        echo $this->Cek($file);
                        sleep(1); echo $this->color("merah","[#] Exiting >"); sleep(1); echo ">"; sleep(1); echo ">"; sleep(1); echo ">\n";
                        exit();
                    }else{
                        echo $this->color("merah", "[!] NOT FILE / FILE NOT FOUND.\n");
                        exit();
                    }
                    break;
            default:
                echo $this->color("merah", "[!] Invalid Option.\n");
                exit();
        }
    }
    public function Save($title, $text){
        $fopen = fopen($title, "a");
        fwrite($fopen, $text);
        fclose($fopen);
    }
    public function color($opt = 'cyan', $text){
		$green  = "\e[1;92m";
		$cyan   = "\e[1;36m";
		$normal = "\e[0m";
		$blue   = "\e[34m";
		$yellow = "\e[93m";
		$red    = "\e[1;91m";
		switch($opt){
			case 'merah':
				return $red.$text.$normal;
				break;
			case 'hijau':
				return $green.$text.$normal;
				break;
			case 'biru':
				return $blue.$text.$normal;
				break;
			case 'cyan':
				return $cyan.$text.$normal;
				break;
			case 'kuning':
				return $yellow.$text.$normal;
				break;
			case 'normal':
				return $normal.$text.$normal;
				break;
			default:
				return $cyan.$text.$normal;
				break;
		}
	}
    public function Cek($file){
        $fopen = file_get_contents($file);
        $proxy = explode("\n", $fopen);
        echo $this->color("kuning", "[#] Proxies Total : ").$this->color("cyan", count($proxy))."\n\n";
        $i = 1;
        foreach($proxy as $proxies){
            $cek = $this->Check(trim($proxies));
            if($cek == "LIVE"){
                echo $this->Save($this->check, $proxies."\n");
                echo $this->color("cyan","[#][".$i++."/".count($proxy)."]").$this->color("hijau"," [ LIVE ] [ ").$this->color("normal", $proxies).$this->color("hijau"," ]").$this->color("kuning", " [ ".date("d/m/Y H:i:s")." ]\n");
            }else{
                echo $this->color("cyan","[#][".$i++."/".count($proxy)."]").$this->color("merah"," [ DIE_ ] [ ").$this->color("normal", $proxies).$this->color("merah"," ]").$this->color("kuning", " [ ".date("d/m/Y H:i:s")." ]\n");
            }
        }
        echo $this->color("hijau", "[#] Checking Done!\n");
    }
}

$mztr = new MztrProxy();
$mztr->CheckOS();
$mztr->fname = "Proxies-List_".date('d-m-Y').".txt"; // PROXY FILE NAME TO SAVE
$mztr->check = "Proxies-Check_".date("d-m-Y_H").".txt"; // PROXY FILE CHECKED NAME TO SAVE
$mztr->Form();
?>
