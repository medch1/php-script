<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{

    public function curl($url)
    {
        $url = 'https://' . $url;
        //$url="stage-connector.bumbal.eu/  ";

        //$this->taskExec('curl')->arg($url)->run();

        $this->_exec("curl -I -m 10 $url");

        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.keycdn.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        echo $result;*/
        echo "\n **";

    }



    public function directory($dir_src) {
        $this->taskFlattenDir([$dir_src.'/*.conf' =>'dir_dest'])
            ->run();
        $dir_dest = 'dir_dest';

        if(is_dir($dir_dest)) {
            $handle = opendir($dir_dest);
            while(false !== ($file = readdir($handle))){
                if(is_file($dir_dest.'/'.$file) && is_readable($dir_dest.'/'.$file)){
                    $fileNames[] = $file;
                }
            }
            closedir($handle);
          //  print_r($fileNames);
        }else {
            echo "<p>There is a directory read issue</p>";

        }

       foreach ($fileNames as $name) {

           $this->search($dir_dest.'/'.$name);
           $this->base_url($dir_dest.'/'.$name);
           $this->full($dir_dest.'/'.$name);


       }


    }

    public function full($w)
    {
        $lines = file($w);
        $this->say("searching for full_url in file :$w");
        $this->taskWriteToFile('full_url.url')
            ->append()
            ->line('----'.date('H:i:s /Y-m-d') . ' full_url for ' . $w)
            ->run();
        $pattern = '/server_name ?\s[a-zA-z-.]*/';
        $location_pattern = "#location *\s[/][\a-zA-Z0-9-/]*#";
        $full_url=array();
        $i=0;
        $base_url = '';
        $location = '';
        foreach ($lines as $l) {



            if (preg_match($pattern, $l, $matches)) {

                $base_url = $l;
                $base_url = ltrim($base_url);
                $base_url = substr($base_url, strlen("server_name "));
                $base_url = substr("$base_url", 0, -2);



            }
                if (preg_match($location_pattern, $l, $matches)) {
                    $i++;
                    $location = $l;
                    $location = ltrim($location);
                    $location = substr($location, strlen("location"));
                    $location = substr("$location", 0, -2);
                    $location = ltrim($location);

                    $full_url[$i] = $location;
                }


            }



        foreach ($full_url as $url){
            $this->taskWriteToFile('full_url.url')
                ->append()
                ->line("$base_url$url")
                ->run();
            $this->curl("$base_url$url");

        }

        //print_r($full_url);
    }


    public function base_url($w) {
        $lines = file($w);
        $this->say("searching for base url in file :$w");
        $this->taskWriteToFile('base_urls.url')
            ->append()
            ->line(date('H:i:s /Y-m-d').' base url for '.$w)
            ->line('----')
            ->run();
        foreach ($lines as $l) {
            $pattern ='/server_name ?\s[a-zA-z-.]*/' ;
            if (preg_match($pattern, $l,$matches)) {
                echo "$l ";

                $base_url=$l;
                $base_url = ltrim($base_url);
               $base_url=substr($base_url,strlen("server_name "));
                $base_url=substr("$base_url", 0, -2);

                echo "$base_url";
                $this->taskWriteToFile('base_urls.url')
                    ->append()
                    ->line($base_url)
                    ->line('----')
                    ->run();

            }
        }
    }


    public function search ($w ) {




        $lines = file($w);
        $this->say("searching for location in this file: $w");
        $this->taskWriteToFile('locations.url')
            ->append()
            ->line(date('H:i:s /Y-m-d').' locations for '.$w)
            ->line('----')
            ->run();
        foreach ($lines as $l) {


            $location_pattern ="#location *\s[/][\a-zA-Z0-9-/]*#" ;


            if(preg_match($location_pattern, $l, $matches))
            {

                $location = $l;
                $location = ltrim($location);
                $location=substr($location,strlen("location"));
                $location=substr("$location", 0, -2);
                $location.="\n";
                $location = ltrim($location);
                echo "$location";

                $this->taskWriteToFile('locations.url')
                    ->append()
                    ->line(' '.$location)
                    ->line('----')
                    ->run();

            }


            //preg_match_all("/^(?P<key>\w+)\s+(?P<value>.*)/", $l, $matches);

            //echo ($l);
            //$pattern ="/location /" ;

            // $pattern ="#location ?\s[/][a-zA-Z0-9-/]*#" ;



               //preg_match("/\blocation /", $l, $matches);
               //preg_match_all("/{[^}]*}/",$l, $matches);
               //      print($matches);

               //var_dump($matches);



           //print_r($matches);

            /*if (isset($matches['key'])) {
                $config[$matches['key']] = $matches['value'];
            }*/



        //var_dump($config);


    }
    }


    /**
     * Shows how to start with robo.
     */
    public function start()
    {
        $this->io()->title('start coding robo');
        $this->io()->table([
            '#', 'Description'
        ], [
            ['1.', 'Download robo.phar'],
            ['2.', 'Run php robo.phar init'],
            ['3.', 'Code your task as a function in Robofile.php']
        ]);

       // $this->search($w);
    }
}
