<?php

use ArangoDBCLient\DocumentHandler as ArangoDocumentHandler;
use ArangoDBClient\CollectionHandler as ArangoCollectionHandler;
use ArangoDBClient\Document as ArangoDocument;
use function ArangoDBClient\readCollection;


require_once "../Model/executeQuery.php";
require_once "../Model/createEdges.php";
require_once "../Controller/connection.php";
require_once "../Controller/arangodb-php/lib/ArangoDBClient/CollectionHandler.php";
require_once "../Controller/arangodb-php/lib/ArangoDBClient/Cursor.php";
require_once "../Controller/arangodb-php/lib/ArangoDBClient/DocumentHandler.php";


class UserQuery
{
    public static function register($username, $email, $password, $name, $birthday, $userImage)
    {
        $database = new ArangoDocumentHandler(connect());
        $user = new ArangoDocument();
        $user->set("username", $username);
        $user->set("email", $email);
        $user->set("password", $password);
        $user->set("name", $name);
        $user->set("birthday", $birthday);
        $user->set("userImage", $userImage);

        $database->save("user", $user);
        return 'You have been successfully registered';
    }

    public static function isUsernameTaken($username)
    {
        $document = new ArangoCollectionHandler(connect());
        $cursorUser = $document->byExample('user', ['username' => $username]);
        if ($cursorUser->getCount() == 0) {
            return false;
        }
        return true;
    }

    public static function isEmailTaken($email)
    {
        $document = new ArangoCollectionHandler(connect());
        $cursorEmail = $document->byExample('user', ['email' => $email]);
        if ($cursorEmail->getCount() == 0) {
            return false;
        }
        return true;
    }

    public static function getInformation($email)
    {
        $query = ['
        FOR x IN user 
        FILTER x.email == @email 
        RETURN {password: x.password, key: x._key, username: x.username, name: x.name, email: x.email}' => ['email' => $email]];
        $cursor = readCollection($query);
        return $cursor;
    }

    public static function getProfile($username)
    {
        $query = ['
        FOR x IN user 
        FILTER x.username == @username
        RETURN {key: x._key, username: x.username, name: x.name, email: x.email}' => ['username' => $username]];

        $cursor = readCollection($query);
        $resultingDocuments = array();

        if ($cursor->getCount() > 0) {
            $profile = array();

            foreach ($cursor as $key => $value) {
                $resultingDocuments[$key] = $value;
                $profile['username'] = $resultingDocuments[$key]->get('username');
                $profile['name'] = $resultingDocuments[$key]->get('name');
                $profile['email'] = $resultingDocuments[$key]->get('email');
                $profile['key'] = $resultingDocuments[$key]->get('key');
            }
            return $profile;
        }
        return null;
    }

    public static function followUser($fromUser, $toUser)
    {
        userFollow($fromUser, $toUser);
    }

}