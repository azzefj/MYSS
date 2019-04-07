<?php
use ArangoDBClient\CollectionHandler as ArangoCollectionHandler;
use ArangoDBClient\Collection as ArangoCollection;
use ArangoDBClient\EdgeHandler as ArangoEdgeHandler;
use ArangoDBClient\Edge as ArangoEdge;

require_once("connection.php");

$connection = connect();
$collectionHandler = new ArangoCollectionHandler($connection);
$edgeHandler = new ArangoEdgeHandler($connection);

if ($collectionHandler->has('user')) {
    $collectionHandler->drop('user');
}
if ($collectionHandler->has('post')) {
    $collectionHandler->drop('post');
}
if ($collectionHandler->has('comment')) {
    $collectionHandler->drop('comment');
}
if ($collectionHandler->has('tag')) {
    $collectionHandler->drop('tag');
}
if ($collectionHandler->has('follows')) {
    $collectionHandler->drop('follows');
}
if ($collectionHandler->has('comment')) {
    $collectionHandler->drop('comment');
}
if ($collectionHandler->has('posted')) {
    $collectionHandler->drop('posted');
}
if ($collectionHandler->has('has_tag')) {
    $collectionHandler->drop('has_tag');
}
if ($collectionHandler->has('has_comment')) {
    $collectionHandler->drop('has_comment');
}


// create the User collection //
$userCollection = new ArangoCollection();
$userCollection->setName('user');
$id = $collectionHandler->create($userCollection);

// create the Post collection //
$postCollection = new ArangoCollection();
$postCollection->setName('post');
$id = $collectionHandler->create($postCollection);

// create the Tag collection //
$commentCollection = new ArangoCollection();
$commentCollection->setName('comment');
$id = $collectionHandler-> create($commentCollection);

// create the Tag collection //
$tagCollection = new ArangoCollection();
$tagCollection->setName('tag');
$id = $collectionHandler-> create($tagCollection);

// create the Comment collection, relation between user and post //
/*$commentEdge = new ArangoCollection();
$commentEdge->setName('comment');
$commentEdge->setType(3);
$id = $collectionHandler->create($commentEdge);*/

// create the friends edge //
$followsEdge = new ArangoCollection();
$followsEdge->setName('follows');
$followsEdge->setType(3);
$id = $collectionHandler->create($followsEdge);

// create the posted edge //
$postedEdge = new ArangoCollection();
$postedEdge->setName('posted');
$postedEdge->setType(3);
$id = $collectionHandler->create($postedEdge);

// create the has_tag edge //
$has_commentEdge = new ArangoCollection();
$has_commentEdge->setName('has_comment');
$has_commentEdge->setType(3);
$id = $collectionHandler-> create($has_commentEdge);

// create the has_tag edge //
$has_tagEdge = new ArangoCollection();
$has_tagEdge->setName('has_tag');
$has_tagEdge->setType(3);
$id = $collectionHandler-> create($has_tagEdge);

echo 'Se han creado las colecciones y aristas correctamente.';
