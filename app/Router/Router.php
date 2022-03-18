<?php
    namespace App\Router;
    use App\Form\Logic as Logic;
    use App\CrawlerLibrary\Warpper\DataHandler as DataHandler;
    use App\Mysql\AddData as AddData;
    /**
     * header to form input
     */
    class Router{        
        public $logic;

        public function __construct(Logic $logic){
            $this->logic = $logic;
        }

        public function action(){
            if($this->logic->checkForm()){
                $this->execute(true);
            }
            else {
                $this->execute(false); 
            }
        }

        protected function execute($bool){
            if($bool){
                $action = $this->logic->action(
                    new DataHandler($this->logic->data['url']), 
                    new AddData(
                        $this->logic->data['username'], 
                        $this->logic->data['password']
                    )
                );
                if($action){
                    echo 'added';
                }else{
                    echo 'Invalid Url !!!';
                }
                
            }else {
                header("Location: /app/Form/form.php");
            }
        }
    }