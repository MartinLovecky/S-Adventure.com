<?php

namespace starproject\controllers;

use starproject\database\Datab;
use \starproject\tools\Messages;
use \starproject\tools\Selector;
use \starproject\database\story\Articles;
use \starproject\database\costumers\Member;

class ArticlesController extends Articles
{
    public $Article;
    private $_selector;
    private $_member;
    private $_message;
    private $_db;
    
    public function __construct(Selector $selector, Member $member, Messages $message, Datab $con)
    {
        $this->_selector = $selector;
        $this->_member = $member;
        $this->_message = $message;
        $this->_db = $con->con();
        $this->Article = $this->_GetArticle();
    }
    
    public function _GetArticle()
    {
        if (in_array($this->_selector?->article, $this->_selector->allowedAricles)) {
            $stmt = $this->_db->from($this->_selector->article)->where('pg_num', $this->_selector->page);
            $result = $stmt->fetch();
            if (!$result) {
                return $this->_selector->message = $this->_message->message(['error'=>'Stránka neexistuje vytvořte ji pomocí /create']);
            }
            return $result;
        }
        return null;
    }

    //! Insecure update/create/delete avaible only for admin !!!!!!
    public function update($request)
    {
        // Each story is own table
        $set = ['chapter'=>$request['chapter'],'body'=>str_replace('&nbsp;', '', $request['content']),'pg_num'=>$request['page']];
        $stmt = $this->_db->update($request['article'])->set($set)->where('pg_num', $request['page'])->execute();
        if (!$stmt) {
            return $this->_selector->message = $this->_message->message(['error'=>'Stránka neexistuje vytvořte ji pomocí /create']);
        }
        return header('Location: /update/'.$request['article'].'/'.$request['page'].'?action=updated');
    }
    public function create($request)
    {
        $vals = ['chapter'=>null,'body'=>null,'pg_num'=>$request['page']];
        $stmt = $this->_db->insertInto($request['article'])->values($vals)->execute();
        if (!$stmt) {
            return $this->_selector->message = $this->_message->message(['error'=>'Stránka nemohla být vytvořena nejspíše již existuje']);
        }
        return header('Location: /create/'.$request['article'].'/'.$request['page'].'?action=created');
    }
    public function delete($request)
    {
        $set = ['chapter'=>null,'body'=>null,'pg_num'=>$request['page']];
        $stmt = $this->_db->update($request['article'])->set($set)->where('pg_num', $request['page'])->execute();
        if (!$stmt) {
            return $this->_selector->message = $this->_message->message(['error'=>'Obsah nemohl být smazán nejspíše nexistuje vytvořte ji pomocí /create']);
        }
        return header('Location: /delete/'.$request['article'].'/'.$request['page'].'?action=deleted');
    }
}
