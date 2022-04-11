<?php 
    class Partida{

        private $idUser;
        private $idPartida;
        private $gridCol;
        private $gridLin;
        private $bombas;
        private $data;
        private $modalidade;
        private $tempo;
        private $pontuacao;
        private $resultado;

        public function __construct($idUser, $idPartida, $gridCol, $gridLin, $bombas, $data, $modalidade, $tempo, $pontuacao, $resultado){
            $this->idUser = $idUser;
            $this->idPartida = $idPartida;
            $this->gridCol = $gridCol;
            $this->gridLin = $gridLin;
            $this->bombas = $bombas;
            $this->data = $data;
            $this->modalidade = $modalidade;
            $this->tempo = $tempo;
            $this->pontuacao = $pontuacao;
            $this->resultado = $resultado;
        }

        public function getIdUser()
        {
            return $this->idUser;
        }

        public function getIdPartida()
        {
            return $this->idPartida;
        }

        public function getGridCol()
        {
            return $this->gridCol;
        }

        public function setGridCol($gridCol)
        {
            $this->gridCol = $gridCol;
        }

        public function getGridLin()
        {
            return $this->gridLin;
        }

        public function setGridLin($gridLin)
        {
            $this->gridLin = $gridLin;
        }

        public function getModalidade()
        {
            return $this->modalidade;
        }

        public function setModalidade($modalidade)
        {
            $this->modalidade = $modalidade;
        }

        public function getBombas()
        {
            return $this->bombas;
        }

        public function setBombas($bombas)
        {
            $this->bombas = $bombas;
        }

        public function getData()
        {
            return $this->data;
        }

        public function setData($data)
        {
            $this->data = $data;
        }

        public function getTempo()
        {
            return $this->tempo;
        }

        public function setTempo($tempo)
        {
            $this->tempo = $tempo;
        }

        public function getPontuacao()
        {
            return $this->pontuacao;
        }

        public function setPontuacao($pontuacao)
        {
            $this->pontuacao = $pontuacao;
        }

        public function getResultado()
        {
            return $this->resultado;
        }

        public function setResultado($resultado)
        {
            $this->resultado = $resultado;
        }
    }
?>