<?php

        class Review{

            private int $id_usuario;
            private int $id_producto;
            private String $review;
            private int $nota;
            private int $already_reviewed;
            private  $db;

            public function __get($name){return $this->$name;}
            public function __set($name, $value){$this->$name = $value;}

            public function __construct() {
                $this->db               = Database::connect();
            }

            public function initReview(){
                $saveStm = $this->db->prepare("INSERT INTO review VALUES (?,?,'',-1,0)");
                $saveStm->bind_param("ii",$this->id_usuario,$this->id_producto);
                if($saveStm->execute());
                return ($this->db->errno  == 1062) ? false : true;
            }

            public function updateReview(){
                       $updateSTM = $this->db->prepare("UPDATE review SET review = ?,nota = ?, already_reviewed=1 WHERE id_usuario = ? AND id_producto=? ");
                       $updateSTM->bind_param("siii",$_POST['reviewProducto'],$_POST['notaReview'],$_POST['usuarioId'],$_POST['productoId']);
                       if($updateSTM->execute()){
                           return $this->db->affected_rows==1;
                       }
            }

            private function checkReview(){
                return !empty($_GET['notaReview'])&& !empty($_GET['reviewProducto']) && $_GET['notaReview']>0 && $_GET['notaReview']<10;
            }


            public function getProductRating($id_producto){
                 $totalRatingsSTM = $this->db->prepare("SELECT SUM(nota)/COUNT(*) FROM review WHERE already_reviewed=1 GROUP BY id_producto HAVING id_producto=?;");
                 if($totalRatingsSTM==false) return false;
                 $totalRatingsSTM->bind_param("i",$id_producto);
                 $totalRatingsSTM->execute();
                 $result = $totalRatingsSTM->get_result();
                 if($result->num_rows==0) return "Producto aun no evaluado";
                 return number_format($result->fetch_array()[0],2);
            }

            private function getAllReviewsByProduct($id_producto){
                $arrayReviews  = [];
                $allReviewsSTM = $this->db->prepare("SELECT * FROM review WHERE id_producto=? AND already_reviewed=1");
                $allReviewsSTM->bind_param("i",$id_producto);
                $allReviewsSTM->execute();
                $result = $allReviewsSTM->get_result();

                if($result->num_rows==0){return $this->printEmptyReview();}
                while($row = $result->fetch_object('Review')){
                    $arrayReviews[] = $row;
                }
                return $arrayReviews;

            }

            private function printEmptyReview(){
                    $reviewAux=new Review();
                     $reviewAux->review = "el producto aún no tiene reviews";
                     $arrayReviews[0] = $reviewAux;
                     return $arrayReviews;
            }

            public function printReviewsByProduct(){
                $arrayReviews =$this->getAllReviewsByProduct($this->id_producto);

                $output="<div>";
                $output.="<table class = review><tr><th>ALGUNAS REVIEWS DEL PRODUCTO DE NUESTROS USUARIOS</th></tr>";
                foreach($arrayReviews as $clave=>$review){

                    if(!isset($review->id_usuario)) return $review->review;
                    $userAux = new Usuario();
                    $userAux->setId($review->id_usuario);
                    $user    = $userAux->getOne();
                    $userImg = $user->imagen;

                    $output.="<tr><td>";
                    $output.="<img src='".base_url."uploads/images/".$userImg."' style = 'max-width:3rem'>Usuario : <b>$user->nombre</b>";
                    $output.="\"    $review->review\"     $review->nota/10</td></tr>";

                }
                $output.="</table></div>";

                return $output;
            }

            public function getPendingReviewsByUser($userId){
                $arrayReviews  = [];
                $allReviewsSTM = $this->db->prepare("SELECT * FROM review WHERE id_usuario=? AND already_reviewed=0");
                $allReviewsSTM->bind_param("i",$userId);
                $allReviewsSTM->execute();
                $result = $allReviewsSTM->get_result();

                if($result->num_rows==0){
                    return false;
                }

                while($row = $result->fetch_object('Review')){
                    $arrayReviews[] = $row;
                }
                return $arrayReviews;
            }

            public function isInArray($reviewsArray){
                foreach($reviewsArray as $key=>$reviewAux){
                    if($reviewAux->id_usuario==$this->id_usuario && $reviewAux->id_producto==$this->id_producto){
                        return true;
                    }
                }
            }
        }