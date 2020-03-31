<?php
/**
 * @author Sergio Casizzone
 * @class Classe che raccolgie funzioni di invio email
 * @param controller -> la vista da mostrare
 * @param encryptedUserId -> lo userid criptato
 * @param email -> la mail dell'user (non è obbligatorio)
 * @param password -> la password della prima iscrizione (non è obbligatoria)
 * @param activation_code -> il codice attivazione dopo la prima iscrizione (non è obbligatoria)
 *
 */
class NMail {

    public function SendMail($controller, $encryptedUserId, $email = '', $password = '', $activation_code = ''){
        //Se mi trovo in ufficio è inutile tentare di inviare una mail....
        if (gethostname()=='CGF6135T'){
            return true;
        }

		$message = new YiiMailMessage;
		$message->view = $controller; //this points to the file xxxx.php inside the view path
        $params = array(
            'encryptedUserId'=>$encryptedUserId,
            'email'=>$email,
            'password'=>$password,
            'activation_code'=>crypt::Encrypt($activation_code.','.$encryptedUserId),
        );
        $model=Users::model()->findByPk(crypt::Decrypt($encryptedUserId));
        $params['name']  = $model->name;
        $params['surname']  = $model->surname;

        $filename = dirname(Yii::app()->getBasePath()) . '/css/images/invoice.png';
		$image = Swift_Image::fromPath($filename);
		$logo = $message->embed($image);
		$params['logo']  = $logo;

        switch ($controller){
            case 'recovery':
                $subject = 'Ripristino Password '.Yii::app()->params['shortName'];
                break;
            case 'users':
                $subject = 'Registrazione utente '.Yii::app()->params['shortName'];
                break;
            case 'sin':
                $subject = 'Codice Identificativo POS '.Yii::app()->params['shortName'];
                break;
            case 'iscrizione':
            case 'associations':
                $subject = 'Iscrizione all\'Associazione '.Yii::app()->params['nomeAssociazione'];
                break;

            case 'sollecito':
                $params['email']  = $model->email;
                $params['id_user']  = $model->id_user;
                $subject = 'Avviso adesione scaduta all\'Associazione '.Yii::app()->params['nomeAssociazione'];
                break;

            case 'consensus':
                $params['email']  = $model->email;
                $params['id_user']  = $model->id_user;
                $subject = 'Modifica dei parametri di consenso per l\'Associazione '.Yii::app()->params['nomeAssociazione'];
                break;

            case 'mailings':
                $params['email']  = $model->email;
                $params['id_user']  = $model->id_user;
                $params['post']  = $password;
                $subject = $password['subject'];
                break;

            case 'mpk':
                $pos=Pos::model()->findByPk($password);
                $store=Stores::model()->findByPk($pos->id_store);

                $subject = 'Master Public Key Utente';
                $params = (array) $model->attributes;
                $params['logo']  = $logo;
                $params['store'] = $store->denomination;
                $params['pos'] = $pos->denomination;
                $params['mpk'] = $pos->mpk;
                break;


            // Ricevo id_user dell'utente registrato cryptato
            // la mail dell'admin a cui inviare il messaggio di avviso nuova iscrizione
            case 'iscrizioneAdmin':
                $params = (array) $model->attributes;
                $params['logo']  = $logo;
                $subject = 'Nuova Iscrizione all\'Associazione '.Yii::app()->params['nomeAssociazione'];
                break;

            // Ricevo id_invoice_bps  dell'utente che ha pagato
            // invio mail algli admin
            case 'subscriptionAdmin':
                $array = (array) $model->attributes;
                $pagamenti = Pagamenti::model()->findByAttributes(array('id_invoice_bps'=>$password));
                $params = array_merge($array, (array) $pagamenti->attributes);
                $params['logo']  = $logo;
                $subject = 'Notifica Pagamento all\'Associazione '.Yii::app()->params['nomeAssociazione'];
                break;


            // Ricevo id_user dell'utente registrato cryptato
            // invio messaggio rifiuto iscrizione con motivazione
            case 'usersDisclaim':
                $subject = 'Iscrizione all\'Associazione '.Yii::app()->params['nomeAssociazione']. ' rifiutata!';
                break;

            default:
                $subject = 'Benvenuto in '.Yii::app()->params['shortName'];
        }
        #echo '<pre>'.print_r($params,true).'</pre>';
        #exit;

        $message->subject = $subject;
		$message->setBody($params, 'text/html');
        $message->addTo($email);
		$message->from = Yii::app()->params['adminEmail'];

		Yii::app()->mail->send($message);

        return true;
	}

     // invia una mail del pagamento effettuato all'utente
    public function SendMailIscrizione($id_invoice){
        //Se mi trovo in ufficio è inutile tentare di inviare una mail....
        if (gethostname()=='CGF6135T'){
            return true;
        }
		$message = new YiiMailMessage;
		$message->view = 'subscription'; //this points to the file test.php inside the view path

        $pagamenti = Pagamenti::model()->findByAttributes(array('id_invoice_bps'=>$id_invoice));
        $users = Users::model()->findByPk($pagamenti->id_user);

        $params              = array(
            'id_invoice'=>$id_invoice,
            'email'=>$users->email,
            'name'=>$users->name,
            'surname'=>$users->surname,
        );
        $filename = dirname(Yii::app()->getBasePath()) . '/css/images/logocomune.png';
		$image = Swift_Image::fromPath($filename);
		$logo = $message->embed($image);
		$params['logo']  = $logo;

        $message->subject = 'Ricevuta Pagamento Iscrizione';
		$message->setBody($params, 'text/html');
        $message->addTo($users->email);
		$message->from = Yii::app()->params['adminEmail'];

		Yii::app()->mail->send($message);
	}


}
?>
