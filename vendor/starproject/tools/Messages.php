<?php

namespace starproject\tools;

class Messages{
    
    public function message($message){
   
        if(isset($message['success'])){
            return '<div role="alert" class="alert alert-success text-center text-success"><span>'.$message['success'].'</span></div>';
        }
        if(isset($message['error'])){
            return '<div role="alert" class="alert alert-danger text-center text-danger"><span>'.$message['error'].'</span></div>';
        }
        return null;
    }
    public function _getAction($action){
        if(isset($action)){
             # xx.cz/xx/xx?action='action';
            switch ($action) {
                case 'failExist':
                    return $this->message(['error'=>'Stránka již existuije použijte /update']);
                break;
                case 'created':
                    return $this->message(['success'=>'Stránka úspěšně vyvořena']);
                break;
                case 'failUpdate':
                    return $this->message(['error'=>'Stránka neexistuje vytvořte jí pomocí /create']);
                break;
                case 'updated':
                    return $this->message(['success'=>'Stránka úspěšně upravena']);
                break;
                case 'deleted':
                    return $this->message(['success'=>'Stránka úspěšně smazána']);
                break;
                case 'saved':
                    return $this->message(['success'=>'Záložka uložena']);
                break;
                case 'check':
                    return $this->message(['error'=>'Registrací souhlasíte se smluvníma podmínkama a ochranou soukromí']);
                break;
                case 'profilUpdate':
                    return $this->message(['success'=>'Profil aktualizován']);
                break;
                case 'emptyBookmark':
                    return $this->message(['error'=>'Žádná uložená záložka']);
                break;
                case 'active':
                    return $this->message(['success'=>'Váš účet je aktivní můžete se přihlásit']);
                break;
                case 'reset':
                    return $this->message(['success'=>'Prosím zkotrolujte si Váš email']);
                break;
                case 'resetAccount':
                    return $this->message(['success'=>'Heslo změněno, můžete se přihlásit']);
                break;
                case 'show':
                    return $this->message(['error'=>'Pro prohlížení příspěvků se musíte přihlásit/registrovat']);
                break;
                case 'send':
                    return $this->message(['error'=>'Zpráva odeslána']);
                break;
                case 'joined':
                    return $this->message(['error'=>'Registrace úspěšná, pro aktivovaní účtu zkotrolujte email']);
                break;
                default: null;
            }
        }
        return null;
    }
}