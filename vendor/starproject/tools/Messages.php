<?php

namespace starproject\tools;

class Messages
{
    public function message($message)
    {
        if (isset($message['success'])) {
            return '<div role="alert" class="alert alert-success text-center text-success"><span>'.$message['success'].'</span></div>';
        }
        if (isset($message['error'])) {
            return '<div role="alert" class="alert alert-danger text-center text-danger"><span>'.$message['error'].'</span></div>';
        }
        return null;
    }

    public function _getAction($action)
    {
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
        case 'savedBookmark':
            return $this->message(['success'=>'Záložka uložena']);
                break;
        case 'maxBookmarks':
            return $this->message(['error'=>'Maximální počet záložek je 12, pokud chcete uložit novou nejprve musíte smazat jednu záložku']);
                break;
        case 'check':
            return $this->message(['error'=>'Registrací souhlasíte se smluvníma podmínkama a ochranou soukromí']);
                break;
        case 'profilUpdate':
            return $this->message(['success'=>'Profil aktualizován']);
                break;
        case 'active':
            return $this->message(['success'=>'Váš účet je aktivní můžete se přihlásit']);
                break;
        case 'failActive':
            return  $this->message(['error'=>'Aktivace účtu se nezdaržila kotaktujte prosím Admina']);
                break;
        case 'failBookmark':
            return $this->message(['error'=>'Záložka neuložena zkuste to znovu, pokud se tato chyba bude opakovat kontaktujte Admina']);
                break;
        case 'reset':
            return $this->message(['success'=>'Prosím zkotrolujte si Váš email']);
                break;
        case 'resetAccount':
            return $this->message(['success'=>'Heslo změněno, můžete se přihlásit']);
                break;
        case 'send':
            return $this->message(['error'=>'Zpráva odeslána']);
                break;
        case 'joined':
            return $this->message(['success'=>'Registrace úspěšná, pro aktivovaní účtu zkotrolujte email']);
                break;
        case 'logged':
            return $this->message(['success'=>'Přihlášení úspěšné']);
                break;
        case 'permission':
            return $this->message(['error'=>'Pro zobrazení se musíte <a href="/login"></br>Přihlásit</a> / <a href="/register">Registovat</a>']);
        case 'hash':
            return $this->message(['error'=>'Pro změnu hesla je nutné ověřit e-mail']);
                default: null;
            }
    }
}
