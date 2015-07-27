<?php
class controller{
    public function __construct($db, $pagURL){
        $this->db=$db;
        $this->pagURL=$pagURL;
        $this->pagTpl=$this->pagType="index";
        $this->pagOpt=array();
    }
    public function start(){
        global $fct, $model, $view;
        if($fct->dbcon()!=1){
            //Daca nu avem conexiunea la baza de date
            $this->pagTpl = $this->pagType = "msg";
            $this->pagOpt['err_msg'] = "Eroare la conectarea la baza de date!";
        }else{
            $pagarr = $this->pagURL;
            $pg1 = isset($pagarr[0])?$pagarr[0]:"";
            $pg2 = isset($pagarr[1])?$pagarr[1]:"";
            $pg3 = isset($pagarr[2])?$pagarr[2]:"";

            if($pg1=="votare"){
                //Pagina utilizatorului
                if($fct->loggedin()){
                    //Daca este logat
                    $this->pagTpl = "normal";
                    $this->pagType = "votare";
                }else{
                    //Daca nu este logat, va primi o eroare
                    $this->pagTpl = $this->pagType = "msg";
                    $this->pagOpt['err_msg'] = "Nu ai acces aici! Te rugăm să te loghezi!";
                }
            }elseif($pg1=="ajax"){
                //Request-urile ajax
                $this->pagTpl = $this->pagType = "ajax";
            }elseif($pg1=="out"){
                //Ramanem pe default - index/index
                $fct->logout();
            }elseif($pg1=="vot"){
                //Pagina in care se face requestul pentru votare
                if(!$fct->loggedin()){
                    //In cazul in care utilizatorul nu este logat
                    $this->pagTpl = $this->pagType = "msg";
                    $this->pagOpt['err_msg'] = "Nu ai acces aici! Te rugăm să te loghezi!";
                }else{
                    if(isset($_SESSION['token'])&&$pg3==$_SESSION['token']&&$fct->candcheck($pg2)){
                        //Daca exista sesiunea de token si corespunde cu cea din url(anti-CSRF) si exista candidatul
                        $fct->vot();
                    }else{
                        //Altfel afisam eroare
                        $this->pagTpl = $this->pagType = "msg";
                        $this->pagOpt['err_msg'] = 'Sesiune invalidă! Vă rugăm să activați cookie-urile! Click <a href="votare">aici</a> pentru a vă întoarce.';
                    }
                }
            }elseif($pg1=="admin-bec"||$pg1=="admin-dev"||$pg1=="admin-prim"||$pg1=="admin-urna"){
                $pgsub = explode("-",$pg1);
                if($pgsub[1]=="bec") $stt = $fct->admin_bec_check();
                elseif($pgsub[1]=="dev") $stt = $fct->admin_dev_check();
                elseif($pgsub[1]=="prim") $stt = $fct->admin_prim_check();
                elseif($pgsub[1]=="urna") $stt = $fct->admin_urna_check();
                else $stt=0;

                if($stt<1){
                    //Parola a fost gresita sau nu a fost trimisa
                    $this->pagTpl = "adm_login";
                    $this->pagOpt['status']=$stt;
                }else{
                    //Administratorul este logat
                    $this->pagTpl = "normal";
                }
                $this->pagType = $pgsub[1];
            }
        }

        $this->build();
    }
    function build(){
        global $view, $model, $fct, $db;
        $page = "";$repl=array();
        if($this->pagType=="ajax"){
            $pagarr = $this->pagURL;
            include (__SITE_PATH . '/app/ajax.php');
            $output=$res;
        }else{
            $tpls = array("index", "normal", "msg", "adm_login"); //Declaram template-urile existente
            if(in_array($this->pagTpl, $tpls)&&file_exists(__SITE_PATH . '/app/templates/'.$this->pagTpl.'.tpl')){
                $page = file_get_contents(__SITE_PATH . '/app/templates/'.$this->pagTpl.'.tpl');
                //Daca exista, il extragem in $page
            }
            $repl["H-head"] = $model->head();
            $repl["F-footer"] = $model->footer();
            //Inlocuim head-ul si footerul in string

            if($this->pagTpl=="msg"){
                $repl["C-SES-err_msg"] = $model->errmsg(isset($this->pagOpt['err_msg'])?$this->pagOpt['err_msg']:"");
            }elseif($this->pagTpl=="normal"){
                 $pginfo = $model->get_normalpg_header($this->pagType);
                 $this->pagOpt["id"]=$pginfo[0];
                 //[0]-id [1]-titlu pagina [2]-titlu sectiune [3]-  [4]-html-ul pentru meniu
                 $repl["C-title"]= isset($pginfo[1])?$pginfo[1]:""; //Titlu pagina
                 $repl["H-title"]= isset($pginfo[2])?$pginfo[2]:""; //Titlu sectiune
                 $repl["H-nume"] = isset($pginfo[3])?$pginfo[3]:""; //Nume utilizator
                 $repl["C-menu"] = isset($pginfo[4])?$pginfo[4]:""; //HTML pentru meniu

                 $repl["C-data"] = $model->get_pgdata($this->pagTpl, $this->pagType, $this->pagOpt);
            }elseif($this->pagTpl=="adm_login"){
                 $repl["C-form"] = $model->get_pgdata($this->pagTpl, $this->pagType, $this->pagOpt);
            }
            foreach($repl as $nm => $val){$page = str_ireplace('{ '.$nm.' }', $val, $page);}
            $output = preg_replace('/\\{\\ [a-zA-Z_-]+\\ \\}/i', '', $page);
            //Activam minificarea
            $view->setminify("html");
        }
        //Stergem orice "{ }" ramase
        $view->add($output);
        $view->show();
    }
}
