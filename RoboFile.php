<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function search () {




        $lines = file("server.conf");
        $config = array();
        echo " ** location ** \n";
        foreach ($lines as $l) {


            $pattern ="#location *~*\s[/][\a-zA-Z0-9-/]*#" ;


            if(preg_match($pattern, $l, $matches))
            {


                $l = ltrim($l);
                $l=substr($l,strlen("locations"));
                $l=substr("$l", 0, -2);
                $l.="\n";
                $l = ltrim($l);
                echo "$l";

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
    }
}
