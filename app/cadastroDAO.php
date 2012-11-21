<?php
class cadastroDAO extends PDOConnectionFactory {

	public $conex = null;

	public function cadastroDAO(){
		$this->conex = PDOConnectionFactory::getConnection();
	}

	///insert
    public function Inserir( $cadastro ){
    try{
    $stmt = $this->conex->prepare("INSERT INTO appFace (
							    	id, 
							    	photoCloud, 
							    	photoCoverGray,
							    	photoCoverBlue,
							    	photoCoverGreen,
							    	photoCoverYellow,
									photoShare,
							    	textThink, 
							    	userFace,
							    	nameFace,
							    	uidFace,
									locationFace,
									status
							    	) 
							    	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

	$stmt->bindValue(1, $cadastro->getId() );
	$stmt->bindValue(2, $cadastro->getPhotoCloud());
	$stmt->bindValue(3, $cadastro->getPhotoCoverGray() );
	$stmt->bindValue(4, $cadastro->getPhotoCoverBlue() );
	$stmt->bindValue(5, $cadastro->getPhotoCoverGreen() );
	$stmt->bindValue(6, $cadastro->getPhotoCoverYellow() );
	$stmt->bindValue(7, $cadastro->getPhotoShare() );
	$stmt->bindValue(8, $cadastro->getTextThink() );
	$stmt->bindValue(9, $cadastro->getUserFace() );
	$stmt->bindValue(10, $cadastro->getNameFace() );
	$stmt->bindValue(11, $cadastro->getUidFace() );
	$stmt->bindValue(12, $cadastro->getLocationFace() );
	$stmt->bindValue(13, $cadastro->getStatus() );

    $stmt->execute();

    $this->conex = null;
    }catch ( PDOException $ex ){
    	echo "Erro: ".$ex->getMessage();
    	}
    }
    
    
    ///list
    public function Listar($query=null){
			try{
				if( $query == null ){
					$stmt = $this->conex->query("SELECT * FROM appFace");
				}else{
					$stmt = $this->conex->query($query);
				}
				$this->conex = null;
				return $stmt;
			}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
		}

	///listParameter
    public function listaParameter($query=null, $param){
			try{
				if( $query == null ){
					$stmt = $this->conex->query("SELECT * FROM appFace WHERE uidFace = $param");
				}else{
					$stmt = $this->conex->query($query);
				}
				$this->conex = null;
				return $stmt;
			}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
		}
		
		
   ///update
    public function Alterar($cadastro, $condicao ){
            try{
                $stmt = $this->conex->prepare("UPDATE appFace SET status=? WHERE id=?");
                $this->conex->beginTransaction();

      
               
		$stmt->bindValue(1, $cadastro->getStatus() );             
                $stmt->bindValue(2, $condicao);

                $stmt->execute();
		
                $this->conex->commit();
                $this->conex = null;

            }catch ( PDOException $ex ){ echo "Erro: ".$ex->getMessage(); }
        }
		
		
	///delete
    public function Excluir( $id ){
        try{
        $num = $this->conex->exec("DELETE FROM appFace WHERE id = $id");
        if( $num >= 1 ){ return $num; } else { return 0; }
        }catch ( PDOException $ex ){ echo "Erro: ".$ex->getMessage(); }
    }
}