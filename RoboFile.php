<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{


    public function directory($dir_src) {
        $this->taskFlattenDir([$dir_src.'/*.conf' =>'dir_dest'])
            ->run();
        $dir_dest = 'dir_dest';
        $files = array();
        if(is_dir($dir_dest)) {
            $handle = opendir($dir_dest);
            while(false !== ($file = readdir($handle))){
                if(is_file($dir_dest.'/'.$file) && is_readable($dir_dest.'/'.$file)){
                    $fileNames[] = $file;
                }
            }
            closedir($handle);
          //  $fileNames = array_reverse($fileNames);
            print_r($fileNames);
        }else {
            echo "<p>There is an directory read issue</p>";

        }

       foreach ($fileNames as $name) {
           $this->search($name);
       }






    }


    public function search ($w ) {




        $lines = file($w);
        $config = array();
        $this->say("searching for location in this file: $w");
        $this->taskWriteToFile('locations.url')
            ->append()
            ->line(date('H:i:s /Y-m-d').' locations for '.$w)
            ->line('----')
            ->run();
        foreach ($lines as $l) {


            $pattern ="#location *~*\s[/][\a-zA-Z0-9-/]*#" ;


            if(preg_match($pattern, $l, $matches))
            {


                $l = ltrim($l);
                $l=substr($l,strlen("location"));
                $l=substr("$l", 0, -2);
                $l.="\n";
                $l = ltrim($l);
                echo "$l";

                $this->taskWriteToFile('locations.url')
                    ->append()
                    ->line(' '.$l)
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
        }


        //var_dump($config);


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
